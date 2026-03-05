<?php add_css('comp.css'); require 'views/Layout/header.php';?>

<section id="edit">
    <form action="controllers/fighterController.php" id="formEdit" method="POST">

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

        <input  id="id" type="hidden" name="fighter_id" class="hide">

        <input type="hidden" name="action" value="update">

        <input
            id="name"
            type="text"
            name="fighter_name"
            value=""
        >

        <p class="sex" data-enviar="sex">
        </p>

        <p class="categ">
        </p>

        <input
            id="peso"
            type="number"
            name="fighter_peso"
            class="peso"
            value=""
        >

        <p class="faixa" data-enviar="faixa">
            
        </p>

        <input type="hidden" class="hide" name="sex" id="inputSex" value="">
        <input type="hidden" class="hide" name="faixa" id="inputFaixa" value="">

        <span class="btn">
            <a href="" class="delete">Delete</a>
            <input type="submit" value="confirm" name="confirm" class="confirm">
        </span>

    </form>
</section>

<?php if(!empty($fighters)):?>
    <section id="comp_area">

    <?php foreach ($fighters as $f) : ?>
        <span class="comp" data-sex="<?= htmlspecialchars($f['sex']) ?>">
            <i id="hide"><?= htmlspecialchars($f['id']) ?></i>
            <h1><?= htmlspecialchars($f['name']) ?></h1>
            <i id="sex"><?= htmlspecialchars($f['sex']) ?></i>
            <p id="peso"><?= htmlspecialchars($f['weight']) ?></p>
            <p id="faixa"><?= htmlspecialchars($f['faixa']) ?></p>
            <p id="hide"><?= htmlspecialchars($f['category_name']) ?></p>
        </span>
    <?php endforeach; ?>
    </section>

<?php else:?>
    <h1 id="bg-title">Atletas nao encontrados</h1>
<?php endif;?>

<?php require 'views/Layout/footer.php'?>