<?php 
include("includes/controller.php");
if($session->isAdmin()){
    header("Location: ".$configs->homePage());
    exit;
}
$form = new Form;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MyMove.nz - Portal by Working In</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="fonts/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">

        <link href="css/style.css" rel="stylesheet">
        <script src="https://www.google.com/recaptcha/api.js?render=6Le6JFYqAAAAAHqht4wgTXCa2vvTU0VBvE58l0mB"></script>
        
    </head>

    <body>
        <!-- Pen Title-->
        <div class="pen-title">
            
        </div>
        <!-- Form Module-->
        <div class="module form-module">
            <div class="toggle" id="link-login" style="display: none"><i class="fas fa-pencil-alt"></i>Login
                <div class="tooltip in">Click Me</div>
            </div>
            <!-- Login -->
            <div class="form" id="form-login">
                <h2>Admin Login</h2>
                <?php if (Form::error("form")) { echo "<div class='help-block login-error-banner' id='login-error' role='alert'>".Form::error('form')."</div>"; } ?>
                <form action="includes/process.php" method="POST">
                    <?php echo Csrf::field(); ?>
                    <input type="text" name="username" placeholder="Username" value="<?php echo Form::value("username"); ?>"/>
                    <?php if(Form::error("username")) { echo "<div class='help-block' id='user-error' role='alert'>".Form::error('username')."</div>"; } ?>
                    <input type="password" name="password" placeholder="Password"/>
                    <?php if(Form::error("password")) { echo "<div class='help-block' id='pass-error' role='alert'>".Form::error('password')."</div>"; } ?>
                    <button>Login</button><br><br>
                    <!-- Can be removed on production --><small><a href="https://portal.mymove.nz/" target="_blank">Not an admin? - Click here</a></small>
                    <input type="hidden" name="form_submission" value="adminlogin">
                </form>
            </div>
            
            <!-- Reset Password -->
            <div class="form" id="form-reset" style="display: none">
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
                <?php if (Form::error("form")) { echo "<div class='help-block' id='csrf-error'>".Form::error('form')."</div>"; } ?>
                <form action="includes/process.php" method="POST">
                    <?php echo Csrf::field(); ?>
                    <input type="text" name="user"  placeholder="Username" value="<?php echo Form::value("user"); ?>"/>
                    <?php if(Form::error("user")) { echo "<div class='help-block' id='user-error'>".Form::error('user')."</div>"; } ?>
                    <input type="email" name="email" placeholder="Email Address" value="<?php echo Form::value("email"); ?>"/>
                    <?php if(Form::error("email")) { echo "<div class='help-block' id='user-error'>".Form::error('email')."</div>"; } ?>
                    <input type="hidden" name="form_submission" value="forgot_password">
                    <!-- Invisible recaptcha token -->
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                    <button type="submit">Reset Password</button>
                </form>
                <?php } ?>
            </div>
            
            <!-- Forgot Password Footer -->
            <div class="cta" id="link-reset"><a href="#reset">Forgot your password?</a></div>
        </div>
        <!-- END Form Module-->
        
        <!-- Footer -->
        <div class="text-muted text-center" id="login-footer">
            
        </div>

        <!-- JavaScript Resources -->
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/admin-login.js"></script>
        <?php include __DIR__ . '/includes/flash_messages.php'; ?>
        <script src="js/flash-notify.js"></script>
        
        <script>$(function(){ Login.init(); });</script>
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
