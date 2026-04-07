<?php
    require_once __DIR__ . '/../../config/url.php';
    require_once CONFIG_PATH . 'assets.php';
    require_once MODELS_PATH . 'fighter.php';
    add_css('edit.css');
    add_js('edit.js');
    require_once VIEWS_PATH . 'layout/header.php';

    require_once CONFIG_PATH . 'connection.php';
    $conn = Database::connect();
    $fighter = Fighter::fighterById($conn, $_GET['id']);

?>
<form action="<?=CONTROLLERS_URL?>fighterController.php" id="formEdit" method="POST">
    <a href="<?=BASE_URL?>/main.php">
        <svg class="close"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-label="Fechar">

            <g stroke-width="0"></g>
            <g stroke-linecap="round" stroke-linejoin="round"></g>

            <g>
                <path
                    d="M16 16L12 12M12 12L8 8M12 12L16 8M12 12L8 16"
                    stroke="#000000"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                </path>
            </g>
        </svg>
    </a>

    <input  id="id" type="hidden" name="fighter_id" class="hide" value="<?=htmlspecialchars($fighter['id'])?>">

    <input type="hidden" name="action" value="update">

    <input
        id="name"
        type="text"
        name="fighter_name"
        value="<?=htmlspecialchars($fighter['name'])?>"
    >

    <p class="sex" data-enviar="sex">
        <?=htmlspecialchars($fighter['sex'])?>
    </p>

    <p class="categ">
        <?=htmlspecialchars($fighter['category'])?>
    </p>

    <input type="number" name="age" value="<?=htmlspecialchars($fighter['age'])?>">

    <input
        id="peso"
        type="number"
        name="fighter_peso"
        class="peso"
        value="<?=htmlspecialchars($fighter['weight'])?>"
    >

    <i class="hide" id="defaultFaixa"><?=htmlspecialchars($fighter['faixa'])?></i>

    <div id="divfaixa">
        <select class="faixa" name="belt" id="belt" required>
            <option value="">Selecione a faixa</option>
            <option value="18">Branca</option>
            <option value="19">Cinza linha branca</option>
            <option value="20">Cinza</option>
            <option value="21">Cinza linha preta</option>
            <option value="22">Amarela linha branca</option>
            <option value="23">Amarela</option>
            <option value="24">Amarela linha preta</option>
            <option value="25">Laranja linha branca</option>
            <option value="26">Laranja</option>
            <option value="27">Laranja linha preta</option>
            <option value="28">Verde linha branca</option>
            <option value="29">Verde</option>
            <option value="30">Verde linha preta</option>
            <option value="31">Azul</option>
            <option value="32">Roxa</option>
            <option value="33">Marrom</option>
            <option value="34">Preta</option>
        </select>
    </div>

    <input type="hidden" class="hide" name="sex" id="inputSex" value="">
    <span class="btn">
        <a id="submit" href="<?=CONTROLLERS_URL?>fighterController.php?action=delete&id=<?=htmlspecialchars($fighter['id'])?>" class="delete">Delete</a>
        <input type="submit" name="confirm" class="confirm">
    </span>

</form>