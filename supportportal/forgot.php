<?php

require_once 'app/start.php';

$reset_page = false;

if (isset($_GET['e'])) {


    $email = $_GET['e'];

    $user = $U->get_user_by('user_email', $email);
    if ($user['status']) {
        $user = $user['data'];

        if (empty($user['user_reset_code'])) {
            $_SESSION['message'] = ['type' => 'error', 'data' => 'send reset code before trying to rest.'];
            move('forgot.php');
        }
    } else {
        $_SESSION['message'] = ['type' => 'error', 'data' => 'email not found'];
        move('forgot.php');
    }

    $reset_page = true;

    if (isset($_POST) && !empty($_POST)) {
        if (isset($_POST['code']) && !empty($_POST['code']) && is_string($_POST['code']) && !empty(normal_text($_POST['code']))) {
            $code = normal_text($_POST['code']);

            if ($user['user_reset_code'] != $code) {
                $errors[] = "Verification code is incorrect";
            }
        } else {
            $errors[] = "Write verification code";
        }

        if (isset($_POST['password']) && !empty($_POST['password']) && is_string($_POST['password']) && !empty(normal_text($_POST['password']))) {
            $password = normal_text($_POST['password']);

            if (isset($_POST['password2']) && !empty($_POST['password2']) && is_string($_POST['password2']) && !empty(normal_text($_POST['password2']))) {
                $password2 = normal_text($_POST['password2']);
                if ($password != $password2) {
                    $errors[] = "Passwords doesn't match";
                }
            } else {
                $errors[] = "Write Password again";
            }
        } else {
            $errors[] = "Write Password";
        }

        if (empty($errors)) {

            $update = ['user_reset_code' => '', 'user_password' => password_hash($password, PASSWORD_BCRYPT)];
            $check = $U->update_user_data($update, $user['user_id']);
            if (!$check['status']) {
                $errors[] = "Unable to update your password";
            } else {
                $_SESSION['message'] = ['type' => 'success', 'data' => 'You have updated your password, login.'];
                move('index.php');
            }

        }
    }




} else {
    if (isset($_POST) && !empty($_POST)) {
        
        if (isset($_POST['email']) && !empty($_POST['email']) && is_string($_POST['email']) && !empty(normal_text($_POST['email']))) {
            $email = normal_text($_POST['email']);
        } else {
            $errors[] = "Write your email address";
        }
    
        if (empty($errors)) {
            $check = $U->get_user_by('user_email', $email);
            if (!$check['status']) {
                $errors[] = "Unable to find your email address";
            } else {
                $user = $check['data'];
    
                // reset code 
                $random_code = generateRandomString(6);
    
                // updating database
    
                $update = ['user_reset_code' => $random_code];
    
                $check = $U->update_user_data($update, $user['user_id']);
                if ($check['status']) {
                    // sending email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: <mail@visatrack.co.nz>' . "\r\n";
        
                    try {
                        if (!mail($user['user_email'], "Reset Code", "Your reset code is: <b>$random_code</b>", $headers)) {
                            $errors[] = "Unable to send mail";
                        } else {
                            $_SESSION['message'] = ['type' => 'success', 'data' => 'Reset code is sent, check your email'];
                            move('forgot.php?e='.$email);
                        }
                    } catch (Exception $e) {
                        $errors[] = "Unable to send mail";
                    }
                }
    
            }
        }
    
    }
}



require_once 'views/layout/header.view.php';
require_once 'views/forgot.view.php';
require_once 'views/layout/footer.view.php';
