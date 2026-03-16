<?php
$rounds = [];
foreach ($matches as $m) {
    $rounds[$m['round']][] = $m;
}    
if($doubleBracket){
    $leftRounds = [];
    $rightRounds = [];
    foreach ($rounds as $round => $matches) {
        $half = ceil(count($matches)/2);

        $leftRounds[$round] = array_slice($matches, 0 , $half);
        $rightRounds[$round] = array_slice($matches, $half);
    }
}

$conn = Database::connect();
Bracket::changeStatus($conn, 'in_progress', $matches[0]['bracket_id']);
?>

<div class="tournament-wrapper">
    <?php if($doubleBracket): ?>
    <div class="tournament">

        <div class="side left">

            <?php foreach($leftRounds as $roundMatches): ?>
                <div class="round">
                    <?php foreach($roundMatches as $m): ?>
                    <div class="match <?=htmlspecialchars($m['status'])?>">
                        <p class="id hide"><?= htmlspecialchars($m['id']) ?></p>
                        <div class="player <?php if(!empty($m['winner_id']) && $m['winner_id'] === $m['fighter_red_id']){echo 'winner';}?>">    
                            <p class="hide fighter_id"><?= htmlspecialchars($m['fighter_red_id']) ?></p>
                            <p class="name"><?= htmlspecialchars($m['red_name'] ?? 'BYE')?></p>
                        </div>
                        <div class="player <?php if(!empty($m['winner_id']) && $m['winner_id'] === $m['fighter_blue_id']){echo 'winner';}?>">
                            <p class="name"><?= htmlspecialchars($m['blue_name'] ?? 'BYE') ?></p>
                            <p class="hide fighter_id"><?= htmlspecialchars($m['fighter_blue_id']) ?></p>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            <?php endforeach ?>

        </div>

        <div class="side right">
            <?php foreach(array_reverse($rightRounds) as $roundMatches): ?>
                <div class="round">
                    <?php foreach($roundMatches as $m): ?>
                    <div class="match <?=htmlspecialchars($m['status'])?>">
                        <p class="id hide"><?= htmlspecialchars($m['id']) ?></p>
                        <div class="player <?php if(!empty($m['winner_id']) && $m['winner_id'] === $m['fighter_red_id']){echo 'winner';}?>">    
                            <p class="hide fighter_id"><?= htmlspecialchars($m['fighter_red_id']) ?></p>
                            <p class="name"><?= htmlspecialchars($m['red_name'] ?? 'BYE')?></p>
                        </div>
                        <div class="player <?php if(!empty($m['winner_id']) && $m['winner_id'] === $m['fighter_blue_id']){echo 'winner';}?>">
                            <p class="name"><?= htmlspecialchars($m['blue_name'] ?? 'BYE') ?></p>
                            <p class="hide fighter_id"><?= htmlspecialchars($m['fighter_blue_id']) ?></p>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <?php else :?>
        <div class="tournament">
            <?php foreach ($rounds as $roundNumber => $matches): ?>
            <div class="round">
                <?php foreach($matches as $m): ?>
                    <div class="match <?=htmlspecialchars($m['status'])?>">
                        <p class="id hide"><?= htmlspecialchars($m['id']) ?></p>
                        <div class="player <?php if(!empty($m['winner_id']) && $m['winner_id'] === $m['fighter_red_id']){echo 'winner';}?>">    
                            <p class="hide fighter_id"><?= htmlspecialchars($m['fighter_red_id']) ?></p>
                            <p class="name"><?= htmlspecialchars($m['red_name'] ?? 'BYE')?></p>
                        </div>
                        <div class="player <?php if(!empty($m['winner_id']) && $m['winner_id'] === $m['fighter_blue_id']){echo 'winner';}?>">
                            <p class="name"><?= htmlspecialchars($m['blue_name'] ?? 'BYE') ?></p>
                            <p class="hide fighter_id"><?= htmlspecialchars($m['fighter_blue_id']) ?></p>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</div>