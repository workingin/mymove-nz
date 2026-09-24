<?php

require_once '../app/start.php';

if (!isset($_SESSION['admin_logged'])) {
    end_response(400, "Request Forbidden", true);
}

$user_id = $_GET['user_id'];
$password = $_GET['password'];

$check = $U->get_user_by('user_id', $user_id);

if ($check['status']) {
    $password = normal_text($password);
    $password = password_hash($password, PASSWORD_BCRYPT);
    $check = $U->update_user_data(['user_password' => $password], $user_id);

    if ($check['status']) {
        end_response(200, "Password updated", true);
    } else {
        end_response(400, "Unable to update", true);
    }
} 

end_response(400, "Unable to get user", true);
