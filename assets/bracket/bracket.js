const bracketForm = document.getElementById('bracketForm');
const sex = document.getElementById('sex');
const fem_categ = document.getElementById('F_categ');
const mas_categ = document.getElementById('M_categ');

const lutadores = document.getElementById('lutadores');
let category;

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