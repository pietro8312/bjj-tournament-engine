<?php 
require_once '../models/tournamentMatch.php';
require_once __DIR__ . '../../config/connection.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $conn = Database::connect();
    switch ($_GET['action']) {
        case 'matchDone':

            TournamentMatch::setWinner($conn, $_GET['matchId'], $_GET['winner']);
            TournamentMatch::changeStatus($conn, 'finished', $_GET['matchId']);
            $matchid = $_GET['matchId'];
            exit (header("Location: /proj-irene/controllers/bracketController.php?action=bracketDone&bracketId=" . $_GET['bracketId']));
            break;
        
        default:
            # code...
            break;
    }
}
?>