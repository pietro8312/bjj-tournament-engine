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
                if($_POST['sex'] === 'masc') {
                    $postCategory = $_POST['category_m'];
                }else{
                    $postCategory = $_POST['category_f'];
                }

                if(empty($postCategory)){
                    die();
                    # colocar um erro aqui
                }

                $category = Fighter::easyCateg($conn, $postCategory, $_POST['age_division']);
                $bracket_id = Bracket::create($conn, $category, $_POST['sex'], $_POST['belt']);
                Bracket::generate($conn, $category, $bracket_id, $_POST['belt']);
                Bracket::seedFighters($conn, $bracket_id, $category, $_POST['belt']);
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

            case 'bracketDone':
                Bracket::Done($conn, $_GET['bracketId']);
                exit (header("Location: /proj-irene/bracket"));
                break;
            
            case 'scoreboard':
                $match = TournamentMatch::getMatchesById($conn, $_GET['match']);
                require __DIR__ . '../../views/bracket/scoreboard.php';
                exit;
                break;
            default:
                # code...
                break;
        }
        require __DIR__ . '../../views/bracket/view.php';
    }
?>