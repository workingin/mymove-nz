<?php

require_once 'app/start.php';

if (!$logged) {
    $_SESSION['message'] = ['type' => 'error', 'data' => 'Login to view the page'];
    move('index.php');
}

$Countries = new Countries($db);

$countries = $Countries->get_countries(); 
if ($countries['status']) {
    $countries = $countries['data'];
} else {
    $countries = [];
}

$relationships = [
    '1' => 'Single',
    '2' => 'Separated',
    '3' => 'Partner / De facto',
    '4' => 'Divorced',
    '5' => 'Married / In civil union',
    '6' => 'Engaged',
    '7' => 'Widowed',
];

$user_countries = [];
if (!empty($logged_user['user_country_lived'])) {
    $user_countries = explode(',', $logged_user['user_country_lived']);
}

// checking POST request

if (isset($_POST) && !empty($_POST)) {
    $validate = false;
    if (isset($_POST['save-next'])) {
        $validate = true;
    }

    $update = [
        'user_first_name' =>  '',
        'user_last_name' =>  '',
        'user_phone' =>  '',
        'user_address' =>  '',
        'user_address2' =>  '',
        'user_city' =>  '',
        'user_country' =>  '',
        'other_citizenship' =>  '',
        'other_countryvisa' =>  '',
        'countrybirth' =>  '',
        'user_dob' =>  '',
        'user_relationship' =>  '',
        'user_country_lived' =>  '',
    ];

    if (isset($_POST['first_name']) && !empty($_POST['first_name']) && is_string($_POST['first_name']) && !empty(normal_text($_POST['first_name']))) {
        $update['user_first_name'] = normal_text($_POST['first_name']);
    } else if ($validate) {
        $errors[] = "First name shouldn't be empty";
    }
    if (isset($_POST['last_name']) && !empty($_POST['last_name']) && is_string($_POST['last_name']) && !empty(normal_text($_POST['last_name']))) {
        $update['user_last_name'] = normal_text($_POST['last_name']);
    } else if ($validate) {
        $errors[] = "Last name shouldn't be empty";
    }

    if (isset($_POST['phone']) && !empty($_POST['phone']) && is_string($_POST['phone']) && !empty(normal_text($_POST['phone']))) {
        $update['user_phone'] = normal_text($_POST['phone']);
    } else if ($validate) {
        $errors[] = "Phone shouldn't be empty";
    }

    if (isset($_POST['address']) && !empty($_POST['address']) && is_string($_POST['address']) && !empty(normal_text($_POST['address']))) {
        $update['user_address'] = normal_text($_POST['address']);
    } else if ($validate) {
        $errors[] = "Address should not be empty";
    }
    if (isset($_POST['address2']) && !empty($_POST['address2']) && is_string($_POST['address2']) && !empty(normal_text($_POST['address2']))) {
        $update['user_address2'] = normal_text($_POST['address2']);
    } 
    if (isset($_POST['city']) && !empty($_POST['city']) && is_string($_POST['city']) && !empty(normal_text($_POST['city']))) {
        $update['user_city'] = normal_text($_POST['city']);
    } else if ($validate) {
        $errors[] = "City shouldn't be empty";
    }

    if (isset($_POST['country']) && !empty($_POST['country']) && is_string($_POST['country']) && !empty(normal_text($_POST['country']))) {
        $update['user_country'] = normal_text($_POST['country']);
    } else if ($validate) {
        $errors[] = "Country shouldn't be empty";
    }
    
    
      if (isset($_POST['countrybirth']) && !empty($_POST['countrybirth']) && is_string($_POST['countrybirth']) && !empty(normal_text($_POST['countrybirth']))) {
        $update['countrybirth'] = normal_text($_POST['countrybirth']);
    } else if ($validate) {
        $errors[] = "Country shouldn't be empty";
    }


     if (isset($_POST['other_citizenship']) && !empty($_POST['other_citizenship']) && is_string($_POST['other_citizenship']) && !empty(normal_text($_POST['other_citizenship']))) {
        $update['other_citizenship'] = normal_text($_POST['other_citizenship']);
    } else if ($validate) {
        //$errors[] = "Country shouldn't be empty";
    }
    
    
    
     if (isset($_POST['other_countryvisa']) && !empty($_POST['other_countryvisa']) && is_string($_POST['other_countryvisa']) && !empty(normal_text($_POST['other_countryvisa']))) {
        $update['other_countryvisa'] = normal_text($_POST['other_countryvisa']);
    } else if ($validate) {
        //$errors[] = "Country shouldn't be empty";
    }
    
    
    if (isset($_POST['dob']) && !empty($_POST['dob']) && is_string($_POST['dob']) && !empty(normal_text($_POST['dob']))) {
        $update['user_dob'] = normal_text($_POST['dob']);
    } else if ($validate) {
        $errors[] = "Date of birth shouldn't be empty";
    }

    if (isset($_POST['relationship']) && !empty($_POST['relationship']) && is_string($_POST['relationship']) && !empty(normal_text($_POST['relationship']))) {
        $update['user_relationship'] = normal_text($_POST['relationship']);
    } else if ($validate) {
        $errors[] = "Relationship status shouldn't be empty";
    }

    $countries_lived = "";
    if (isset($_POST['countries-lived']) && !empty($_POST['countries-lived']) && is_array($_POST['countries-lived'])) {
        $_countries_lived = $_POST['countries-lived'];
        foreach ($_countries_lived as $co) {
            if (!empty($countries_lived)) { $countries_lived .= ","; }
            $countries_lived .= normal_text($co);
        }
        $update['user_country_lived'] = $countries_lived;
    } 

    if (empty($errors)) {

        if ($validate) {
            $update['user_form_status'] = '20%';
        }
        
        $result = $U->update_user_data($update, $logged_user['user_id']);
        if ($result['status']) {
            
            if (isset($_POST['save-next'])) {
                $_SESSION['message'] = ['type' => 'success', 'data' => 'Changes saved successfully']; 
               $edithis=$_GET['edithis'];
               
               if ($edithis=="1")
               {
                   move('main.php?rls='. $rls );
               }
                $rls=$_POST['relationship'];
                move('step-2.php?rls='. $rls );
            } else {
                $U->logout();
                $_SESSION['message'] = ['type' => 'success', 'data' => 'Data saved, you can continue filling later'];
                move('index.php');
            }
        } else {
            $errors[] = "Unable to create account";
        }
        
    }

}


require_once 'views/layout/header.view.php';
require_once 'views/step-1.view.php';
require_once 'views/layout/footer.view.php';
