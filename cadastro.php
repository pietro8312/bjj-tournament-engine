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

            if(count($fighter) !== 5){
                continue;
            }

            $name = $fighter[0];
            $faixa = $fighter[2];
            $linha = $fighter[3] ?: null;
            $weight = $fighter[1];
            $idade = $fighter[4];

            $data = [
                'fighter_name' => $name,
                'fighter_peso' => $weight,
                'idade' => $idade,
                'sex' => $sex,
                'faixa' => $faixa,
                'linha' => $linha
            ];

            Fighter::create($conn, $data);
        }

        header('location: /proj-irene/main.php');
    }
?>