<?php

require_once 'fighter.php';
require_once 'tournamentMatch.php';

class Bracket {
    public static function create($conn, $category_id){
        $stmt = $conn->prepare("
            INSERT INTO brackets (category_id, status)
            VALUES (?, 'pending')
        ");

        $stmt->execute([$category_id]);

        return $conn->LastInsertId();
    }

    public static function delete($conn, $id){
        $stmt = $conn->prepare("
            DELETE FROM brackets where id = ?
        ");

        $stmt->execute([$id]);
    }

    public static function generate($conn, $category_id, $bracket_id) {

        $fighters = Fighter::countByCategory($conn, $category_id);

        if($fighters < 2){
            return false;
        }

        // tamanho do bracket (2,4,8,16...)
        $size = pow(2, ceil(log($fighters, 2)));

        $rounds = (INT) log($size, 2);

        $previousRound = [];

        // ROUND 1
        for ($i = 0; $i < $size / 2; $i++) {
            $matchId = TournamentMatch::createMatch($conn, $bracket_id, 1);
            $previousRound[] = $matchId;
        }

        // PRÓXIMOS ROUNDS
        for ($round = 2; $round <= $rounds; $round++) {

            $nextRound = [];

            for ($i = 0; $i < count($previousRound); $i += 2) {

                TournamentMatch::createMatch($conn, $bracket_id, $round);
                $matchId = $conn->lastInsertId();

                TournamentMatch::setNextMatch($conn, $previousRound[$i], $matchId);
                TournamentMatch::setNextMatch($conn, $previousRound[$i + 1], $matchId);

                $nextRound[] = $matchId;
            }

            $previousRound = $nextRound;
        }

        $matches = TournamentMatch::getMatchesBybracket($conn, $bracket_id);

        foreach ($matches as $i => $m) {

            $position = ($i % 2 === 0) ? 'red' : 'blue';

            TournamentMatch::setNextPosition($conn, $m['id'], $position);
        }
    }

    public static function seedFighters($conn, $bracket_id, $category_id){
        $matches = TournamentMatch::getMatchesByBracketAndRound($conn, $bracket_id, 1);
        $matchesCount = count($matches);

        $fighters = Fighter::fighterByCategory($conn, $category_id);
        shuffle($fighters);

        while(count($fighters) < ($matchesCount * 2)){
            $fighters[] = NULL;
        }
        for ($i=0; $i < $matchesCount; $i++) {
            $f1 = $fighters[$i * 2]['id'] ?? NULL;
            $f2 = $fighters[($i * 2) + 1]['id'] ?? NULL;
            TournamentMatch::setFighters($conn, $matches[$i]['id'], $f1, $f2);
        }
    }

    public static function all($conn){
        return $conn->query("
            SELECT 
                b.*,
                w.sex,
                CONCAT(a.name, ' - ', w.name, ' - ', w.sex) AS category_name
            FROM brackets b 
            JOIN categories c on b.category_id = c.id
            JOIN age_division a on c.age_division = a.id
            JOIN weight_division w on c.weight_division = w.id
        ")->fetchAll();
    }

    public static function allMatches($conn, $bracket_id){
        $stmt = $conn->prepare("
            SELECT 
                m.*, 
                fr.name as red_name,
                fb.name as blue_name
            FROM matches m

            LEFT JOIN  fighters fr
            ON m.fighter_red_id = fr.id

            LEFT JOIN fighters fb
            ON m.fighter_blue_id = fb.id

            WHERE m.bracket_id = ?;
            ");
        $stmt->execute([$bracket_id]);
        return $stmt->fetchAll();
    }

    public static function changeStatus($conn, $status, $bracket_id) {
        $stmt = $conn->prepare("
            UPDATE brackets
            SET status = ?
            WHERE id = ?
            and status != ?
        ");

        $stmt->execute([$status, $bracket_id, $status]);

        return $stmt->rowCount();
    }
}
?>