//retorna um array com o nome dos atletas
 function callAtletas(categ, faixa){
     let array = []
     atletas.filter(a => a.categoria === categ && a.faixa === faixa).forEach(g => {
         array.push(g.nome)
    })

    return(array)
}

function start(){

    const bracket = document.createElement('section'); bracket.classList.add('bracket')
    const round = document.createElement('div'); round.classList.add('round')

    document.body.appendChild(bracket)
    bracket.appendChild(round)

    const arrayAtletas = callAtletas('pena', 'azul')
    let winloc = 0

    for (let i = 0; i < arrayAtletas.length; i+=2) {
        const a = arrayAtletas[i]
        winloc ++

        const fight = document.createElement('div'); fight.classList.add('fight'); fight.dataset.winlocation = winloc 

        //fighter 1
        const fighter = document.createElement('span'); fighter.classList.add('fighter')
        fighter.textContent = a
        fight.appendChild(fighter)

        if(arrayAtletas[i+1]){
            const fighter2 = document.createElement('span'); fighter2.classList.add('fighter')
            fighter2.textContent = arrayAtletas[i+1]
            fight.appendChild(fighter2)
        }

        round.appendChild(fight)
    }

    let even = 0;

    if(arrayAtletas.length%2 === 0){
        even = 0
    }else{
        even = 1
    }

    let loc = 0

    for (let i = arrayAtletas.length + even; i >= 2; i -= i/2) {
        const round = document.createElement('div'); round.classList.add('round')

        winloc++
        const fight = document.createElement('div'); fight.classList.add('fight'); fight.dataset.winlocation = winloc
        for (let j = 1; j <= i/2; j++) {
            if(j%2===1 && j !== 1){
                round.appendChild(fight)
                winloc++
                const fight = document.createElement('div'); fight.classList.add('fight'); fight.dataset.winlocation = winloc
            }

            loc++
            console.log(loc)

            const fighter = document.createElement('span'); fighter.classList.add('fighter'); fighter.dataset.location = loc
            fighter.textContent = j
            fight.appendChild(fighter)
        }

        round.appendChild(fight)
        bracket.appendChild(round)
    }
}