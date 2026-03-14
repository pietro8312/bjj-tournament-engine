const tournament = document.querySelector('.tournament');
const players = document.querySelectorAll('.player');

// seleciona tudo do player que tu clicou
players.forEach(p => {
    p.addEventListener('click', () => {
        // const name = p.querySelector('.name').textContent; nao ta precisando ainda
        const matchId = p.parentElement.querySelector('.id').textContent;
        const fighterId = p.querySelector('.fighter_id').textContent;


    fetch('bracketController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            action: 'setWinner',
            match_id: matchId,
            fighter_id: fighterId
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
    })
})});