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

// Belt change



let belt = form.querySelector('.faixa');
let faixas = ['branca', 'azul', 'roxa', 'marrom', 'preta'];
let i = 0
faixas.forEach((f, index)=> {
  if(f === (belt.textContent).replace(/\s/g, '')){ i = index }
});

belt.classList.add((belt.textContent).replace(/\s/g, ''));

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