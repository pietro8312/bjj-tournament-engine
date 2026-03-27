<?php 
    require __DIR__ . '../../../config/url.php';

    if(!$match){
        exit (header('Location, /proj-irene/main.php'));    
    }
    
    if(!empty($match['fighter_red_id']) && empty($match['fighter_blue_id']) && $match['round'] === '1'){
        #chama q esse e o winner
        $winner = $match['fighter_red_id'];
    }elseif(!empty($match['blue_name']) && empty($match['fighter_red_id']) && $match['round'] === '1'){
        #chama q esse e o winner
        $winner = $match['fighter_blue_id'];
    }

    if(!empty($winner)){
        header('Location: ' . CONTROLLERS_URL . 'bracketController.php?winner=' . $winner . '&matchId=' . $match['id'] . '&action=setWinner');
    }

    $conn = Database::connect();
    TournamentMatch::changeStatus($conn, 'in_progress', $match['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>fight.css">
    <script type="module" src="<?= ASSETS_URL ?>fight.js"></script>
    <title>Placar Jiu-Jitsu</title>
</head>
<body>
    <div id="comp1" class="comp">
        <h1 class="nome"><?= htmlspecialchars($match['red_name']) ?></h1>
        <div class="van">
            <i>0</i>
            <i>0</i>
        </div>
        <i class="ptn">0</i>
    </div>
    <div id="comp2" class="comp">
        <h1 class="nome"><?= htmlspecialchars($match['blue_name']) ?></h1>
        <div class="van">
            <i>0</i>
            <i>0</i>
        </div>
        <i class="ptn">0</i>
    </div>
    <div id="tempo">
        <p>00:00</p>
    </div>

    <i id="swap"><svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>swap-vertical-circle-solid</title> <g id="Layer_2" data-name="Layer 2"> <g id="invisible_box" data-name="invisible box"> <rect width="48" height="48" fill="none"></rect> </g> <g id="icons_Q2" data-name="icons Q2"> <path d="M24,2A22,22,0,1,0,46,24,21.9,21.9,0,0,0,24,2Zm.3,29.5-4.9,4.9a1.9,1.9,0,0,1-2.8,0l-4.9-4.9a2.2,2.2,0,0,1-.4-2.7,2,2,0,0,1,3.1-.2L16,30.2V15a2,2,0,0,1,4,0V30.2l1.6-1.6a2,2,0,0,1,3.1.2A2.2,2.2,0,0,1,24.3,31.5ZM36.7,19.2a2,2,0,0,1-3.1.2L32,17.8V33a2,2,0,0,1-4,0V17.8l-1.6,1.6a2,2,0,0,1-3.1-.2,2.1,2.1,0,0,1,.4-2.7l4.9-4.9a1.9,1.9,0,0,1,2.8,0l4.9,4.9A2.1,2.1,0,0,1,36.7,19.2Z"></path> </g> </g> </g></svg></i>

    <form action="<?=CONTROLLERS_URL?>matchController.php" id="resolveForm">
        <h1>Resolve</h1>
        <input type="hidden" name="action" value="matchDone">
        <input type="hidden" name="matchId" value="<?=$match['id']?>">
        <select name="winner" id="" required>
            <option value="" default>Vencedor</option>
            <option value="<?= htmlspecialchars($match['fighter_red_id']) ?>"><?= htmlspecialchars($match['red_name']) ?></option>
            <option value="<?= htmlspecialchars($match['fighter_blue_id']) ?>"><?= htmlspecialchars($match['blue_name']) ?></option>
        </select>
        <input type="hidden" name="bracketId" value="<?=$match['bracket_id']?>">
        <input type="submit" value="submit">
    </form>
</body>
</html>