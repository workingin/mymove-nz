<?php

    session_start();

    // Main project directory
    define('DIR', dirname(__DIR__).'/');
    
    // Either: development/production
    define('PROJECT_MODE', 'development'); 

    if (PROJECT_MODE !== 'development') {
        error_reporting(0);
    } else {
        error_reporting(E_ALL);
    }

    // Database details
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'workingi_supportalDB');
    define('DB_USER', 'workingi_supportDBuser');
    define('DB_PASS', 'SyTPQ4adjz!^');
    
    


    // Timezone setting
    define('TIMEZONE', 'Europe/Berlin');
    date_default_timezone_set(TIMEZONE);

    // Auto load classes
    require DIR . 'app/auto_loader.php';

    // Functions
    require DIR . 'app/functions.php';
    // Get db handle
    $db = (new DB())->connect();
    $settings = new Settings($db);

    define('URL', $settings->url());
    
    $errors = [];
    // checking for session message
    if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
        if ($_SESSION['message']['type'] === 'success') {
            $success = $_SESSION['message']['data'];
        } else if ($_SESSION['message']['type'] === 'error') {
            $errors[] = $_SESSION['message']['data'];
        }
        unset($_SESSION['message']);
    }
    
    $U = new Users($db);

    $logged = false;
    if (isset($_SESSION['logged']) && !empty($_SESSION['logged']) && $_SESSION['logged'] === true) {        
        $logged_user = $U->get_logged_user();
        if (!$logged_user['status']) {
            $_SESSION['message'] = ['type' => 'error', 'data' => $logged_user['data']];
            $U->logout();
            move('public/index.php');
        }
        $logged = true;
        $logged_user = $logged_user['data'];
    }
    