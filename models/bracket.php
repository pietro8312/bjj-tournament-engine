<?php 


class Bracket {
    public static function generate($conn, $category_id) {

        $stmt = $conn->prepare("
            SELECT id FROM fighters WHERE category_id = ?
        ");

        $stmt->execute([$category_id]);
        $fighter = $stmt->fetchAll();
        shuffle($fighter);

        #size do bracket
        $size = pow(2, ceil(log(count($fighter), 2)));
        $total_matches = $size-1;
        $round = log($size, 2);

        $matchesByRound = [];
        $matchesInRound = $total_matches/2;
        for ($r=1; $r <= $round; $r++) { 
            for ($m=1; $m <= $matchesInRound; $m++) { 
                $stmt = $conn->prepare("
                    INSERT INTO matches(category_id, round, status)
                    VALUES (?, ?, 'pending')
                ");
                
                $stmt->execute([$category_id, $r]);
                $matchesByRound[$r][] = $conn->lastInsertId();
            }
            $matchesInRound = $matchesInRound/2;
        }

        $fighterIndex = 0;

        foreach($matchesByRound[1] as $matchId) {
            $red = $fighter[$fighterIndex]['id'] ?? null;
            $fighterIndex++;

            $blue = $fighter[$fighterIndex]['id'] ?? null;
            $fighterIndex++;

            $stmt = $conn->prepare("
                UPDATE matches
                SET fighter_red_id = ?, fighter_blue_id ?
                WHERE id = ?
            ");

            $stmt->execute([$red, $blue, $matchId]);
        }
    }
}
?>