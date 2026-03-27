<?php 
    require_once __DIR__ . '/../../config/url.php'; 
    require_once CONFIG_PATH . 'assets.php';
    $currentPage = basename($_SERVER['SCRIPT_NAME']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sistema de Torneio</title>

<link rel="stylesheet" href="<?= ASSETS_URL ?>global.css">
<link rel="stylesheet" href="<?= ASSETS_URL ?>header.css">

<?php
if(function_exists('render_css')){
    render_css();
}

if(function_exists('render_js')){
    render_js();
}
?>

</head>

<body>

<header class="main-header">

    <nav class="header-nav">

        <a href="<?= BASE_URL ?>/main.php">Home</a>

        <a href="<?= BASE_URL ?>/bracket">
            Torneios
        </a>

        <a href="<?= BASE_URL ?>/fighters">
            + Lutador
        </a>

    </nav>

    <?php if($currentPage === 'main.php'): ?>

        <form id="search" role="search" action="<?= BASE_URL ?>/main.php" method="GET">

            <input
                id="q"
                name="search"
                type="search"
                placeholder="Pesquisar lutador..."
            >

        </form>

    <?php endif; ?>

</header>