<?php 

class Fighter {
    public static function all($conn) {
        return $conn->query("
            SELECT 
                f.*,
                CONCAT(b.faixa, ' ', COALESCE(b.linha, '')) AS name_faixa,
                CONCAT(a.name, ' - ', w.name, ' - ', w.sex) AS category
            FROM fighters f
                join categories c ON f.category_id = c.id
                join age_division a ON c.age_division = a.id
                join weight_division w ON c.weight_division = w.id
                join belt b ON f.faixa = b.id
        ")->fetchALL();
    }

    public static function search($conn, $params) {
    $stmt = $conn->prepare("
        SELECT 
            f.*,
            CONCAT(b.faixa, ' ', COALESCE(b.linha, '')) AS name_faixa,
            CONCAT(a.name, ' - ', w.name, ' - ', w.sex) AS category
        FROM fighters f
            join categories c ON f.category_id = c.id
            join age_division a ON c.age_division = a.id
            join weight_division w ON c.weight_division = w.id
            join belt b ON f.faixa = b.id
        WHERE 
            f.name LIKE ?
    ");

    $search = "%" . $params . "%";

    $stmt->execute([$search]);

    return $stmt->fetchAll();
    }

    public static function categ($conn, $idade, $sex, $peso){
        // determine category id based ON sex AND weight
        $stmt = $conn ->prepare("
            SELECT 
                c.id,
                a.name AS age_name,
                w.name AS weight_name,
                w.sex AS sex,
                CONCAT(a.name, ' - ', w.name, ' - ', w.sex) AS category_name
            FROM categories c
                JOIN age_division a ON c.age_division = a.id
                JOIN weight_division w ON c.weight_division = w.id
            WHERE
                w.sex = ?
                AND ? BETWEEN a.min_age AND a.max_age
                AND (
                    (? BETWEEN w.min_weight AND w.max_weight)
                    OR (w.max_weight IS NULL AND ? >= w.min_weight)
                )
            LIMIT 1
        ");


        $stmt->execute([$sex, $idade, $peso, $peso]);
        return $stmt->fetchColumn();
    }

    public static function easyCateg($conn, $id_weight, $id_age){
        $stmt = $conn->prepare("SELECT id FROM categories where weight_division = ? and age_division = ?");
        $stmt->execute([$id_weight, $id_age]);
        return $stmt->fetchColumn();
    }

    public static function belt($conn, $faixa, $linha){
        if($linha === 'null'){
            $stmt = $conn->prepare("SELECT id FROM belt WHERE faixa = ?");
            $stmt->execute([$faixa]);
        }else{
            $stmt = $conn->prepare("SELECT id FROM belt WHERE faixa = ? AND linha = ?");
            $stmt->execute([$faixa, $linha]);
        }
        return $stmt->fetchColumn();
    }

    public static function update($conn, $data) {
        $category_id = Fighter::categ($conn, $data['idade'], $data['sex'],$data['fighter_peso']);

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
        $category_id = Fighter::categ($conn, $data['idade'], $data['sex'], $data['fighter_peso']);
        $faixa = Fighter::belt($conn, $data['faixa'], $data['linha']);

        if (!$data['faixa'] || !$data['idade']) {
            exit(header(MODELS_PATH . 'fighter.php'));
        }

        $stmt = $conn->prepare("
            INSERT INTO fighters (name, weight, sex, faixa, category_id)
            VALUES (?, ?, ?, ?, ?)
        ");

        var_dump($data);

        return $stmt->execute([
            $data['fighter_name'],
            $data['fighter_peso'],
            $data['sex'],
            $faixa,
            $category_id
        ]);
    }

    public static function delete($conn, $id){
        $stmt = $conn->prepare("
            DELETE FROM fighters WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }

    public static function countByCategory($conn,  $category_id, $faixa, $age_division) {
        $stmt = $conn->prepare("
            SELECT count(f.id) 
            FROM fighters f
            join categories c on f.category_id = c.id
            join belt b on f.faixa = b.id
            WHERE c.weight_division = ? and c.age_division = ? and b.id = ?
        ");

        $stmt->execute([$category_id, $age_division, $faixa]);
        return $stmt->fetchColumn();
    }

    public static function fighterByCategory($conn, $category_id, $faixa){
        $stmt = $conn->prepare("
            SELECT 
                f.id,
                f.faixa
            FROM fighters f
            JOIN categories c ON f.category_id = c.id
            JOIN belt b ON f.faixa = b.id
            JOIN belt b_ref ON b_ref.id = ?
            WHERE 
                c.id = ?
                AND (
                    -- Agrupa normalmente
                    (b_ref.grupo != 'fim' AND b.grupo = b_ref.grupo)

                    OR

                    -- Grupo fim → comparação exata
                    (b_ref.grupo = 'fim' AND b.id = b_ref.id)
                );
        ");

        $stmt->execute([$faixa, $category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?> 