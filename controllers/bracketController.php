<?php
    require_once __DIR__ . '../../models/bracket.php';
    require_once __DIR__ . '../../config/connection.php';
    
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
        header("Location: /proj-irene/bracket");
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
                exit (header("Location: /proj-irene/bracket"));

                break;

            case 'show':
                $matches = Bracket::allMatches($conn, $_GET['id']);
                $doubleBracket = false;
                if(count($matches) >= 14){
                    $doubleBracket = true;
                }
                break;
            
            case 'scoreboard':
                $match = TournamentMatch::getMatchesById($conn, $_GET['match']);
                require __DIR__ . '../../views/bracket/scoreboard.php';
                exit;
                break;

            case 'setWinner':
                TournamentMatch::setWinner($conn, $_GET['matchId'], $_GET['winner']);
                break;
            default:
                # code...
                break;
        }
        require __DIR__ . '../../views/bracket/view.php';
    }
?>