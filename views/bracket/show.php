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
?>

<div class="tournament-wrapper">
    <?php if($doubleBracket): ?>
    <div class="tournament">

        <div class="side left">

            <?php foreach($leftRounds as $roundMatches): ?>
                <div class="round">
                    <?php foreach($roundMatches as $m): ?>
                    <div class="match">
                        <p class="id hide"><?= htmlspecialchars($m['id']) ?></p>
                        <div class="player">    
                            <p class="hide fighter_id"><?= htmlspecialchars($m['fighter_red_id']) ?></p>
                            <p class="name"><?= htmlspecialchars($m['red_name'] ?? 'BYE')?></p>
                        </div>
                        <div class="player">
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
                    <div class="match">
                        <p class="id hide"><?= htmlspecialchars($m['id']) ?></p>
                        <div class="player">    
                            <p class="hide fighter_id"><?= htmlspecialchars($m['fighter_red_id']) ?></p>
                            <p class="name"><?= htmlspecialchars($m['red_name'] ?? 'BYE')?></p>
                        </div>
                        <div class="player">
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
                    <div class="match">
                        <p class="id hide"><?= htmlspecialchars($m['id']) ?></p>
                        <div class="player">    
                            <p class="hide fighter_id"><?= htmlspecialchars($m['fighter_red_id']) ?></p>
                            <p class="name"><?= htmlspecialchars($m['red_name'] ?? 'BYE')?></p>
                        </div>
                        <div class="player">
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