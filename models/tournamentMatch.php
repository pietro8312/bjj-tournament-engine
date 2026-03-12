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
            $stmt = $conn->prepare("
                UPDATE matches 
                SET winner_id = ?
                WHERE id  = ?
            ");

            return $stmt->execute([$winner_id, $id]);
        }

        public static function getMatchesByCategory($conn, $bracket_id) {
            $stmt = $conn->prepare("
                SELECT m.*
                FROM matches m
                JOIN brackets b ON m.bracket_id = b.id
                WHERE b.category_id = ?
            ");

            $stmt->execute([$bracket_id]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getMatchesByCategoryAndRound($conn, $category_id, $round) {
                $stmt = $conn->prepare("
                    SELECT m.*
                    FROM matches m
                    JOIN brackets b ON m.bracket_id = b.id
                    WHERE b.category_id = ?
                    AND m.round = ?
                ");

                $stmt->execute([$category_id, $round]);

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>