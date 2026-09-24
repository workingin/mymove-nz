<?php

require_once 'app/start.php';

if (!$logged) {
    $_SESSION['message'] = ['type' => 'error', 'data' => 'Login to view the page'];
    move('index.php');
}


require_once 'views/layout/header.view.php';
require_once 'views/thanks.view.php';
require_once 'views/layout/footer.view.php';
