<?php
//header("Location: https://myvisapath.co.nz/manage/admin/authentication");
//die();
require_once '../app/start.php';

define('ADMIN_USERNAME', "admin");
define('ADMIN_PASSWORD', "Win110Team");


if (isset($_POST) && !empty($_POST)) {

    if ($_POST['username'] !== ADMIN_USERNAME) {
        $errors[] = "Incorrect username";
    }
    if ($_POST['password'] !== ADMIN_PASSWORD) {
        $errors[] = "Incorrect password";
    }

    if (empty($errors)) {
        $_SESSION['admin_logged'] = true;
        move('admin/index.php?statusrp=100');
    }

}

require_once 'views/layout/header.view.php';
require_once 'views/login.view.php';
require_once 'views/layout/footer.view.php';
