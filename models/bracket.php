<?php

use FTP\Connection;

require_once '../models/fighter.php';
require_once '../models/tournamentMatch.php';

class Bracket {
    public static function create($conn, $category_id){
        $stmt = $conn->prepare("
            INSERT INTO brackets (category_id, status)
            VALUE (?, 'pending')
        ");

        $stmt->execute([$category_id]);

        return $conn->LastInsertId();
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
            $matchId = TournamentMatch::createMatch($conn, $bracket_id, 1, 1);
            $previousRound[] = $matchId;
        }

        // PRÓXIMOS ROUNDS
        for ($round = 2; $round <= $rounds; $round++) {

            $nextRound = [];

            for ($i = 0; $i < count($previousRound); $i += 2) {

                $matchId = TournamentMatch::createMatch($conn, $bracket_id, $round);

                TournamentMatch::setNextMatch($conn, $previousRound[$i], $matchId);
                TournamentMatch::setNextMatch($conn, $previousRound[$i + 1], $matchId);

                $nextRound[] = $matchId;
            }

            $previousRound = $nextRound;
        }
    }

    public static function seedFighters($conn, $category_id){
        $matches = TournamentMatch::getMatchesByCategoryAndRound($conn, $category_id, 1);
        $matchesCount = count($matches);

        $fighters = Fighter::fighterByCategory($conn, $category_id);
        shuffle($fighters);

        while(count($fighters) < ($matchesCount * 2)){
            $fighters[] = null;
        }

        for ($i=0; $i < $matchesCount; $i++) {
            $f1 = $fighters[$i * 2]['id'] ?? null;
            $f2 = $fighters[($i * 2) + 1]['id'] ?? null;
            TournamentMatch::setFighters($conn, $matches[$i]['id'], $f1, $f2);
        }
    }

    public static function getBrackets($conn, $category_id){
        $stmt = $conn->preparea("
            SELECT *
        ");
    }
}
?>