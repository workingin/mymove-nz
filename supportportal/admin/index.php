<?php

//header("Location: https://myvisapath.co.nz/manage/admin/authentication");
//die();
require_once '../app/start.php';

if (!isset($_SESSION['admin_logged'])) {
    $_SESSION['message'] = ['type' => 'error', 'data' => 'Access forbidden'];
    move('admin/login.php');
}

$users = $U->get_all_users();
if ($users['status']) {
    $users = $users['data'];
} else {
    $users = [];
}

require_once 'views/layout/header.view.php';
require_once 'views/index.view.php';
require_once 'views/layout/footer.view.php';
