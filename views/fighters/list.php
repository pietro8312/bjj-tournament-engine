<?php 
    add_css('comp.css'); 
    add_js('main_manager.js');
    require 'views/Layout/header.php';
?>

<?php if(!empty($fighters)):?>
    <section id="comp_area">

    <?php foreach ($fighters as $f) : ?>
        <a href="<?=VIEWS_URL?>fighters/edit.php?id=<?=$f['id']?>" class="comp" data-sex="<?= htmlspecialchars($f['sex']) ?>">
            <h1><?= htmlspecialchars($f['name']) ?></h1>
            <i class="sex"><?= htmlspecialchars($f['sex']) ?></i>               
            <p class="peso"><?= htmlspecialchars($f['weight']) ?></p>
            <p class="faixa"><?= htmlspecialchars($f['name_faixa']) ?></p>
            <p class="categoria"><?= htmlspecialchars($f['category']) ?></p>
        </a>
    <?php endforeach; ?>
    </section>

<?php else:?>
    <h1 id="bg-title">Atletas nao encontrados</h1>
<?php endif;?>

<?php require 'views/Layout/footer.php'?>