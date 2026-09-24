<?php

require_once 'app/start.php';

if (isset($_POST) && !empty($_POST)) {
    
        if (isset($_POST['email']) && !empty($_POST['email']) && is_string($_POST['email']) && !empty(normal_text($_POST['email']))) {
        $email = normal_text($_POST['email']);
        $entryid=$_POST['crmid'];
        $b2bid=$_POST['b2bid'];
        $crmname=$_POST['name'];
        $crmname=strip_tags($crmname,"");
        $crmname = preg_replace('/[^A-Za-z0-9\s.\s-]/','',$crmname); 
        
        $source=$_POST['source'];
        $payment=$_POST['payment'];
        $totalamount=$_POST['totalamount'];
        $paycurrency=$_POST['paycurrency'];
        $companyname=$_POST['companyname'];
        $leadtype=$_POST['leadtype'];

        $user = $U->get_user_by('user_email', $email);
        if ($user['status']) {
            $errors[] = 'Email already exists. <a href="'.href('index').'" class="btn btn-primary btn-sm">Login</a>';
        }
    } else {
        $errors[] = "Write your email address";
    }
    if (isset($_POST['password']) && !empty($_POST['password']) && is_string($_POST['password']) && !empty(normal_text($_POST['password']))) {
        $password = normal_text($_POST['password']);
    } else {
        $errors[] = "Write your password";
    }

    if (empty($errors)) {

        // create new account
        $psm=$_POST['password'];
        $password = password_hash($password, PASSWORD_BCRYPT);
        $result = $U->create_user ($email, $password);
        if ($result['status']) {
            $U->set_session($result['user_id']);
            $userform_id=$result['user_id'];
            $_SESSION['message'] = ['type' => 'success', 'data' => 'Account created! start filling form.'];
            $_SESSION['psmsg']=$psm;           
move('step-1.php?accountcreated=1');
echo "..........";
 $errors[] = 'Account Created <a href="'.href('index').'" class="btn btn-primary btn-sm">Login</a>';
            
        } else {
            $errors[] = "Unable to create account";
        }

    }

}


require_once 'views/layout/header.view.php';
require_once 'views/get-started.view.php';
require_once 'views/layout/footer.view.php';
