<?php

require_once '../models/fighter.php';
require_once '../config/connection.php';

class FighterController {
    public static function update() {
        $conn = Database::connect();
        Fighter::update($conn, $_POST);
    }

    public static function create() {
        $conn = Database::connect();
        Fighter::create($conn, $_POST);
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // decide whether creating or updating depending on if an id was provided
    if(!empty($_POST['fighter_id'])) {
        FighterController::update();
    } else {
        FighterController::create();
    }
    header("Location: ../main.php");
}

if(isset($_GET['action']) && $_GET['action'] === 'delete'){
    $conn = Database::connect();
    Fighter::delete($conn, $_GET['id']);
    header("Location: ../main.php");
}
?>