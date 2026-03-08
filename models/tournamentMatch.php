<?php 
    
    class TournamentMatch{
        public static function createMatch($conn, $category_id, $round) {
            $stmt = $conn->prepare("
                INSERT INTO matches (category, round, status)
                VALUES (?, ?, 'pending')
            ");

            return $stmt->execute([$category_id, $round]);
        }

        public static function setNextMatch($conn, $id, $next_match_id){
            $stmt = $conn->prepare("
                    UPDATE matches 
                    SET next_match_id = ?
                    WHERE id = ?
            ");

            return $stmt->execute([$next_match_id, $id]);
        }

        public static function setFighters($conn, $id_category, $fighter_red, $fighter_blue) {
            $stmt = $conn->prepare("
                UPDATE matches 
                SET fighter_red_id = ?, fighter_blue_id = ?
                WHERE id = ?
            ");

            return $stmt->execute([$fighter_red, $fighter_blue, $id_category]);
        }

        public static function setWinner($conn, $category_id, $winner_id) {
            $stmt = $conn->prepare("
                UPDATE matches 
                SET winner_id = ?
                WHERE category  = ?
            ");

            return $stmt->execute([$winner_id, $category_id]);
        }

        public static function getMatchesByCategory($conn, $id) {
            $stmt = $conn->prepare("
                SELECT * FROM matches
                WHERE category = ?
            ");

            $stmt->execute([$id]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getMatchesByCategoryAndRound($conn, $id, $round) {
                $stmt = $conn->prepare("
                    SELECT * FROM matches
                    WHERE category = ? and round = ?
                ");

                $stmt->execute([$id, $round]);

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>