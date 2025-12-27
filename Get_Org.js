console.log('JS carregado')
let entrada = "pietro,88,azul;jonas,45,branca;lucas,62,azul;marcos,71,roxa;andre,54,branca;rafael,80,roxa;thiago,67,azul;bruno,59,azul;felipe,73,roxa;gabriel,66,azul;daniel,52,branca;leonardo,74,roxa;vinicius,64,azul;henrique,69,azul;matheus,75,roxa;"

const pesosMasc = [
    {categoria:"galo", pesoMax:57.5},
    {categoria:"pluma", pesoMax:64},
    {categoria:"pena", pesoMax:70},
    {categoria:"leve", pesoMax:76},
    {categoria:"medio", pesoMax:82.3},
    {categoria:"meio-pesado", pesoMax:88.3},
    {categoria:"pesado", pesoMax:94.3},
    {categoria:"super-pesado", pesoMax:100.5},
    {categoria:"pesadissimo", pesoMax:1000000000000000.9}
]

const pesosFem = [
    {categoria:"galo", pesoMax:48.5},
    {categoria:"pluma", pesoMax:53.5},
    {categoria:"pena", pesoMax:58.5},
    {categoria:"leve", pesoMax:64},
    {categoria:"medio", pesoMax:69},
    {categoria:"meio-pesado", pesoMax:74},
    {categoria:"pesado", pesoMax:1000000000000000.9}
]

const atletas = entrada.split(";").filter(Boolean).map(item => {
    const[nome, peso, faixa] = item.split(",");
    return{
        nome,
        peso: Number(peso),
        faixa,
        categoria: ""

        //{nome:pietro, peso:88, categoria:''}
    };
});

function orgCategoria (arrayObj, isMale){
    let regra;

    if(isMale){
        regra = pesosMasc
    }else{
        regra = pesosFem
    }

    arrayObj.map(atleta => {
        let cat = regra.find(r => atleta.peso <= r.pesoMax);
        atleta.categoria = cat.categoria
    })

        //{nome:pietro, peso:88, categoria: pesado} 
}

orgCategoria(atletas, true)

//retorna um array com o nome dos atletas
 function callAtletas(categ, faixa){
     let array = []
     atletas.filter(a => a.categoria === categ && a.faixa === faixa).forEach(g => {
         array.push(g.nome)
    })

    return(array)
}

const bracket = document.createElement('section'); bracket.classList.add('bracket')
const round = document.createElement('div'); round.classList.add('round')

document.body.appendChild(bracket)
bracket.appendChild(round)

const arrayAtletas = callAtletas('leve', 'roxa')

for (let i = 0; i < arrayAtletas.length; i+=2) {
    const a = arrayAtletas[i]

    const fight = document.createElement('div'); fight.classList.add('fight')

    //fighter 1
    const fighter = document.createElement('span'); fighter.classList.add('fighter')
    fighter.textContent = a
    fight.appendChild(fighter)

    if(arrayAtletas[i+1]){
        const fighter2 = document.createElement('span'); fighter.classList.add('fighter')
        fighter2.textContent = arrayAtletas[i+1]
        fight.appendChild(fighter2)
    }

    round.appendChild(fight)
}