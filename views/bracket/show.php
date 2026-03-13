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
                            <div class="player"><?= $m['red_name'] ?? 'BYE'?></div>
                            <div class="player"><?= $m['blue_name'] ?? 'BYE'?></div>
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
                            
                            <div class="player"><?= $m['red_name'] ?? 'BYE'?></div>
                            <div class="player"><?= $m['blue_name'] ?? 'BYE'?></div>
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
                        <div class="player"><?= $m['red_name'] ?? 'BYE'?></div>
                        <div class="player"><?= $m['blue_name'] ?? 'BYE'?></div>
                    </div>
                <?php endforeach ?>
            </div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</div>