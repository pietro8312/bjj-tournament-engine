<?php
    require __DIR__ . '../../../config/url.php';
    require CONFIG_PATH . 'assets.php';
    add_css('bracket/bracket.css');
    add_css('bracket/tournament-create.css');
    add_js('bracket/bracket.js');
    add_css('tournament-bracket.css');
    require VIEWS_PATH . 'layout/header.php';
    if($_GET['action'] == 'show'){
        require VIEWS_PATH . 'bracket/show.php';
    }else{
        require VIEWS_PATH . 'bracket/create.php';
        require VIEWS_PATH . 'bracket/list.php';
    }
?>