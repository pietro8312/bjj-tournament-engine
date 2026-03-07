<?php 

class Fighter {
    public static function all($conn) {
        return $conn->query("SELECT f.*, c.name AS category_name FROM fighters f INNER JOIN categories c ON f.category_id = c.id")->fetchALL();
    }

    public static function categ($conn, $sex, $peso){
        // determine category id based on sex and weight
        $stmt = $conn ->prepare("
            SELECT id 
            FROM categories 
            WHERE sex = ? AND ? BETWEEN min_weight AND max_weight
            LIMIT 1
        ");

        $stmt->execute([$sex, $peso]);
        return $stmt->fetchColumn();

    }

    public static function update($conn, $data) {
        $category_id = Fighter::categ($conn, $data['sex'], $data['fighter_peso']);

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

    public static function create($conn, $data) {
        $category_id = Fighter::categ($conn, $data['sex'], $data['fighter_peso']);

        if (!$category_id) {
            // peso invalido, caller should handle this
        }

        $stmt = $conn->prepare("
            INSERT INTO fighters (name, weight, sex, faixa, category_id)
            VALUES (?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $data['fighter_name'],
            $data['fighter_peso'],
            $data['sex'],
            $data['faixa'],
            $category_id
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

        $stmt->execute([$category_id]);
        return $stmt->fetchColumn();
    }

    public static function fighterByCategory($conn, $category_id){
        $stmt = $conn->prepare("
            SELECT id FROM fighters WHERE category_id = ?
        ");

        $stmt->execute([$category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>