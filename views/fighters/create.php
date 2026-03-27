<?php
require_once __DIR__ . '/../../config/url.php';
require_once CONFIG_PATH . 'assets.php';
add_css('FighterAdd.css');
require '../../models/fighter.php';
require VIEWS_PATH . 'Layout/header.php';
?>

<section class="fighter-form">
    <h1>Registrar Lutador</h1>

    <!-- ===== FORM INDIVIDUAL ===== -->
    <form action="<?= CONTROLLERS_URL ?>fighterController.php" method="POST" class="single">
        <input type="hidden" name="action" value="create">

        <div>
            <label for="name">Nome</label>
            <input id="name" name="fighter_name" type="text" placeholder="Ex: João Silva" required>
        </div>

        <div>
            <span>Sexo</span>
            <div class="radio-group">
                <label><input type="radio" name="sex" value="masc" required> Masc</label>
                <label><input type="radio" name="sex" value="fem"> Fem</label>
            </div>
        </div>

        <div>
            <label for="peso">Peso (kg)</label>
            <input id="peso" name="fighter_peso" type="number" step="0.01" min="1" max="200" required>
        </div>

        <div>
            <label for="idade">Idade</label>
            <input id="idade" name="idade" type="number" min="4" max="100" required>
        </div>

        <div>
            <label for="faixa">Faixa</label>
            <select id="faixa" name="faixa" required>
                <option value="">Selecione</option>
                <option value="branca">Branca</option>
                <option value="cinza">Cinza</option>
                <option value="amarela">Amarela</option>
                <option value="laranja">Laranja</option>
                <option value="verde">Verde</option>
                <option value="azul">Azul</option>
                <option value="roxa">Roxa</option>
                <option value="marrom">Marrom</option>
                <option value="preta">Preta</option>
            </select>
        </div>

        <div>
            <label for="linha">Linha</label>
            <select id="linha" name="linha">
                <option value="null">Selecione</option>
                <option value="preta">Linha preta</option>
                <option value="branca">Linha branca</option>
            </select>
        </div>

        <button type="submit">Salvar</button>
    </form>

    <hr>

    <!-- ===== IMPORTAÇÃO CSV ===== -->
    <h2>Importar vários lutadores</h2>
    <p>
        Formato do CSV:
        <code>nome,peso,faixa,linha,idade;</code><br>
        Ex: <code>João,72.5,azul,preta,18;</code><br>
        O sexo será aplicado a todos os atletas.
    </p>

    <form action="<?= BASE_URL ?>/cadastro.php" method="POST" enctype="multipart/form-data" class="batch">
        <input type="hidden" name="action" value="pluriCreate">

        <div>
            <span>Sexo dos atletas</span>
            <div class="radio-group">
                <label><input type="radio" name="sex" value="masc" required> Masc</label>
                <label><input type="radio" name="sex" value="fem"> Fem</label>
            </div>
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