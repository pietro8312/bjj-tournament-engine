<?php 
    define('BASE_URL', '/proj-irene');

    define('ASSETS_URL', BASE_URL . '/assets/');

    define('CSS_URL', ASSETS_URL . '/css/');
    define('JS_URL', ASSETS_URL . '/js/');
    define('IMG_URL', ASSETS_URL . '/img/');

    define('CONTROLLERS_URL', BASE_URL . '/controllers/');
    define('VIEWS_URL', BASE_URL . '/views/');


    define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . BASE_URL);

    define('VIEWS_PATH', ROOT_PATH . '/views/');
    define('CONTROLLERS_PATH', ROOT_PATH . '/controllers/');
    define('MODELS_PATH', ROOT_PATH . '/models/');
    define('CONFIG_PATH', ROOT_PATH . '/config/');
?>