<?php

require_once '../models/fighter.php';
require_once '../config/connection.php';

class FighterController {
    public static function update() {
        $conn = Database::connect();

        Fighter::update($conn, $_POST);

    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    FighterController::update();
    header("Location: ../main.php");
}
?>