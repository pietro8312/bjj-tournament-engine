<?php 
    require_once '../models/bracket.php';
    require_once '../config/connection.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $conn = Database::connect();

        switch ($_POST['action']) {
            case 'generate':
                Bracket::generate($conn, $_POST['category_m']);
                Bracket::seedFighters($conn, $_POST['category_m']);
                break;

            default:
                # code...
                break;
        }
    }

    header("Location: ../views/bracket/create.php");
?>