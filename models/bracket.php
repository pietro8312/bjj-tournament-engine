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

        for ($i=1; $i <= $round; $i++) { 
            for($j=1; $j <= $size/2; $j++){
                TournamentMatch::createMatch($conn, $category_id, $i);
            }
            $size = $size/2;
        }
    }

    public static function seedFighters($conn, $category_id){
        $matches = TournamentMatch::getMatchesByCategoryAndRound($conn, $category_id, 1);
        $matchesCount = count($matches);

        $fighters = Fighter::fighterByCategory($conn, $category_id);
        shuffle($fighters);
        $fighterCount = count($fighters);

        while($fighterCount < $matchesCount){
            $fighters[] = null;
        }

        for ($i=0; $i < $matchesCount; $i++) {
            TournamentMatch::setFighters($conn, $matches[$i]['id'], $fighters[$i * 2]['id'], $fighters[($i * 2) + 1]['id']);
        }
    }
}
?>