<?php 
    require_once __DIR__ . '../../models/bracket.php';
    require_once __DIR__ . '../../config/connection.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $conn = Database::connect();

        switch ($_POST['action']) {
            case 'generate':
                if(empty($_POST['category'])){
                    die();
                    # colocar um erro aqui
                }
                $bracket_id = Bracket::create($conn, $_POST['category']);
                Bracket::generate($conn, $_POST['category'], $bracket_id);
                Bracket::seedFighters($conn, $_POST['category']);
                break;
            default:
                # code...
                break;
        }
        header("Location: /proj-irene/controllers/bracketController.php?action=all");
    }else if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $conn = Database::connect();
        switch ($_GET['action']) {
            case 'all':
                $brackets = Bracket::all($conn);
                break;

            case 'delete':
                Bracket::delete($conn, $_GET['id']);
                exit (header("Location: /proj-irene/controllers/bracketController.php?action=all"));

                break;
            default:
                # code...
                break;
        }
        require __DIR__ . '../../views/bracket/view.php';
    }
?>