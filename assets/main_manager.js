const comp = document.querySelectorAll('.comp');
const body = document.querySelector('body');
const edit = document.querySelector('#edit');

comp.forEach(c => {
  sex = c.querySelector('.sex').textContent
  if(sex === 'masc'){
    c.style.backgroundColor = '#b5c7eb';
  }else{
    c.style.backgroundColor = '#ff7f7f';
  }

  c.addEventListener('click', () => {
    let id = c.querySelector('i.hide').textContent;
    let nome = c.querySelector('h1').textContent;
    let sex = c.querySelector('i.sex').textContent;
    let peso = c.querySelector('p.peso').textContent;
    let faixa = c.querySelector('p.faixa').textContent;
    let categoria = c.querySelector('p.categoria').textContent;
    call_edit(true, id, nome, sex, peso, faixa, categoria);
  })
});

function call_edit(flag, id, name, sex, peso, faixa, categoria){
  if(flag){
    document.querySelector('#edit').style.display = 'flex';
    document.querySelector('#edit form').style.display = 'grid'; 
    body.style.overflowY = 'hidden';

    edit.querySelector('.id').value = id;
    edit.querySelector('input.name').value = name;
    edit.querySelector('p.sex').textContent = sex;
    edit.querySelector('input.peso').value = peso;
    edit.querySelector('p.faixa').textContent = faixa;
    edit.querySelector('.categ').textContent = categoria;

    form.querySelector('.delete').href = "controllers/fighterController.php?&action=delete&id="+edit.querySelector('.id').value;

    comp.forEach(c => {
      c.classList.add('hide');
    })
  }else{
    document.querySelector('#edit').style.display = 'none';
    document.querySelector('#edit form').style.display = 'none';
    body.style.overflowY = 'auto';
    comp.forEach(c => {
      c.classList.remove('hide');
    })
  }
}

edit.querySelector('form .close').addEventListener('click', () => {
  call_edit();
});


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