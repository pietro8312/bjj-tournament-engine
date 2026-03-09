<?php if(!empty($brackets)) : ?>

<?php foreach($brackets as $b) : ?>
    <p class="hide"><?php htmlspecialchars($b['id'])?></p>
    <h1><?php htmlspecialchars($b['category'])?></h1>
    <p><?php htmlspecialchars($b['status'])?></p>
<?php endforeach;?>
<?php else :?>
    <h1>Nenhum chaveamento existente</h1>
<?php endif; ?>