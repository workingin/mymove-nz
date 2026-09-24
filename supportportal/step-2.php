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

// getting user's previous occuptions data

$occupations = $U->get_occupations_by_user($logged_user['user_id'], 'S');
if ($occupations['status']) {
    $occupations = $occupations['data'];
} else {
    $occupations = [];
}

$_educations = $U->get_educations_by_user($logged_user['user_id'], 'S');
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
    
    // job 
    if (isset($_POST['job-offer']) && !empty($_POST['job-offer'])) {
        $update['user_job_offer'] = normal_text($_POST['job-offer']);
    } 
    if (isset($_POST['job-title']) && !empty($_POST['job-title'])) {
        $update['user_job_title'] = normal_text($_POST['job-title']);
    }
    
    if (isset($_POST['user_offer_employer']) && !empty($_POST['user_offer_employer'])) {
        $update['user_offer_employer'] = normal_text($_POST['user_offer_employer']);
    }
    
    if (isset($_POST['user_offer_salary']) && !empty($_POST['user_offer_salary'])) {
        $update['user_offer_salary'] = normal_text($_POST['user_offer_salary']);
    }
    
    if (isset($_POST['user_offer_location']) && !empty($_POST['user_offer_location'])) {
        $update['user_offer_location'] = normal_text($_POST['user_offer_location']);
    }
    
   
        if (isset($_POST['work_duties']) && !empty($_POST['work_duties'])) {
        $update['work_duties'] = normal_text($_POST['work_duties']);
    } 
    
          if (isset($_POST['start_date']) && !empty($_POST['start_date'])) {
        $update['start_date'] = normal_text($_POST['start_date']);
    } 
    
    if (isset($_POST['job-experience']) && !empty($_POST['job-experience'])) {
        $update['user_job_experience'] = normal_text($_POST['job-experience']);
    } 
    if (isset($_POST['job-qualification']) && !empty($_POST['job-qualification'])) {
        $update['user_job_qualification'] = normal_text($_POST['job-qualification']);
    } 
    if (isset($_POST['job-permanent']) && !empty($_POST['job-permanent'])) {
        $update['user_job_permanent'] = normal_text($_POST['job-permanent']);
    } 

    // current occuptation
    
    if (isset($_POST['current-company']) && !empty($_POST['current-company'])) {
        $update['user_current_company'] = normal_text($_POST['current-company']);
    } 
    if (isset($_POST['current-position']) && !empty($_POST['current-position'])) {
        $update['user_current_position'] = normal_text($_POST['current-position']);
    } 
    if (isset($_POST['current-start']) && !empty($_POST['current-start'])) {
        $update['user_current_start'] = normal_text($_POST['current-start']);
    } 
    if (isset($_POST['current-end']) && !empty($_POST['current-end'])) {
        $update['user_current_end'] = normal_text($_POST['current-end']);
    } 
    if (isset($_POST['current-type']) && !empty($_POST['current-type'])) {
        $update['user_current_type'] = normal_text($_POST['current-type']);
    } 
    if (isset($_POST['current-description']) && !empty($_POST['current-description'])) {
        $update['user_current_description'] = $_POST['current-description'];
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
        $update['cvfile'] = normal_text($cvfile);
    } 
}
else
{
    
}
    
    
    
    
    
    
    // education

    if (isset($_POST['education-highest']) && !empty($_POST['education-highest'])) {
        $update['user_education_highest'] = normal_text($_POST['education-highest']);
    } 
    
     if (isset($_POST['user_highest_edu_year']) && !empty($_POST['user_highest_edu_year'])) {
        $update['user_highest_edu_year'] = normal_text($_POST['user_highest_edu_year']);
    } 
    
    
    if (isset($_POST['education-other']) && !empty($_POST['education-other'])) {
        $update['user_education_other'] = normal_text($_POST['education-other']);
    }
    
     if (isset($_POST['user_other_edu_year']) && !empty($_POST['user_other_edu_year'])) {
        $update['user_other_edu_year'] = normal_text($_POST['user_other_edu_year']);
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

    if (empty($errors)) {
        if ($validate) {
            $update['user_form_status'] = '40%';
        }

        $check = $U->update_user($update, $previous_jobs, $educations, 'S', $logged_user['user_id']);
        if ($check['status']) {
            $_SESSION['message'] = ['type' => 'success', 'data' => 'Changes saved successfully'];
            if (isset($_POST['save-next'])) {
                     $edithis=$_GET['edithis'];
               
               if ($edithis=="1")
               {
                   move('main.php?rls='. $rls );
               }
                $rls=$_GET['rls'];
                if ($_GET['rls']=="1")
                {
                     move('step-3.php?rls='.$rls);
                }
                else
                {
                move('step-3.php?rls='.$rls);
                }
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
require_once 'views/step-2.view.php';
require_once 'views/layout/footer.view.php';
