let bracketsF = document.querySelectorAll('#bracketForm');
let toggles = document.querySelectorAll('h1 .toggle');
toggles.forEach((t, index) => {
    t.addEventListener('click', () => {
        if(bracketsF[index].classList.contains('selected')){
            bracketsF[index].classList.remove('selected');
            toggles[index].style.rotate = 180 + 'deg'
        }else{
            bracketsF[index].classList.add('selected');
            toggles[index].style.rotate = 0 + 'deg'
        }
    })
});

bracketsF.forEach((bf, index) => {
    if(bf.classList.contains('selected')){
            toggles[index].style.rotate = 0 + 'deg'
        }else{
            toggles[index].style.rotate = 180 + 'deg'
    }
})