<?php
include("admin/includes/controller.php");

/**
 * If user is not logged in, then redirect to home page. If user is logged in, display the form to edit account information with the current email address
 * already in the field.
 */
if(!$session->logged_in){ 
    header("Location: ".$configs->homePage());
} else {	
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $configs->getConfig('SITE_NAME'); ?> - Edit Profile</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<div class="login">
    
    <?php
    /* User has submitted form without errors and user's account has been edited successfully. */
    if(isset($_SESSION['useredit'])){
    unset($_SESSION['useredit']);
   
    echo "<h1>User Account Edit Success!</h1>";
    echo "<p><b>$session->username</b>, your account has been successfully updated. "
       ."<a href='index.php'>Return to Home</a>.</p>";
    } else {
    $form = new Form;
    ?>
    
    <h1>User Account Edit : <?php echo $session->username; ?></h1>
    <form action="../admin/includes/process.php" method="POST">
        <?php echo Csrf::field(); ?>
        <p>
            <input type="password" name="curpass" placeholder="Current Password" value="<?php echo Form::value("curpass"); ?>">
            <?php echo Form::error("curpass"); ?>
        </p>
        <p>
            <input type="password" name="newpass" placeholder="New Password" value="<?php echo Form::value("newpass"); ?>">
            <?php echo Form::error("newpass"); ?>
        </p>
        <p>
            <input type="password" name="conf_newpass" placeholder="Confirm New Password" value="<?php echo Form::value("conf_newpass"); ?>">
            <?php echo Form::error("conf_newpass"); ?>
        </p>
        <p>
            <input type="text" name="email" placeholder="New E-mail Address" value="<?php if(Form::value("email") == ""){ echo $session->userinfo['email'];
            }else{ 
            echo Form::value("email"); } ?>">
            <?php echo Form::error("email"); ?>
        </p>

        <input type="hidden" name="form_submission" value="edit_account">
        <p class="submit"><input type="submit" value="Edit Account"></p>
    </form>
    <?php
    } 
    }
    ?>
</div>
    
<div class="form-help">
<?php echo "<a href='index.php'>Back to Home Page</a>"; ?>
</div>
    
</body>
</html>