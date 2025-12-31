<?php 
    require_once "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivo</title>
    <link rel="stylesheet" href="ini.css">
</head>
<body>
    <h1>Enviar Arquivo</h1>
    
    <form method="POST" enctype="multipart/form-data">
        <label for="sex">Fem</label>
        <input type="radio" name="sex" id="">
        <label for="sex">Masc</label>
        <input type="radio" name="sex" id="">
        <label for="arquivo">Escolha um arquivo:</label>
        <input type="file" id="arquivo" name="arquivo" required>
        
        <button type="submit">Enviar</button>
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){

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

            $conteudo = str_replace(["\r", "\n"], "", $conteudo);

            // le um arquivo txt e transforma e uma linha so

            $pesosMasc = [ 
                (object) ["categoria" => "galo", "pesoMax" => 57.5], 
                (object) ["categoria" => "pluma", "pesoMax" => 64], 
                (object) ["categoria" => "pena", "pesoMax" => 70], 
                (object) ["categoria" => "leve", "pesoMax" => 76], 
                (object) ["categoria" => "medio", "pesoMax" => 82.3], 
                (object) ["categoria" => "meio-pesado", "pesoMax" => 88.3], 
                (object) ["categoria" => "pesado", "pesoMax" => 94.3], 
                (object) ["categoria" => "super-pesado", "pesoMax" => 100.5], 
                (object) ["categoria" => "pesadissimo", "pesoMax" => 1000000000000000.9] 
            ];

            $pesosFem = [
                (object) ["categoria" => "galo", "pesoMax" => 48.5],
                (object) ["categoria" => "pluma", "pesoMax" => 53.5],
                (object) ["categoria" => "pena", "pesoMax" => 58.5],
                (object) ["categoria" => "leve", "pesoMax" => 64],
                (object) ["categoria" => "medio", "pesoMax" => 69],
                (object) ["categoria" => "meio-pesado", "pesoMax" => 74],
                (object) ["categoria" => "pesado", "pesoMax" => 1000000000000000.9]
            ];

            $atletas = array_map(function ($item) {
                list($nome, $peso, $faixa) = explode(",", $item);
                return (object) [
                    "nome" => $nome,
                    "peso" => (float) $peso,
                    "faixa" => $faixa,
                    "categoria" => ""
                ];
            }, array_filter(explode(";", $conteudo)));


            for ($i=0; $i < count($atletas); $i++) { 
                $a = $atletas[$i];

                for ($j=0; $j < count($pesosMasc); $j++) {
                    $reg = $pesosMasc[$j];

                    if($a -> peso <= $reg -> pesoMax){
                        $a-> categoria = $reg -> categoria;
                        break;
                    }
                }
            }

            
            foreach($atletas as $a){
                $nome = $a -> nome;
                $categoria = $a -> categoria;
                $faixa = $a -> faixa;

                $sql = "INSERT INTO fighters (name, faixa, categoria) values (?, ?, ?)";
                $stmt = $conn->prepare($sql);

                $stmt->execute([$nome, $faixa, $categoria]);
            }   

            header("Location: main.php");
            exit;
        }
    ?>
</body>
</html>