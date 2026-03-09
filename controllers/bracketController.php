<?php 
    require_once '../models/bracket.php';
    require_once '../config/connection.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $conn = Database::connect();

        switch ($_POST['action']) {
            case 'generate':
                $bracket_id = Bracket::create($conn, $_POST['category_m']);
                Bracket::generate($conn, $_POST['category_m'], $bracket_id);
                Bracket::seedFighters($conn, $_POST['category_m']);
                break;
            default:
                # code...
                break;
        }
    }

    header("Location: ../views/bracket/create.php");
?>