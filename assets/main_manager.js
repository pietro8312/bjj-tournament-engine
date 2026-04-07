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
});