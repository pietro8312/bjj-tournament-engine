<?php 

class Fighter {
    public static function all($conn) {
        return $conn->query("SELECT f.*, c.name AS category_name FROM fighters f INNER JOIN categories c ON f.category_id = c.id")->fetchALL();
    }

    public static function update($conn, $data) {
        $stmt = $conn ->prepare("
            SELECT id 
            FROM categories 
            WHERE sex = ? AND ? BETWEEN min_weight AND max_weight
            LIMIT 1
        ");

        $stmt->execute([$data['sex'], $data['fighter_peso']]);

        $category_id = $stmt->fetchColumn();

        if(!$category_id) {
            # function peso invalido
        }

        $stmt = $conn->prepare("
            UPDATE fighters f
            SET f.name = ?, f.weight = ?, f.sex = ?, f.faixa = ?, f.category_id = ?
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['fighter_name'],
            $data['fighter_peso'],
            $data['sex'],
            $data['faixa'],
            $category_id,
            $data['fighter_id']
        ]);

    }

    public static function delete($conn, $id){
        $stmt = $conn->prepare("
            delete from fighters where id = ?
        ");

        return $stmt->execute([$id]);
    }

    public static function search($conn, $params) {
        $stmt = $conn->prepare("
            SELECT 
                f.name,
                f.weight,
                f.sex,
                f.faixa,
                c.name AS category_name
            FROM 
                fighters f
            INNER JOIN 
                categories c ON f.category_id = c.id
            WHERE 
                f.name LIKE ?
        ");

        $search = "%" . $params . "%";

        $stmt->execute([$search]);

        return $stmt->fetchAll();
    }

    public static function countByCategory($conn,  $category_id) {
        $stmt = $conn->prepare("
            SELECT count(id) FROM fighters WHERE category_id = ?
        ");

        return $stmt->execute([$category_id]);
    }
}

?>