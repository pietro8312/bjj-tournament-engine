<?php 
    require_once "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivo</title>
    <script src="cadastroHandler.js"></script>
    <link rel="stylesheet" href="ini.css">
</head>

<body>
    <h1>Enviar Arquivo</h1>

    <form method="POST" enctype="multipart/form-data" id="cadasForm">
        <label for="sex">Fem</label>
        <input type="radio" name="sex" id="" value="fem" required>
        <label for="sex">Masc</label>
        <input type="radio" name="sex" id="" value="masc">
        <label for="arquivo">Escolha um arquivo:</label>
        <input type="file" id="arquivo" name="arquivo" required>

        <button type="submit">Enviar</button>
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            return;

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

                $sql = "SELECT id, name FROM categories where sex = :sex and :weight BETWEEN min_weight and max_weight limit 1";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':weight' => $weight,
                    ':sex' => $sex
                ]);

                $cat_id = $stmt->fetch(PDO::FETCH_ASSOC);

                $cat_id = (INT) $cat_id['id'];

                $sql = 'INSERT INTO fighters (name, sex, faixa, weight, category_id) values (?, ?, ?, ?, ?)';

                $stmt = $conn->prepare($sql);
                $stmt->execute([$name, $sex, $faixa, $weight, $cat_id]);
            }

            exit;
            header('main.php');
        }
    ?>
</body>

</html>