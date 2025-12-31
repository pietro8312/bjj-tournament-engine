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
    <script src="call.js" defer type="module"></script>
    <title>Document</title>
</head>
<body>
    <header>
        <form id="search" role="search" action="#" method="get">
            <label class="sr-only" for="q">Pesquisar</label>
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11 6C13.7614 6 16 8.23858 16 11M16.6588 16.6549L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            <input id="q" name="q" type="search" placeholder="Pesquisar..." aria-label="Pesquisar">
        </form>
        <a href="ini.php">Torneio</a>
    </header>

    <?php 
        foreach($_SESSION['atletas'] as $a){
            $nome = $a -> nome;
            $categoria = $a -> categoria;
            $faixa = $a -> faixa;

            include 'comp.php';
        }
    ?>
</body>
</html>