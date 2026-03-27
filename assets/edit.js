// Sex change

let sexes = ['fem', 'masc']
edit.querySelector('.sex').addEventListener('click', () => {
  let sex = edit.querySelector('.sex');
  if(sex.textContent === sexes[0]){
    sex.textContent = sexes[1];
  }else{
    sex.textContent = sexes[0];
  }
});

// Belt change

let belt = edit.querySelector('p.faixa');
let faixas = ['branca', 'azul', 'roxa', 'marrom', 'preta'];
let i = 0
belt.addEventListener('click', () => {
  belt.classList.remove(faixas[i]);
  if(i>=4){
    i=0
  }else{
    i++
  }

  belt.textContent = faixas[i];
  belt.classList.add(faixas[i]);
});


const form = edit.querySelector('form');

form.addEventListener('submit', ev => {
  ev.preventDefault();

  form.querySelector('input#inputSex').value = edit.querySelector('p.sex').textContent
  form.querySelector('input#inputFaixa').value = edit.querySelector('p.faixa').textContent

  form.submit();
});