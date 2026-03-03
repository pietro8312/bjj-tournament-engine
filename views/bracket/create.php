<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/style.css">
    <script src="../../assets/bracket/bracket_manager.js" defer></script>
    <title>Document</title>
</head>
<body>
    <header>
        <h1>chaveamento</h1>
    </header>
    <form action="">
        <!-- nao ta se conectando com o Banco pra pegar os id.s melhorar-->
        <select name="sex" id="sex">
            <option value="">SEX</option>
            <option value="fem">fem</option>
            <option value="masc">masc</option>
        </select>

        <select name="category" id="M_categ" class="hide">
            <option value="">CATEGORIAS</option>
            <option value="1">galo</option>
            <option value="2">pluma</option>
            <option value="3">pena</option>
            <option value="4">leve</option>
            <option value="5">medio</option>
            <option value="6">meio_pesado</option>
            <option value="7">pesado</option>
            <option value="8">Super_pesado</option>
            <option value="9">pesadíssimo</option>
        </select>
        <select name="category" id="F_categ" class="hide">
            <option value="">CATEGORIAS</option>
            <option value="10">galo</option>
            <option value="11">pluma</option>
            <option value="12">pena</option>
            <option value="13">leve</option>
            <option value="14">medio</option>
            <option value="15">meio_pesado</option>
            <option value="16">pesado</option>
        </select>

        <p id="lutadores"></p>
        <p id="lutas"></p>
        <input type="submit" value="submit">
    </form>
    <section>
        <!-- colocar aqui todas as chaves senao colocar nenhum chaveamento existente -->
        <h1>Nenhum chavemento existente</h1>
    </section>
</body>
</html>