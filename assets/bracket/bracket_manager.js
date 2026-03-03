const sex = document.getElementById('sex');
const fem_categ = document.getElementById('F_categ')
const mas_categ = document.getElementById('M_categ')

sex.addEventListener('change', () => {
    fem_categ.classList.add('hide');
    mas_categ.classList.add('hide');

    if(sex.value === 'fem'){
        return fem_categ.classList.remove('hide');
    }
    if(sex.value === 'masc'){
        return mas_categ.classList.remove('hide');
    }

    fem_categ.classList.add('hide');
    mas_categ.classList.add('hide');
})