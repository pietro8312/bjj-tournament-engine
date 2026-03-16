const tournament = document.querySelector('.tournament');
const matches = tournament.querySelectorAll('.match');

// seleciona tudo do player que tu clicou
matches.forEach(m => {
    m.addEventListener('click', () => {
        // const name = p.querySelector('.name').textContent; nao ta precisando ainda
        const matchId = m.querySelector('.id').textContent;
        document.location.href =`/proj-irene/bracket/${matchId}/match`;
})});
