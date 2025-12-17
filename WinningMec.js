let fighters = document.querySelectorAll('span.fighter')

fighters.forEach(f => {
    f.addEventListener('click', () => {
        let end, winLocation;
        irmao = f.nextElementSibling
        if(irmao){
        }else{
            irmao = f.previousElementSibling
        }
        irmao.style.backgroundColor = 'red'
        f.style.backgroundColor = 'green'

        winLocation = f.parentElement.dataset.winlocation

        end = document.querySelector(
            `[data-location="${winLocation}"]`
        );

        tempData = f.textContent

        end.textContent = tempData
    })
})