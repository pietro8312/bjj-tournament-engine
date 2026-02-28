<?php 
    require 'config/connection.php';
    require_once 'config/assets.php';
    require 'models/fighter.php';
    
    $conn = Database::connect();
    if(isset($_GET['search']) && $_GET['search'] !== '') {
        $fighters = Fighter::search($conn, $_GET['search']);
    }else{
        $fighters = Fighter::all($conn);
    }

    $style_page = [];

    require 'views/fighters/list.php'
?>
