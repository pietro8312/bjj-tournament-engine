<?php 
    require_once "connection.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="edit.css">
    <script src="main_manager.js" defer></script>
    <title>Document</title>
</head>
<body>
    <header>
        <form id="search" role="search" action="#" method="POST">
            <label class="sr-only" for="q">Pesquisar</label>
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11 6C13.7614 6 16 8.23858 16 11M16.6588 16.6549L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            <input id="q" name="q" type="search" placeholder="Pesquisar..." aria-label="Pesquisar">
        </form>
        <a href="cadastro.php">Torneio</a>
    </header>

    <section id="comp_area">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST" & isset($_POST['q'])){
                $search = $_POST['q'];
                
                $sql = "SELECT fighters.id as f_id, fighters.name as f_name, fighters.faixa as f_faixa, fighters.sex as f_sex, categories.name as c_name from fighters inner join categories on fighters.category_id = categories.id where fighters.name is not null and fighters.name LIKE ? or categories.name = ? or faixa = ?";

                $stmt = $conn->prepare($sql);
                $stmt->execute(["%$search%", $search, $search]);

                $atletas = $stmt->fetchAll(PDO::FETCH_OBJ);
            }else{
                $sql = "SELECT fighters.id as f_id, fighters.name as f_name, fighters.faixa as f_faixa, fighters.sex as f_sex, categories.name as c_name from fighters inner join categories on fighters.category_id = categories.id where fighters.name is not null";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $atletas = $stmt->fetchAll(PDO::FETCH_OBJ);
            }

            if(!empty($atletas)){
                foreach($atletas as $a){
                    $nome = $a -> f_name;
                    if(isset($name)){
                        return;
                    }
                    $f_id = $a -> f_id;
                    $faixa = $a -> f_faixa;
                    $sex = $a -> f_sex[0];
                    $categoria = $a -> c_name;
            
                    include 'comp.php';
                }   
            }else{
                echo '<h1 id="bg-title">Atletas nao encontrados</h1>'; 
            }
        ?>
    </section>

<?php 
    if (!isset($_GET['id'])) {
        exit;
    }

    $id = $_GET['id'];

    $sql = "SELECT fighters.name as f_name, fighters.sex as f_sex, fighters.faixa as f_faixa, fighters.weight as f_peso, categories.name as c_name from fighters inner join categories on fighters.category_id = categories.id where fighters.id = ?";
    $stmt =  $conn->prepare($sql);
    $stmt->execute([$id]);

    $e = $stmt->fetch(PDO::FETCH_ASSOC);

    $f_name = $e['f_name'];
    $f_sex = $e['f_sex'];
    $f_faixa = $e['f_faixa'];
    $f_peso = $e['f_peso'];
    $c_name = $e['c_name'];

    include 'edit.php';
?>
</body>
</html>

<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        echo $_POST['fighter_peso'];
    }
?>