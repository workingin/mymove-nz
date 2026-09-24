<?php 
include("admin/includes/controller.php");
$form = new Form;
?>
<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/ico" href="favicon.ico">

        <link href="admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="admin/fonts/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">

        <link href="admin/css/style.css" rel="stylesheet">
        
        <!-- JavaScript Resources -->
        <script src="admin/js/jquery-3.6.0.min.js"></script>
        <script src="admin/js/jquery-ui.js"></script>
        <script src="admin/js/bootstrap.min.js"></script>
        <script src="js/login.js"></script>
        
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="https://www.google.com/recaptcha/api.js?render=6Le6JFYqAAAAAHqht4wgTXCa2vvTU0VBvE58l0mB"></script>
        <script>$(function(){ Login.init(); });</script>
           <style>
                body{
    
                background-image: url("https://portal.mymove.nz/bgnz.jpg");
                  background-repeat: no-repeat;
                      background-size: cover;
                }
                
                .button {
                  background-color: #4CAF50; /* Green */
                  border: none;
                  color: white;
                  padding: 15px 32px;
                  text-align: center;
                  text-decoration: none;
                  display: inline-block;
                  font-size: 16px;
                  margin: 4px 2px;
                  cursor: pointer;
                }
                
                .button2 {background-color: #003e7e;} /* Blue */
                
                html {
                    height: 100%
                }
            </style>
    </head>

    <body>
        <!-- Pen Title-->
       
        <!-- Form Module-->
        <div class="module form-module" style="margin-top: 20lvh;">
            <?php if(!$session->logged_in){ ?>
       
            
            
            <!-- Reset Password -->
            <div class="form" id="form-reset" style="display: ">
                <?php
                if(isset($_SESSION['sentpassemail'])){
                /* New password was generated for user and sent to user's email address. */
                    if($_SESSION['sentpassemail']){
                        echo "<h1>Password Link Sent</h1>";
                        echo "<p>Thanks! A link to change your password has been sent to your e-mail address.</p>";
                    /* Email could not be sent. */
                    } else{
                        echo "<h1>Password Link Not Sent!</h1>";
                        echo "<p>We could not send an email with your password reset link. Please contact Admin for more assistance or <a href='login.php'>try again</a>.</p>";
                    }
                    unset($_SESSION['sentpassemail']);
                } else {
                unset($_SESSION['sentpassemail']);
                ?>
                <h2>Reset Your Password</h2>
                <form action="admin/includes/process.php" method="POST">
                    <?php echo Csrf::field(); ?>
                    <input type="text" name="user"  placeholder="Username" value="<?php echo Form::value('pwd_user'); ?>"/>
                    <?php if(Form::error("pwd_user")) { echo "<div class='help-block' id='user-error'>".Form::error('pwd_user')."</div>"; } ?>
                    <input type="email" name="email" placeholder="Email Address" value="<?php echo Form::value('pwd_email'); ?>"/>
                    <?php if(Form::error("pwd_email")) { echo "<div class='help-block' id='user-error'>".Form::error('pwd_email')."</div>"; } ?>
                    <input type="hidden" name="form_submission" value="forgot_password">
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                    <button>Reset Password</button>
                </form>
                <?php } ?>
                <p style="margin-top:20px; "><a style="color: #303988;text-decoration:underline;" href="https://portal.mymove.nz/">Go back</a></p>
            </div>
            
            
            
            <!-- Activation -->
            <div class="form" id="form-activate" style="display: none">
                <?php if ((isset($_GET['mode'])) && ($_GET['mode'] == 'activate')) { $session->activateUser($_GET['user'], $_GET['activatecode']); } ?>
            </div>        
            
            <!-- Forgot Your Password Bar -->
            <div class="cta" id="link-reset"><a href="#reset">Forgot your password?</a></div>
            
            <!-- Logged In -->
            <?php } else { ?>
            <div class="toggle" id="link-logged-in"><i class="fas fa-pencil-alt"></i>Back
                <div class="tooltip in">Click Me</div>
            </div>
            <div class="form" id="form-loggedin">
                <h2><?php echo "Welcome " . $session->username; ?></h2>
                <?php if($session->isAdmin()){ echo "<p><a href=\"admin/index.php\">Admin Control Panel</a></p>"; } ?> 
                <p><a href="#link-user-profile" id="link-user-profile">User Profile</a></p>
                <p><a href="admin/logout.php?path=referrer">Logout</a></p>
            </div>
            <div class="form" id="form-userprofile">
                <h2>User Profile</h2>
                <?php
                /* get requested user information from database - add/delete as applicable */
                $user_info = $functions->getUserInfo($session->username);

                /* Display the user's info */
                echo "<p><strong>Username: </strong>".$user_info['username']."</p>";
                echo "<p><strong>First Name: </strong>".$user_info['firstname']."</p>";
                echo "<p><strong>Last Name: </strong>".$user_info['lastname']."</p>";
                echo "<p><strong>Email: </strong> ".$user_info['email']."</p>";
                ?>
                <a href="#link-edit-user" id="link-edit-user">Edit Account</a>
            </div>
     
            <?php } ?>
        </div>
        
        <script>
            grecaptcha.ready(function() {
                grecaptcha.execute('6Le6JFYqAAAAAHqht4wgTXCa2vvTU0VBvE58l0mB', {action: 'homepage'}).then(function(token) {
                    // Add token to form
                    document.getElementById('g-recaptcha-response').value = token;
                });
            });
        </script>
        <script>
        // Initialize Tooltips
        $('[data-toggle="tooltip"], .show-tooltip').tooltip({container: 'body', animation: false});        
        </script>

    </body>
</html>
