const comp = document.querySelectorAll('.comp');
const body = document.querySelector('body');
const edit = document.querySelector('#edit');


let flag = false;
let saveSex;
let saveName;
let savePeso;
let saveFaixa;

comp.forEach((c) => {
  c.addEventListener("click", () => {
    const id = c.dataset.id;
    window.location.href = `main.php?id=${id}`;

    saveSex = document.querySelector('#edit p.sex').textContent
    saveName = document.getElementById('name').value;
    savePeso = document.querySelector('#edit #peso').value
    saveFaixa = document.querySelector('p.faixa').textContent
  });
});

const editClose = document.querySelector('#edit form svg.close')

editClose.addEventListener('click', e => {
  edit.remove();
});

if(edit){
  body.style.overflowY = 'hidden';

  let sex = document.querySelector('p.sex')
  sex.addEventListener('click', () => {
    let op = ["masc", "fem"]
    let text = sex.textContent;
    if(text === op[0]){
      sex.textContent = op[1]
    }else{
      sex.textContent = op[0]
    }
  });

  let elFaixa = document.querySelector('#edit .faixa')

  let faixa = [
    {nome: 'branca', cor: '#fff'},
    {nome: 'azul', cor: '#00f'},
    {nome: 'roxa', cor: 'rgb(128, 0, 128)'},
    {nome: 'marrom', cor: 'rgb(44, 12, 12)'},
    {nome: 'preta', cor: '#000'}
  ];

  let fAtual = 0;

  if(elFaixa){
    for(let i = 0; i < faixa.length; i++) {
      const f = faixa[i];
      
      if(elFaixa.textContent === f.nome){
        fAtual = i;

        elFaixa.classList.add(f.nome)
      }

    }
  };

  elFaixa.addEventListener('click', (f) => {
    elFaixa.classList.remove(faixa[fAtual].nome)
    if(fAtual < 4){
      fAtual+=1
      elFaixa.classList.add(faixa[fAtual].nome)
    }else{
      fAtual= 0
    }
    elFaixa.textContent = faixa[fAtual].nome
  })

  let form = document.getElementById('formEdit')

  form.addEventListener('submit', f => {
    f.preventDefault();
    document.querySelectorAll('[data-enviar]').forEach(e => {
      const input = document.createElement('input');

      input.type = 'hidden';
      input.name = e.dataset.enviar;
      input.value = e.textContent.trim();

      form.appendChild(input)

    })
    form.submit();
    edit.remove();
  });
} 