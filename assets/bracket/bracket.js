const bracketForm = document.getElementById('bracketForm');
const sex = document.getElementById('sex');
const fem_categ = document.getElementById('F_categ');
const mas_categ = document.getElementById('M_categ');

const lutadores = document.getElementById('lutadores');


// controlar qual categoria aparece
sex.addEventListener('change', () => {

    fem_categ.classList.add('hide');
    mas_categ.classList.add('hide');

    fem_categ.required = false;
    mas_categ.required = false;

    if(sex.value === 'fem'){
        fem_categ.classList.remove('hide');
        fem_categ.required = true;
    }
    else if(sex.value === 'masc'){
        mas_categ.classList.remove('hide');
        mas_categ.required = true;
    }

});


// função que busca os lutadores
function fetchFighters(category){

    const formData = new FormData();
    formData.append('action', 'contByCategory');
    formData.append('category_m', category);

    fetch('../../controllers/fighterController.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {

        lutadores.textContent = `Lutadores: ${data.fighters}`;

    });

}


// evento masculino
mas_categ.addEventListener('change', () => {

    const category = mas_categ.value;

    if(category){
        fetchFighters(category);
    }

});


// evento feminino
fem_categ.addEventListener('change', () => {

    const category = fem_categ.value;

    if(category){
        fetchFighters(category);
    }

});