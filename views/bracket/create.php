<main>
    <section class="bracket-create">

        <!-- <form id="bracketForm" action="<?= BASE_URL ?>/bracket" method="POST">
            <input type="hidden" name="action" value="generateAll">

            <div class="form-group">
                <label>Modo:</label>
                <select name="mode">
                    <option value="auto">Automático</option>
                    <option value="valid_only">Somente válidas</option>
                    <option value="force">Forçar todas</option>
                </select>
            </div>

            <div class="form-group">
                <label>Mínimo de atletas:</label>
                <input type="number" name="min_fighters" value="2" min="2">
            </div> -->

            <!-- <div class="form-group">
                <label>Tipo de chave:</label>
                <select name="bracket_type">
                    <option value="single">Eliminação simples</option>
                    <option value="double">Eliminação dupla</option>
                    <option value="round_robin">Todos contra todos</option>
                </select>
            </div>

            <div class="form-group">
                <label>Agrupar por:</label><br>
                <label><input type="checkbox" name="group_by_age" checked> Idade</label>
                <label><input type="checkbox" name="group_by_weight" checked> Peso</label>
                <label><input type="checkbox" name="group_by_belt" checked> Faixa</label>
                <label><input type="checkbox" name="group_by_gender" checked> Sexo</label>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="merge_small_categories" checked>
                    Unir categorias pequenas
                </label>
            </div>

            <div class="form-group">
                <label>Limite para união:</label>
                <input type="number" name="merge_threshold" value="3">
            </div>

            <div class="form-group">
                <label>Seeding:</label>
                <select name="seeding">
                    <option value="random">Aleatório</option>
                    <option value="rank">Por ranking</option>
                </select>
            </div> 
            <div class="form-group">
                <button class="btn-primary" type="submit">Gerar</button>
            </div>
        </form>
        -->

        <h1>Novo Chaveamento</h1>
        
        <form id="bracketForm" action="<?= BASE_URL ?>/bracket" method="POST">
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
                <select name="category_m" id="M_categ" class="hide select">
                    <option value="">Selecione a categoria</option>

                    <!-- Adulto -->
                    <option value="1">Galo</option>
                    <option value="2">Pluma</option>
                    <option value="3">Pena</option>
                    <option value="4">Leve</option>
                    <option value="5">Médio</option>
                    <option value="6">Meio Pesado</option>
                    <option value="7">Pesado</option>
                    <option value="8">Super Pesado</option>
                    <option value="9">Pesadíssimo</option>

                    <!-- Infantil A -->
                    <option value="18">Até 18kg</option>
                    <option value="19">18 a 22kg</option>
                    <option value="20">22 a 26kg</option>
                    <option value="21">Acima de 26kg</option>

                    <!-- Infantil B -->
                    <option value="22">Até 20kg</option>
                    <option value="23">20 a 25kg</option>
                    <option value="24">25 a 30kg</option>
                    <option value="25">Acima de 30kg</option>

                    <!-- Infantil C -->
                    <option value="26">Até 25kg</option>
                    <option value="27">25 a 30kg</option>
                    <option value="28">30 a 35kg</option>
                    <option value="29">35 a 40kg</option>
                    <option value="30">Acima de 40kg</option>

                    <!-- Infantil D -->
                    <option value="31">Até 30kg</option>
                    <option value="32">30 a 35kg</option>
                    <option value="33">35 a 40kg</option>
                    <option value="34">40 a 45kg</option>
                    <option value="35">Acima de 45kg</option>

                    <!-- Infanto-Juvenil -->
                    <option value="36">Até 35kg</option>
                    <option value="37">35 a 40kg</option>
                    <option value="38">40 a 45kg</option>
                    <option value="39">45 a 50kg</option>
                    <option value="40">50 a 55kg</option>
                    <option value="41">Acima de 55kg</option>

                </select>
            </div>

           
            <div class="form-group">
                <select name="category_f" id="F_categ" class="hide select">
                    <option value="">Selecione a categoria</option>

                    <!-- Adulto -->
                    <option value="10">Galo</option>
                    <option value="11">Pluma</option>
                    <option value="12">Pena</option>
                    <option value="13">Leve</option>
                    <option value="14">Médio</option>
                    <option value="15">Meio Pesado</option>
                    <option value="16">Pesado</option>
                    <option value="17">Super Pesado</option>

                    <!-- Infantil A -->
                    <option value="42">Até 18kg</option>
                    <option value="43">18 a 22kg</option>
                    <option value="44">22 a 26kg</option>
                    <option value="45">Acima de 26kg</option>

                    <!-- Infantil B -->
                    <option value="46">Até 20kg</option>
                    <option value="47">20 a 25kg</option>
                    <option value="48">25 a 30kg</option>
                    <option value="49">Acima de 30kg</option>

                    <!-- Infantil C -->
                    <option value="50">Até 25kg</option>
                    <option value="51">25 a 30kg</option>
                    <option value="52">30 a 35kg</option>
                    <option value="53">35 a 40kg</option>
                    <option value="54">Acima de 40kg</option>

                    <!-- Infantil D -->
                    <option value="55">Até 30kg</option>
                    <option value="56">30 a 35kg</option>
                    <option value="57">35 a 40kg</option>
                    <option value="58">40 a 45kg</option>
                    <option value="59">Acima de 45kg</option>

                    <!-- Infanto-Juvenil -->
                    <option value="60">Até 35kg</option>
                    <option value="61">35 a 40kg</option>
                    <option value="62">40 a 45kg</option>
                    <option value="63">45 a 50kg</option>
                    <option value="64">50 a 55kg</option>
                    <option value="65">Acima de 55kg</option>

                </select>
            </div>

            
            <div class="form-group">
                <label for="age">Divisão de Idade</label>
                <select name="age_division" id="age" required>
                    <option value="">Selecione a idade</option>
                    <option value="8">master 6</option>
                    <option value="7">master 5</option>
                    <option value="6">master 4</option>
                    <option value="5">master 3</option>
                    <option value="4">master 2</option>
                    <option value="3">master 1</option>

                    <option value="2">adulto</option>
                    <option value="1">juvenil</option>
                    <option value="9">Infantil A</option>
                    <option value="10">Infantil B</option>
                    <option value="11">Infantil C</option>
                    <option value="12">Infantil D</option>
                    <option value="13">Infanto-juvenil</option>
                </select>
            </div>

            
            <div class="form-group">
                <label for="belt">Faixa</label>
                <select name="belt" id="belt" required>
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

           
            <input type="hidden" name="category" id="category" value="">

           
            <div id="fighters-info">
                <p id="lutadores"></p>
            </div>

            <button type="submit" class="btn-primary">Gerar Chaveamento</button>
        </form>
    </section>
</main>


