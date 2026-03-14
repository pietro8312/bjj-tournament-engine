<?php
    require_once __DIR__ . '../../models/bracket.php';
    require_once __DIR__ . '../../config/connection.php';

    /*
    ========================
    FETCH JSON
    ========================
    */

    $contentType = $_SERVER["CONTENT_TYPE"] ?? '';

    if(str_contains($contentType, 'application/json')){
        $conn = Database::connect();
        $data = json_decode(file_get_contents("php://input"), true);

        if(!$data){
            echo json_encode([
                "success" => false,
                "message" => "Invalid JSON"
            ]);
            exit;
        }

        $action = $data['action'] ?? null;

        switch($action){

            case 'setWinner':

                $match_id = $data['match_id'] ?? null;
                $fighter_id = $data['fighter_id'] ?? null;

                if(!$match_id || !$fighter_id){
                    echo json_encode([
                        "success" => false,
                        "message" => "Missing parameters"
                    ]);
                    exit;
                }

                TournamentMatch::setWinner($conn, $match_id, $fighter_id);

                echo json_encode([
                    "success" => true,
                    "match_id" => $match_id,
                    "fighter_id" => $fighter_id
                ]);

            break;

            default:

                echo json_encode([
                    "success" => false,
                    "message" => "Invalid action"
                ]);

            break;
        }
        exit;
    }

    /*
    ========================
    POST (forms)
    ========================
    */

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
                Bracket::seedFighters($conn, $bracket_id, $_POST['category']);
                break;

            default:
                # code...
                break;
        }
        header("Location: /proj-irene/controllers/bracketController.php?action=all");
        exit;
    }

    /*
    ========================
    GET (pages)
    ========================
    */
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $conn = Database::connect();
        switch ($_GET['action']) {
            case 'all':
                $brackets = Bracket::all($conn);
                break;

            case 'delete':
                Bracket::delete($conn, $_GET['id']);
                exit (header("Location: /proj-irene/controllers/bracketController.php?action=all"));

                break;

            case 'show':
                $matches = Bracket::allMatches($conn, $_GET['id']);
                $doubleBracket = false;
                if(count($matches) >= 14){
                    $doubleBracket = true;
                }
            default:
                # code...
                break;
        }
        require __DIR__ . '../../views/bracket/view.php';
    }
?>