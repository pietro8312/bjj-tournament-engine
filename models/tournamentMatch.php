<?php 
    
    class TournamentMatch{
        public static function createMatch($conn, $category_id, $round) {
            $stmt = $conn->prepare("
                INSERT INTO matches (category, round, status)
                VALUES (?, ?, 'pending')
            ");

            return $stmt->execute([$category_id, $round, 'pending']);
        }

        public static function setNextMatch($conn, $id, $next_match_id){

        }

        public static function setFighters($conn, $category_id, $fighter_red, $fighter_blue) {
            if(isset($fighter_blue) && isset($fighter_red)){
                $stmt = $conn->prepare("
                    UPDATE matches 
                    SET fighter_red_id = ?, fighter_blue_id = ?
                    WHERE category  = ?
                ");

                return $stmt->execute([$fighter_red, $fighter_blue, $category_id]);
            }else if(isset($fighter_blue)){
                $stmt = $conn->prepare("
                    UPDATE matches
                    SET fighter_blue_id = ?, winner_id = ?
                    WHERE category  = ?
                ");

                return $stmt->execute([$fighter_blue, $fighter_blue, $category_id]);
            }else if(isset($fighter_red)){
                $stmt = $conn->prepare("
                    UPDATE matches
                    SET fighter_red_id = ?, winner_id = ?
                    WHERE category  = ?
                ");

                return $stmt->execute([$fighter_red, $fighter_red, $category_id]);
            }
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

            return $stmt->fetchAll();
        }
    }
?>