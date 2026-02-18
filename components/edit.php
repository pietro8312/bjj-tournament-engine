<section id="edit">
    <form action="" id="formEdit" method="POST">
        <svg class="close" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <g id="Menu / Close_SM">
                    <path id="Vector" d="M16 16L12 12M12 12L8 8M12 12L16 8M12 12L8 16" stroke="#000000" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </g>
        </svg>

        <input id="name" type="text" name="fighter_name" value="<?= htmlspecialchars($f_name, ENT_QUOTES, 'UTF-8') ?>">
        <p class="sex" data-enviar='sex'><?= htmlspecialchars($f_sex, ENT_QUOTES, 'UTF-8') ?></p>
        <p class="categ"><?= htmlspecialchars($c_name, ENT_QUOTES, 'UTF-8') ?></p>
        <input id="peso" type="number" name="fighter_peso" value="<?= htmlspecialchars($f_peso, ENT_QUOTES, 'UTF-8') ?>"class="peso">
        <p class="faixa" data-enviar='faixa'><?= htmlspecialchars($f_faixa, ENT_QUOTES, 'UTF-8') ?></p>
        <span class="btn">
            <input type="reset" value="cancel" class="cancel">
            <input type="submit" value="confirm" name="confirm" class="confirm">
        </span>
    </form>    
</section>