<?php include("../admin/includes/controller.php");
if($session->logged_in){
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Xavier - PHP Login Script & User Registration </title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>   
</head>
<body>
<?php
/* The user has submitted the registration form and the results have been processed. */
if ($configs->getConfig('ACCOUNT_ACTIVATION') == 4){
    echo "<div class='login'><h1>Registration Disabled</h1>";
    echo "<p>We're sorry but registration is currently disabled. Please try again at a later time.</p></div>";
} else if(isset($_SESSION['regsuccess'])){
    
    $user = $_SESSION['reguname'];
    
    if ($_SESSION['regsuccess']==6){
        echo "<div class='login'><h1>Registration is currently disabled!</h1>";
        echo "<p>Registration to this site is currently disabled. Please try again at a later time.</p></div>";
    }
    /* Registration was successful */
    else if($_SESSION['regsuccess']==0 || $_SESSION['regsuccess']==5){
        echo "<div class='login'><h1>Registered!</h1>";
        echo "<p>Thank you <b>".$user."</b>, your information has been added to the database, you may now <a href='index.php'>log in</a>.</p></div>";
    }
    else if($_SESSION['regsuccess']==3){
        echo "<div class='login'><h1>Registered!</h1>";
        echo "<p>Thank you <b>".$user."</b>, your account has been created. "
            ."However, this board requires account activation. An activation key has been sent to the e-mail address you provided. Please check your e-mail for further information.</p></div>";
    }
    else if($_SESSION['regsuccess']==4){
        echo "<div class='login'><h1>Registered!</h1>";
        echo "<p>Thank you <b>".$user."</b>, your account has been created. However, this board requires account activation by an Admin. An e-mail has been sent to them and you will be informed when your account has been activated.</p></div>";
    }
    /* Registration failed */
    else if ($_SESSION['regsuccess']==2){
        echo "<div class='login'><h1>Registration Failed</h1>";
        echo "<p>An error has occurred and your registration for the username <b>".$user."</b>, could not be completed. Please try again at a later time.</p></div>";
    }
    unset($_SESSION['regsuccess']);
    unset($_SESSION['reguname']);    
    
/* Activation Query String was included in URL - try to activate */
} else if ((isset($_GET['mode'])) && ($_GET['mode'] == 'activate')) {
    $session->activateUser($_GET['user'], $_GET['activatecode']); 
        
/* The user has not filled out the registration form. */
} else {

?>
<div class='login'>
    <h1>Register</h1>
    <?php
    $form = new Form;
    if(Form::$num_errors > 0){ echo "<div style='color:red'>".Form::$num_errors." error(s) found</div>"; }
    ?>
    <form action="../admin/includes/process.php" method="post">
        <?php echo Csrf::field(); ?>
        <p><input type="text" name="user" placeholder="Username" value="<?php echo Form::value("user"); ?>" /><?php echo Form::error("user"); ?></p>
        <p><input type="text" name="firstname" placeholder="First Name" value="<?php echo Form::value("firstname"); ?>" /><?php echo Form::error("firstname"); ?></p>
        <p><input type="text" name="lastname" placeholder="Last Name" value="<?php echo Form::value("lastname"); ?>" /><?php echo Form::error("lastname"); ?></p>
	<p><input type="password" name="pass" placeholder="Password" value="<?php echo Form::value("pass"); ?>" /><?php echo Form::error("pass"); ?></p>
	<p><input type="password" name="conf_pass" placeholder="Confirm Password" value="<?php echo Form::value("conf_pass"); ?>" /><?php echo Form::error("pass"); ?></p>
        <p><input type="text" name="email" placeholder="E-mail Address" value="<?php echo Form::value("email"); ?>" /><?php echo Form::error("email"); ?></p>
        <p><input type="text" name="conf_email" placeholder="Confirm E-mail Address" value="<?php echo Form::value("conf_email"); ?>" /><?php echo Form::error("email"); ?></p>

    <?php
        // Is CAPTCHA enabled? Include Google ReCaptcha test
        if ($configs->getConfig('ENABLE_CAPTCHA')){ echo "<p class='g-recaptcha captchsize' data-sitekey='6Lf4nUkUAAAAABquLdc-ll9icBH7xzK4GFjUfiI1'></p>"; }
        if(Form::error("recaptcha")) { echo "<div class='help-block' id='email-error'>".Form::error('recaptcha')."</div>"; } 
    ?>

    <p class="submit"><input type="submit" value="Register!" id="submit" /></p>
    <!-- The following div tag displays a hidden form field in an attempt at tricking automated bots. -->
    <div style='display:none; visibility:hidden;'><input type='text' name='killbill' maxlength='50' /></div>
    <input type="hidden" name="form_submission" value="register">
    </form>
</div>
    
<div class="form-help">
    <?php echo "<a href='index.php'>Back to Home Page</a>"; ?>
</div>

<?php 
}
?>
</body>
</html>