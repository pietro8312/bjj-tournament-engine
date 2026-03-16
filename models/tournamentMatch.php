<?php
    require_once __DIR__ . '/../config/connection.php';
    
    class TournamentMatch{
        public static function createMatch($conn, $bracket_id, $round) {
            $stmt = $conn->prepare("
                INSERT INTO matches (bracket_id, round, status)
                VALUES (?, ?, 'pending')
            ");

            $stmt->execute([$bracket_id, $round]);

            return $conn->LastInsertId();
        }

        public static function setNextMatch($conn, $id, $next_match_id){
            $stmt = $conn->prepare("
                    UPDATE matches 
                    SET next_match_id = ?
                    WHERE id = ?
            ");

            return $stmt->execute([$next_match_id, $id]);
        }

        public static function setNextPosition($conn, $id, $position){
            $stmt = $conn->prepare("
                UPDATE matches
                SET next_match_position = ?
                WHERE id = ?
            ");

            return $stmt->execute([$position, $id]);
        }

        public static function setFighters($conn, $id, $fighter_red, $fighter_blue) {
            $stmt = $conn->prepare("
                UPDATE matches 
                SET fighter_red_id = ?, fighter_blue_id = ?
                WHERE id = ?
            ");

            return $stmt->execute([$fighter_red, $fighter_blue, $id]);
        }

        public static function setWinner($conn, $id, $winner_id) {
                # settar o winner funcionando
                $stmt = $conn->prepare("
                    UPDATE matches 
                    SET winner_id = ?
                    WHERE id  = ?
                ");

                $stmt->execute([$winner_id, $id]);

                #chama as outras infos do match
                $stmt = $conn->prepare("
                    SELECT next_match_id, next_match_position
                    FROM matches
                    WHERE id = ?
                ");

                $stmt->execute([$id]);
                $match = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if($match && !empty($match['next_match_id'])){
                    $column = ($match['next_match_position'] === 'red') ? 'fighter_red_id' : 'fighter_blue_id';
                    $stmt = $conn->prepare("
                        UPDATE matches
                        SET $column = ?
                        WHERE id = ?
                    ");
                    $stmt->execute([$winner_id, $match['next_match_id']]);
                }
        }

        public static function getMatchesByBracket($conn, $bracket_id) {
            $stmt = $conn->prepare("
                SELECT *
                FROM matches
                WHERE bracket_id = ?
                ORDER BY round ASC, id ASC;
            ");

            $stmt->execute([$bracket_id]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getMatchesByBracketAndRound($conn, $bracket_id, $round) {
                $stmt = $conn->prepare("
                    SELECT m.*
                    FROM matches m
                    JOIN brackets b ON m.bracket_id = b.id
                    WHERE m.bracket_id = ?
                    AND m.round = ?
                ");

                $stmt->execute([$bracket_id, $round]);

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getMatchesById($conn, $match_id){
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

                WHERE m.id = ?
            ");

            $stmt->execute([$match_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>