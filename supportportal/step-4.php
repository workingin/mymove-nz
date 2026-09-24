<?php

require_once 'app/start.php';

if (!$logged) {
    $_SESSION['message'] = ['type' => 'error', 'data' => 'Login to view the page'];
    move('index.php');
}

if ($logged_user['user_form_status'] === '60%') {
    $logged_user['user_form_status'] = '80%';
}

if (isset($_POST) && !empty($_POST)) {
    $validate = false;
    if (isset($_POST['save-finish'])) {
        $validate = true;
       
    }
    
    // misc 
    if (isset($_POST['name-change']) && !empty($_POST['name-change'])) {
        $update['user_name_change'] = normal_text($_POST['name-change']);
    } 

    // personal
    if (isset($_POST['investigation']) && !empty($_POST['investigation'])) {
        $update['user_investigation'] = normal_text($_POST['investigation']);
    }
    
     if (isset($_POST['english_proof']) && !empty($_POST['english_proof'])) {
        $update['english_proof'] = normal_text($_POST['english_proof']);
    }
    
         if (isset($_POST['ownhome']) && !empty($_POST['ownhome'])) {
        $update['ownhome'] = normal_text($_POST['ownhome']);
    }
    
    
         if (isset($_POST['equity']) && !empty($_POST['equity'])) {
        $update['equity'] = normal_text($_POST['equity']);
    }
    
         if (isset($_POST['assets']) && !empty($_POST['assets'])) {
        $update['assets'] = normal_text($_POST['assets']);
    }
    
    
    
         if (isset($_POST['value_vehicles']) && !empty($_POST['value_vehicles'])) {
        $update['value_vehicles'] = normal_text($_POST['value_vehicles']);
    }
    
    
    
         if (isset($_POST['valuables']) && !empty($_POST['valuables'])) {
        $update['valuables'] = normal_text($_POST['valuables']);
    }
    
         if (isset($_POST['value_vehicles']) && !empty($_POST['value_vehicles'])) {
        $update['value_vehicles'] = normal_text($_POST['value_vehicles']);
    }
    
    
         if (isset($_POST['savingcash']) && !empty($_POST['savingcash'])) {
        $update['savingcash'] = normal_text($_POST['savingcash']);
    }
    
    
         if (isset($_POST['sharestocks']) && !empty($_POST['sharestocks'])) {
        $update['sharestocks'] = normal_text($_POST['sharestocks']);
    }
    
         if (isset($_POST['otherfinance']) && !empty($_POST['otherfinance'])) {
        $update['otherfinance'] = normal_text($_POST['otherfinance']);
    }
    
         if (isset($_POST['ownbusiness']) && !empty($_POST['ownbusiness'])) {
        $update['ownbusiness'] = normal_text($_POST['ownbusiness']);
    }
    
    
         if (isset($_POST['seniorex']) && !empty($_POST['seniorex'])) {
        $update['seniorex'] = normal_text($_POST['seniorex']);
    }
    
         if (isset($_POST['employees']) && !empty($_POST['employees'])) {
        $update['employees'] = normal_text($_POST['employees']);
    }
    
         if (isset($_POST['turnover']) && !empty($_POST['turnover'])) {
        $update['turnover'] = normal_text($_POST['turnover']);
    }
    
            if (isset($_POST['ownership']) && !empty($_POST['ownership'])) {
        $update['ownership'] = normal_text($_POST['ownership']);
    }
    
            if (isset($_POST['openbusiness']) && !empty($_POST['openbusiness'])) {
        $update['openbusiness'] = normal_text($_POST['openbusiness']);
    }
    
  if (isset($_POST['typebusiness']) && !empty($_POST['typebusiness'])) {
        $update['typebusiness'] = $_POST['typebusiness'];
    }
    
      if (isset($_POST['refused']) && !empty($_POST['refused'])) {
        $update['refused'] = $_POST['refused'];
    }
    
      if (isset($_POST['residencevisa']) && !empty($_POST['residencevisa'])) {
        $update['residencevisa'] = $_POST['residencevisa'];
    }
    
      if (isset($_POST['sentenced']) && !empty($_POST['sentenced'])) {
        $update['sentenced'] = $_POST['sentenced'];
    }
    
      if (isset($_POST['deported']) && !empty($_POST['deported'])) {
        $update['deported'] = $_POST['deported'];
    }
    
      if (isset($_POST['humanity']) && !empty($_POST['humanity'])) {
        $update['humanity'] = $_POST['humanity'];
    }
    
      if (isset($_POST['enforcement']) && !empty($_POST['enforcement'])) {
        $update['enforcement'] = $_POST['enforcement'];
    }
    
      if (isset($_POST['mental']) && !empty($_POST['mental'])) {
        $update['mental'] = $_POST['mental'];
    }
    
      if (isset($_POST['medication']) && !empty($_POST['medication'])) {
        $update['medication'] = $_POST['medication'];
    }

	      if (isset($_POST['noneall']) && !empty($_POST['noneall'])) {
        $update['noneall'] = $_POST['noneall'];
    }							
    
    
    
    
     if (isset($_POST['user_crime']) && !empty($_POST['user_crime'])) {
        $update['user_crime'] = $_POST['user_crime'];
    }
    
    
    if (isset($_POST['mental-health']) && !empty($_POST['mental-health'])) {
        $update['user_mental_health'] = $_POST['mental-health'];
    } 
    if (isset($_POST['mental-health-details']) && !empty($_POST['mental-health-details'])) {
        $update['user_mental_health_details'] = $_POST['mental-health-details'];
    } 
    if (isset($_POST['deported']) && !empty($_POST['deported'])) {
        $update['user_deported'] =$_POST['deported'];
    } 
    if (isset($_POST['deported-details']) && !empty($_POST['deported-details'])) {
        $update['user_deported_details'] = $_POST['deported-details'];
    } 
    if (isset($_POST['pregnant']) && !empty($_POST['pregnant'])) {
        $update['user_pregnant'] = $_POST['pregnant'];
    } 
    if (isset($_POST['pregnant-details']) && !empty($_POST['pregnant-details'])) {
        $update['user_pregnant_details'] = $_POST['pregnant-details'];
    } 

    // english

    if (isset($_POST['english-language']) && !empty($_POST['english-language'])) {
        $update['user_english_language'] = normal_text($_POST['english-language']);
    } 

    // motivation
    if (isset($_POST['motivation-interest']) && !empty($_POST['motivation-interest'])) {
        $update['user_motivation_interest'] = normal_text($_POST['motivation-interest']);
    } 
    if (isset($_POST['preferred-date']) && !empty($_POST['preferred-date'])) {
        $update['user_preferred_date'] = normal_text($_POST['preferred-date']);
    }
    if (isset($_POST['motivation-settle']) && !empty($_POST['motivation-settle'])) {
        $update['user_motivation_settle'] = $_POST['motivation-settle'];
    } 
    if (isset($_POST['motivation-country']) && !empty($_POST['motivation-country'])) {
        $update['user_motivation_country'] = normal_text($_POST['motivation-country']);
    } 

    if (isset($_POST['motivation-delay']) && !empty($_POST['motivation-delay'])) {
        $update['user_motivation_delay'] = normal_text($_POST['motivation-delay']);
    } 
    if (isset($_POST['delay-details']) && !empty($_POST['delay-details'])) {
        $update['user_delay_details'] = $_POST['delay-details'];
    } 


    if (isset($_POST['visited-new-zealand']) && !empty($_POST['visited-new-zealand'])) {
        $update['user_visited_new_zealand'] = normal_text($_POST['visited-new-zealand']);
    } 
    if (isset($_POST['visited-new-zealand-long']) && !empty($_POST['visited-new-zealand-long'])) {
        $update['user_visited_new_zealand_long'] = normal_text($_POST['visited-new-zealand-long']);
    } 

    if (isset($_POST['visited-australia']) && !empty($_POST['visited-australia'])) {
        $update['user_visited_australia'] = normal_text($_POST['visited-australia']);
    } 
    if (isset($_POST['visited-australia-long']) && !empty($_POST['visited-australia-long'])) {
        $update['user_visited_australia_long'] = normal_text($_POST['visited-australia-long']);
    } 
    
    if (isset($_POST['emigration-detail']) && !empty($_POST['emigration-detail'])) {
        $update['user_emigration_detail'] = $_POST['emigration-detail'];
    } 

    $update['user_declare'] = '0';
    if (isset($_POST['declare']) && !empty($_POST['declare'])) {
        $update['user_declare'] = '1';
    } else if ($validate) {
        $errors[] = "Declaration must be accepted.";
    }

$datapreview=$_POST['datapreview'];

    if (empty($errors)) {
        

        $update['user_form_status'] = '99%';
        if ($validate || $datapreview=="1") {
            if ($datapreview=="1")
            {
            $update['user_form_status'] = '100%';
            
$crmid=$logged_user['user_id'];            

$servername = "localhost";
$usernameDB = "conzvisa_yourvisauser";
$passwordDB = "6hqQ$~kHoIXU";
$dbname = "conzvisa_yourvisapathCRM";




$dateadded= date('Y-m-d H:i:s');
// Create connection
$connDB = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
// Check connection
if ($connDB->connect_error) {
  die("Connection failed: " . $connDB->connect_error);
}

$sql = "UPDATE tblleads SET status='3' WHERE company='$crmid'";

if ($connDB->query($sql) === TRUE) {
 // echo "Record updated successfully";
} else {
  echo "Error updating record: " . $connDB->error;
}

$connDB->close();
            
            
            
            }
            
        }

        $check = $U->update_user_data($update, $logged_user['user_id']);
        if ($check['status']) {
            if ($datapreview=="1") {
                
             //   ob_start();
              //  $user_id = $logged_user['user_id'];
             //   include('app/mail_content_loader.php');
              //  $contents = ob_get_clean();
//
              //  $headers = "MIME-Version: 1.0" . "\r\n";
               // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
               // $headers .= 'From: <mail@visatrack.co.nz>' . "\r\n";

                //mail($logged_user['user_email'], "Application Submitted Successfully", $contents, $headers);
                
                move('thanks.php');
                
            } 
            elseif ($_POST['finish-later']=="finishlater")
           {
            $U->logout();
            $_SESSION['message'] = ['type' => 'success', 'data' => 'Data saved, you can continue filling later'];
            
            move('index.php');
           }
           else
           {
                
                move('main.php?preview=1');
            
           }
        } else {
            $errors[] = "Unable to update";
        }
    }


}

require_once 'views/layout/header.view.php';
require_once 'views/step-4.view.php';
require_once 'views/layout/footer.view.php';
