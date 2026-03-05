<?php 
    require 'config/connection.php';
    require 'models/fighter.php';
    $conn = Database::connect();

    if($_POST["action"] == 'pluriCreate'){

        if(!isset($_FILES['arquivo'])){
            die("nenhum arquivo encontrado");
        }

        $arquivo = $_FILES['arquivo'];

        if ($arquivo['error'] !== UPLOAD_ERR_OK) {
            die("Erro no upload: " . $arquivo['error']);
        }   

        $conteudo = file_get_contents($arquivo['tmp_name']);

        if ($conteudo === false) {
            die("Erro ao ler o arquivo");
        }

        $sex = $_POST['sex'];

        $conteudo = str_replace(["\r", "\n"], "", $conteudo);

        $conteudo = explode(';', $conteudo);

        
        foreach ($conteudo as $c) {

            $fighter = explode(',', $c);

            if(count($fighter) !== 3){
                continue;
            }

            $name = $fighter[0];
            $faixa = $fighter[2];
            $weight = $fighter[1];

            $cat_id = Fighter::categ($conn, $sex, $weight);

            $cat_id = (INT) $cat_id;

            $data = [
                'fighter_name' => $name,
                'fighter_peso' => $weight,
                'sex' => $sex,
                'faixa' => $faixa
            ];

            Fighter::create($conn, $data);

            $sql = 'INSERT INTO fighters (name, sex, faixa, weight, category_id) values (?, ?, ?, ?, ?)';

            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $sex, $faixa, $weight, $cat_id]);
        }
    }
    
    header('location: main.php');
    exit;
?>