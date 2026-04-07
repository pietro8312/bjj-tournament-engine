const form = document.getElementById('formEdit')
const sex = form.querySelector('.sex')

form.querySelector('input#inputSex').value = (form.querySelector('p.sex').textContent).trim()
let sexes = ['fem', 'masc']
sex.addEventListener('click', () => {
  if(sex.textContent === sexes[0]){
    sex.textContent = sexes[1];
  }else{
    sex.textContent = sexes[0];
  }

  form.querySelector('input#inputSex').value = (form.querySelector('p.sex').textContent).trim()
});

const defaultFaixa = Number(document.getElementById('defaultFaixa').textContent)

const faixa = document.querySelector('.faixa')

faixa.value = defaultFaixa;

const divFaixa = document.querySelector("#divfaixa");

function mudarCores(faixa, linha) {
  if(linha){
    divFaixa.style.setProperty("--cor-faixa", faixa);
    divFaixa.style.setProperty("--cor-linha", linha);
    console.log('liha')
  }else{
    console.log('not linha')
    divFaixa.style.setProperty("--cor-faixa", faixa);
    divFaixa.style.setProperty("--cor-linha", faixa);
  }
}

callCores(faixa)

faixa.addEventListener('change', f => {
  callCores(faixa)
})


function callCores(faixa){
  switch (faixa.value) {

    case '18': // Branca
      mudarCores('#fff');
      break;

    case '19': // Cinza linha branca
      mudarCores('#808080', '#fff');
      break;

    case '20': // Cinza
      mudarCores('#808080');
      break;

    case '21': // Cinza linha preta
      mudarCores('#808080', '#000');
      break;

    case '22': // Amarela linha branca
      mudarCores('#ffff00', '#fff');
      break;

    case '23': // Amarela
      mudarCores('#ffff00');
      break;

    case '24': // Amarela linha preta
      mudarCores('#ffff00', '#000');
      break;

    case '25': // Laranja linha branca
      mudarCores('#ffa500', '#fff');
      break;

    case '26': // Laranja
      mudarCores('#ffa500');
      break;

    case '27': // Laranja linha preta
      mudarCores('#ffa500', '#000');
      break;

    case '28': // Verde linha branca
      mudarCores('green', '#fff');
      break;

    case '29': // Verde
      mudarCores('green');
      break;

    case '30': // Verde linha preta
      mudarCores('green', '#000');
      break;

    case '31': // Azul
      mudarCores('blue');
      break;

    case '32': // Roxa
      mudarCores('purple');
      break;

    case '33': // Marrom
      mudarCores('brown');
      break;

    case '34': // Preta
      mudarCores('#000');
      break;

    default:
      break;
  }
}


// Belt change melhorar essa porra ai 



// let belt = form.querySelector('.faixa');
// let faixas = ['branca', 'azul', 'roxa', 'marrom', 'preta'];
// let i = 0
// faixas.forEach((f, index)=> {
//   if(f === (belt.textContent).replace(/\s/g, '')){ i = index }
// });

// belt.classList.add((belt.textContent).replace(/\s/g, ''));

// belt.addEventListener('click', () => {
//   belt.classList.remove(faixas[i]);
//   if(i>=4){
//     i=0
//   }else{
//     i++
//   }

//   belt.textContent = faixas[i];
//   belt.classList.add(faixas[i]);
// });