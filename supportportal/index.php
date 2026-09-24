<?php

require_once 'app/start.php';


// check details

if (isset($_POST) && !empty($_POST)) {
    
    if (isset($_POST['email']) && !empty($_POST['email']) && is_string($_POST['email']) && !empty(normal_text($_POST['email']))) {
        $email = normal_text($_POST['email']);
    } else {
        $errors[] = "Write your email address";
    }
    if (isset($_POST['password']) && !empty($_POST['password']) && is_string($_POST['password']) && !empty(normal_text($_POST['password']))) {
        $password = normal_text($_POST['password']);
    } else {
        $errors[] = "Write your password";
    }

    if (empty($errors)) {
        $check = $U->login($email, $password);
    
        if (!$check['status']) {

            // checking type of error
            if ($check['type'] === 'no') {

                // create new account
                $errors[] = 'Account not found, please visit <a href="mailto:contact@workingin.com">Contact</a>';

            } else {
                $errors[] = $check['data'];
            }

        } else {
            // go to step 1
            $_SESSION['message'] = ['type' => 'success', 'data' => 'Continue filling your form.'];
            //move('main.php?section=welcome');
            move('welcome.php?section=welcome');
        }
    }

}


require_once 'views/layout/header.view.php';
require_once 'views/home.view.php';
require_once 'views/layout/footer.view.php';
