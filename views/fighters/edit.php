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