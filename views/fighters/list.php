<?php 
    add_css('comp.css'); 
    add_js('main_manager.js');
    require 'views/Layout/header.php';
?>

<?php if(!empty($fighters)):?>
    <section id="comp_area">

    <?php foreach ($fighters as $f) : ?>
        <span class="comp" data-sex="<?= htmlspecialchars($f['sex']) ?>">
            <i class="hide"><?= htmlspecialchars($f['id']) ?></i>
            <h1><?= htmlspecialchars($f['name']) ?></h1>
            <i class="sex"><?= htmlspecialchars($f['sex']) ?></i>
            <p class="peso"><?= htmlspecialchars($f['weight']) ?></p>
            <p class="faixa"><?= htmlspecialchars($f['name_faixa']) ?></p>
            <p class="categoria"><?= htmlspecialchars($f['category']) ?></p>
        </span>
    <?php endforeach; ?>
    </section>

<?php else:?>
    <h1 id="bg-title">Atletas nao encontrados</h1>
<?php endif;?>

<?php require 'views/Layout/footer.php'?>