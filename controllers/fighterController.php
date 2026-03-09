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
    $temp = $_POST['action'];

}elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $temp = $_GET['action'];
}else{
    return header("Location: ../main.php");
}
    $conn = Database::connect();

switch ($temp) {
    case 'create':
        FighterController::create();
        break;
    
    case 'update':
        FighterController::update();
        break;

    case 'delete':
        Fighter::delete($conn, $_GET['id']);
        break;

    case 'contByCategory':

        $category = $_POST['category'];

        $fighters = (INT) Fighter::countByCategory($conn, $category);

        echo json_encode([
            "fighters" => $fighters
        ]);
        exit;
        break;

    default:
        break;
}

    header("Location: ../main.php");
?>