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
    '1' => 'Married',
    '2' => 'Single',
    '3' => 'Defacto',
];
 
 $doyouhavechildar = [
    '0' => 'No',
    '1' => 'Yes',
    
];
 
 
 
$occupations = $U->get_occupations_by_user($logged_user['user_id'], 'P');
if ($occupations['status']) {
    $occupations = $occupations['data'];
} else {
    $occupations = [];
}

$_childrens = $U->get_childrens_by_user($logged_user['user_id']);
if ($_childrens['status']) {
    $_childrens = $_childrens['data'];
} else {
    $_childrens = [];
}


$_educations = $U->get_educations_by_user($logged_user['user_id'], 'P');
if ($_educations['status']) {
    $_educations = $_educations['data'];
} else {
    $_educations = [];
}


if (isset($_POST) && !empty($_POST)) {
    $validate = false;
    if (isset($_POST['save-next'])) {
        $validate = true;
    }
    
    $update = [];

    // partner 
    if (isset($_POST['partner-first-name']) && !empty($_POST['partner-first-name'])) {
        $update['user_partner_first_name'] = normal_text($_POST['partner-first-name']);
    } 
    
   
   
        //PartnerCVResume
    
 //CVResume
    
  $total = count($_FILES['files']['tmp_name']);
 
  for($i=0;$i<$total;$i++){
    $fileName = $_FILES['files']['name'][$i];
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    
    $filenameW = array_pop(array_reverse(explode(".", $fileName)));
$time = strtotime('today');
$mycode = str_shuffle($time);

    $newFileName =$filenameW."_".$mycode;
    $finalfilename=$newFileName.'.'.$ext;
    $fileDest = 'cvresumes/'.$newFileName.'.'.$ext;
    if($ext === 'pdf' || 'doc' || 'docx' || 'jpeg' || 'JPG'){
        move_uploaded_file($_FILES['files']['tmp_name'][$i], $fileDest);
  
  
    }else{
      echo 'Pdfs, docx and jpegs only please';
    }
  }

if  ($ext !=="")
{
$cvfile=$finalfilename;
  
        if (isset($cvfile) && !empty($cvfile)) {
        $update['partner_cv'] = normal_text($cvfile);
    } 
}
else
{
    
}
   
   
   
   
   
    
    if (isset($_POST['partner-last-name']) && !empty($_POST['partner-last-name'])) {
        $update['user_partner_last_name'] = normal_text($_POST['partner-last-name']);
    } 
    if (isset($_POST['partner-dob']) && !empty($_POST['partner-dob'])) {
        $update['user_partner_dob'] = normal_text($_POST['partner-dob']);
    } 
    if (isset($_POST['partner-country']) && !empty($_POST['partner-country'])) {
        $update['user_partner_country'] = normal_text($_POST['partner-country']);
    } 
    if (isset($_POST['partner-marital']) && !empty($_POST['partner-marital'])) {
        $update['user_partner_marital'] = normal_text($_POST['partner-marital']);
    } 
    if (isset($_POST['partner-marriage-date']) && !empty($_POST['partner-marriage-date'])) {
        $update['user_partner_marriage_date'] = normal_text($_POST['partner-marriage-date']);
    } 

    if (isset($_POST['relationship-start']) && !empty($_POST['relationship-start'])) {
        $update['user_relationship_start'] = normal_text($_POST['relationship-start']);
    } 
    if (isset($_POST['partner-lived']) && !empty($_POST['partner-lived'])) {
        $update['user_partner_lived'] = normal_text($_POST['partner-lived']);
    } 
    if (isset($_POST['partner-evidence']) && !empty($_POST['partner-evidence'])) {
        $update['user_partner_evidence'] = normal_text($_POST['partner-evidence']);
    } 
    if (isset($_POST['partner-married-before']) && !empty($_POST['partner-married-before'])) {
        $update['user_partner_married_before'] = normal_text($_POST['partner-married-before']);
    } 
    if (isset($_POST['divorce-final']) && !empty($_POST['divorce-final'])) {
        $update['user_divorce_final'] = normal_text($_POST['divorce-final']);
    } 

    if (isset($_POST['divorce-child-custody']) && !empty($_POST['divorce-child-custody'])) {
        $update['user_divorce_child_custody'] = normal_text($_POST['divorce-child-custody']);
    } 
    if (isset($_POST['child-custody']) && !empty($_POST['child-custody'])) {
        $update['user_child_custody'] = normal_text($_POST['child-custody']);
    } 
    if (isset($_POST['asset-value']) && !empty($_POST['asset-value'])) {
        $update['user_asset_value'] = normal_text($_POST['asset-value']);
    } 

    // Partner’s job

    if (isset($_POST['partner-job-in']) && !empty($_POST['partner-job-in'])) {
        $update['user_partner_job_in'] = normal_text($_POST['partner-job-in']);
    } 
    
    if (isset($_POST['partner-job-position']) && !empty($_POST['partner-job-position'])) {
        $update['user_partner_job_position'] = normal_text($_POST['partner-job-position']);
    } 
    
    if (isset($_POST['partner-job-qualification']) && !empty($_POST['partner-job-qualification'])) {
        $update['user_partner_job_qualification'] = normal_text($_POST['partner-job-qualification']);
    } 
    
    if (isset($_POST['partner-job-experience']) && !empty($_POST['partner-job-experience'])) {
        $update['user_partner_job_experience'] = normal_text($_POST['partner-job-experience']);
    } 
    
    if (isset($_POST['partner-job-permanent']) && !empty($_POST['partner-job-permanent'])) {
        $update['user_partner_job_permanent'] = normal_text($_POST['partner-job-permanent']);
    } 
    
    //family in au
    
     if (isset($_POST['bornnzau']) && !empty($_POST['bornnzau'])) {
        $update['bornnzau'] = normal_text($_POST['bornnzau']);
    } 
    
     if (isset($_POST['familyinau']) && !empty($_POST['familyinau'])) {
        $update['familyinau'] = normal_text($_POST['familyinau']);
    } 
    
     if (isset($_POST['familyinaurelation']) && !empty($_POST['familyinaurelation'])) {
        $update['familyinaurelation'] = normal_text($_POST['familyinaurelation']);
    } 
     if (isset($_POST['familyaulocation']) && !empty($_POST['familyaulocation'])) {
        $update['familyaulocation'] = normal_text($_POST['familyaulocation']);
    } 
     if (isset($_POST['familyauvisa']) && !empty($_POST['familyauvisa'])) {
        $update['familyauvisa'] = normal_text($_POST['familyauvisa']);
    } 
    
        if (isset($_POST['familyadditional']) && !empty($_POST['familyadditional'])) {
        $update['familyadditional'] = normal_text($_POST['familyadditional']);
    } 
    

    // current occuptation
    
    if (isset($_POST['current-company']) && !empty($_POST['current-company'])) {
        $update['user_partner_current_company'] = normal_text($_POST['current-company']);
    } 
    if (isset($_POST['current-position']) && !empty($_POST['current-position'])) {
        $update['user_partner_current_position'] = normal_text($_POST['current-position']);
    } 
    if (isset($_POST['current-start']) && !empty($_POST['current-start'])) {
        $update['user_partner_current_start'] = normal_text($_POST['current-start']);
    } 
    if (isset($_POST['current-end']) && !empty($_POST['current-end'])) {
        $update['user_partner_current_end'] = normal_text($_POST['current-end']);
    } 
    if (isset($_POST['current-type']) && !empty($_POST['current-type'])) {
        $update['user_partner_current_type'] = normal_text($_POST['current-type']);
    } 
    if (isset($_POST['current-description']) && !empty($_POST['current-description'])) {
        $update['user_partner_current_description'] = $_POST['current-description'];
    } 

    // previous occupation

    $previous_jobs = [];

    if (isset($_POST['previous-company']) && !empty($_POST['previous-company'])) {

        if (!is_array($_POST['previous-company'])) {
            $errors[] = "Company field type incorrect";
        }
        if (!is_array($_POST['previous-position'])) {
            $errors[] = "Company field type incorrect";
        }
        if (!is_array($_POST['previous-start'])) {
            $errors[] = "Company field type incorrect";
        }
        if (!is_array($_POST['previous-end'])) {
            $errors[] = "Company field type incorrect";
        }
        if (!is_array($_POST['previous-type'])) {
            $errors[] = "Company field type incorrect";
        }
        if (!is_array($_POST['previous-description'])) {
            $errors[] = "Company field type incorrect";
        }

        if (empty($errors)) {
            // checking if all fields are submitted
            if (count($_POST['previous-company']) === count($_POST['previous-position']) && count($_POST['previous-start']) === count($_POST['previous-end']) && count($_POST['previous-type']) === count($_POST['previous-description'])) {
                foreach ($_POST['previous-company'] as $i => $previous_company) {
                    $previous_jobs[] = [
                        'company' => $previous_company,
                        'position' => $_POST['previous-position'][$i],
                        'start' => $_POST['previous-start'][$i],
                        'end' => $_POST['previous-end'][$i],
                        'type' => $_POST['previous-type'][$i],
                        'description' => $_POST['previous-description'][$i],
                    ];
                }
            } else {
                $errors[] = "Previous occupation field imbalance";
            }
        }

    }
    
    // education

    if (isset($_POST['education-highest']) && !empty($_POST['education-highest'])) {
        $update['user_partner_education_highest'] = normal_text($_POST['education-highest']);
    } 
    if (isset($_POST['education-other']) && !empty($_POST['education-other'])) {
        $update['user_partner_education_other'] = normal_text($_POST['education-other']);
    }
    
    $educations = [];

    if (isset($_POST['education-title']) && !empty($_POST['education-title'])) {

        if (!is_array($_POST['education-title'])) {
            $errors[] = "Company field type incorrect";
        }
        if (!is_array($_POST['education-major'])) {
            $errors[] = "Company field type incorrect";
        }
        if (!is_array($_POST['education-institute'])) {
            $errors[] = "Company field type incorrect";
        }
        if (!is_array($_POST['education-qualification'])) {
            $errors[] = "Company field type incorrect";
        }
        if (!is_array($_POST['education-certificate'])) {
            $errors[] = "Company field type incorrect";
        }

        if (empty($errors)) {

            // checking if all fields are submitted
            if (count($_POST['education-title']) === count($_POST['education-major']) && count($_POST['education-institute']) === count($_POST['education-qualification']) && count($_POST['education-qualification']) === count($_POST['education-certificate'])) {
                
                foreach ($_POST['education-title'] as $i => $education_title) {
                    $educations[] = [
                        'title' => $education_title,
                        'major' => $_POST['education-major'][$i],
                        'institute' => $_POST['education-institute'][$i],
                        'qualification' => $_POST['education-qualification'][$i],
                        'certificate' => $_POST['education-certificate'][$i],
                    ];
                }

            } else {
                $errors[] = "Previous occupation field imbalance";
            }

        }

    }

    // children

    if (isset($_POST['children']) && !empty($_POST['children'])) {
        $update['user_children'] = normal_text($_POST['children']);
    } 

 if (isset($_POST['doyouhavechild']) && !empty($_POST['doyouhavechild'])) {
        $update['doyouhavechild'] = normal_text($_POST['doyouhavechild']);
    } 
    
    
    if (isset($_POST['children-emigrating']) && !empty($_POST['children-emigrating'])) {
        $update['user_children_emigrating'] = normal_text($_POST['children-emigrating']);
    } 
    if (isset($_POST['children-previous']) && !empty($_POST['children-previous'])) {
        $update['user_children_previous'] = normal_text($_POST['children-previous']);
    } 
    if (isset($_POST['children-biological']) && !empty($_POST['children-biological'])) {
        $update['user_children_biological'] = normal_text($_POST['children-biological']);
    } 
    if (isset($_POST['children-single']) && !empty($_POST['children-single'])) {
        $update['user_children_single'] = normal_text($_POST['children-single']);
    } 
    if (isset($_POST['children-child']) && !empty($_POST['children-child'])) {
        $update['user_children_child'] = normal_text($_POST['children-child']);
    } 
    if (isset($_POST['children-self-support']) && !empty($_POST['children-self-support'])) {
        $update['user_children_self_support'] = normal_text($_POST['children-self-support']);
    } 
    if (isset($_POST['children-tertiary']) && !empty($_POST['children-tertiary'])) {
        $update['user_children_tertiary'] = normal_text($_POST['children-tertiary']);
    } 

    
    $childrens = [];

    if (isset($_POST['child-name']) && !empty($_POST['child-name'])) {

        if (!is_array($_POST['child-name'])) {
            $errors[] = "Child field type incorrect";
        }
        if (!is_array($_POST['child-dob'])) {
            $errors[] = "Child field type incorrect";
        }
        if (!is_array($_POST['child-country'])) {
            $errors[] = "Child field type incorrect";
        }

        if (empty($errors)) {
            // checking if all fields are submitted
            if (count($_POST['child-name']) === count($_POST['child-dob']) && count($_POST['child-dob']) === count($_POST['child-country'])) {
                foreach ($_POST['child-name'] as $i => $child_name) {
                    $childrens[] = [
                        'child_name' => $child_name,
                        'dob' => $_POST['child-dob'][$i],
                        'country' => $_POST['child-country'][$i],
                    ];
                }
            } else {
                $errors[] = "Child field imbalance";
            }
        }

    }
$doyouhavechild=  $_POST['doyouhavechild'];

    if (empty($errors)) {
        if ($validate) {
            $update['user_form_status'] = '60%';
        }

        $check = $U->update_user_partner($update, $previous_jobs, $educations,$childrens, 'P', $logged_user['user_id']);
        if ($check['status']) {
            $_SESSION['message'] = ['type' => 'success', 'data' => 'Changes saved successfully'];
            if (isset($_POST['save-next'])) {
                     $edithis=$_GET['edithis'];
               
               if ($edithis=="1")
               {
                   move('main.php?rls='. $rls );
               }
                move('step-4.php?doy='.$doyouhavechild);
                
            } else {
                $U->logout();
                $_SESSION['message'] = ['type' => 'success', 'data' => 'Data saved, you can continue filling later'];
                move('index.php');
            }
        } else {
            $errors[] = "Unable to update";
        }
    }

}

require_once 'views/layout/header.view.php';
require_once 'views/step-3.view.php';
require_once 'views/layout/footer.view.php';
