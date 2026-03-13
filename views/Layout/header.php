<?php require_once __DIR__ . '/../../config/url.php'; ?>

<?php
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
?>

<?php if($currentPage === 'main.php'): ?>
    <script src="<?= ASSETS_URL ?>main_manager.js" defer></script>
<?php else :?>
<script src="<?= ASSETS_URL ?>/bracket/bracket.js" defer></script>
<?php endif; ?>

</head>

<body>

<header class="main-header">

    <nav class="header-nav">

        <a href="<?= BASE_URL ?>/main.php">Home</a>

        <a href="<?= CONTROLLERS_URL ?>bracketController.php?action=all">
            Torneios
        </a>

        <a href="<?= BASE_URL ?>/views/fighters/create.php">
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