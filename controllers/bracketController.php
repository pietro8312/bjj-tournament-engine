<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        switch ($_POST['action']) {
            case 'generate':
                Bracket::generate($conn, $post['category']);
                break;

            default:
                # code...
                break;
        }
    }

    header("Location: ../views/bracket/create.php")
?>