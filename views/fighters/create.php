<?php
    require_once __DIR__ . '/../../config/url.php';
    require_once CONFIG_PATH . 'assets.php';
    add_css('FighterAdd.css');
    require '../../models/fighter.php';
    require VIEWS_PATH . 'Layout/header.php'
?>

    <section class="fighter-form">
        <h1>Registrar Lutador</h1>
        <form action="../../controllers/fighterController.php" method="POST" class="single">
            <input type="hidden" name="action" value="create">
            <div>
                <label for="name">Nome</label>
                <input id="name" name="fighter_name" type="text" required>
            </div>
            <div>
                <span>Sexo</span>
                <label><input type="radio" name="sex" value="masc" required> Masc</label>
                <label><input type="radio" name="sex" value="fem"> Fem</label>
            </div>
            <div>
                <label for="peso">Peso (kg)</label>
                <input id="peso" name="fighter_peso" type="number" step="0.1" required>
            </div>
            <div>
                <label for="faixa">Faixa / Graduação</label>
                <input id="faixa" name="faixa" type="text">
            </div>
            <button type="submit">Salvar</button>
        </form>

        <hr>

        <h2>Importar vários lutadores</h2>
        <p>Envie um arquivo CSV com linhas no formato <code>nome,peso,faixa</code>. Você deve selecionar o sexo comum a todos os atletas.</p>
        <form action="../../cadastro.php" method="POST" enctype="multipart/form-data" class="batch">
            <input type="hidden" name="action" value="pluriCreate">
            <div>
                <span>Sexo dos atletas</span>
                <label><input type="radio" name="sex" value="masc" required> Masc</label>
                <label><input type="radio" name="sex" value="fem"> Fem</label>
            </div>
            <div>
                <label for="arquivo">Arquivo CSV</label>
                <input id="arquivo" type="file" name="arquivo" accept=".csv" required>
            </div>
            <button type="submit">Importar</button>
        </form>
    </section>
</body>
</html>