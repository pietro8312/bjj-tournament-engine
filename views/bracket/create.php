<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bracket/tournament-create.css">
    <script src="../../assets/bracket/bracket.js" defer></script>
    <title>Criar Chaveamento</title>
</head>
<body>
    <header>
        <h1>⚔️ Criar Chaveamento</h1>
    </header>

    <main>
        <section class="bracket-create">
            <h1>Novo Chaveamento</h1>
            
            <form id="bracketForm" action="../../controllers/bracketController.php" method="POST">
                <input type="hidden" name="action" value="generate">
                
                <div class="form-group">
                    <label for="sex">Sexo do Atleta</label>
                    <select name="sex" id="sex" required>
                        <option value="">Selecione o sexo</option>
                        <option value="fem">Feminino</option>
                        <option value="masc">Masculino</option>
                    </select>
                </div>

                <div class="form-group">
                    <select name="category_m" id="M_categ" class="hide select" required>
                        <option value="">Selecione a categoria</option>
                        <option value="1">Galo</option>
                        <option value="2">Pluma</option>
                        <option value="3">Pena</option>
                        <option value="4">Leve</option>
                        <option value="5">Médio</option>
                        <option value="6">Meio Pesado</option>
                        <option value="7">Pesado</option>
                        <option value="8">Super Pesado</option>
                        <option value="9">Pesadíssimo</option>
                    </select>
                </div>

                <div class="form-group">
                    <select name="category_f" id="F_categ" class="hide select" required>
                        <option value="">Selecione a categoria</option>
                        <option value="10">Galo</option>
                        <option value="11">Pluma</option>
                        <option value="12">Pena</option>
                        <option value="13">Leve</option>
                        <option value="14">Médio</option>
                        <option value="15">Meio Pesado</option>
                        <option value="16">Pesado</option>
                    </select>
                </div>

                <div id="fighters-info">
                    <p id="lutadores"></p>
                </div>

                <button type="submit" class="btn-primary">Gerar Chaveamento</button>
            </form>
        </section>

        <section class="brackets-list">
            <h2>Chaveamentos Existentes</h2>
            <?php 
                #chamar uma list.php dos chaveamentos
            ?>
            <div id="brackets-container">
                <p class="empty-state">Nenhum chaveamento existente</p>
            </div>
        </section>
    </main>
</body>
</html>