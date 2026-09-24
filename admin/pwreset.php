<?php 
include("includes/controller.php");
?>
<!DOCTYPE html>
<html>
    <head>
                <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="fonts/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">

        <link href="css/style.css" rel="stylesheet">
        
    </head>

    <body>
        <!-- Pen Title-->
  
        <!-- Form Module-->
        <div class="module form-module">
            <!-- Reset Password -->
            <div class="form" id="form-reset">
                <?php
                if((isset($_GET['key']) AND (strlen($_GET['key']) == 36 ))){
                $pwdkey = $_GET['key'];
                $time = time() - 7200; // 2 Hours
                $sql = $db->prepare("SELECT * FROM user_temp WHERE detail = :pwdkey AND timestamp >= '$time' AND type = 'pwd' LIMIT 1");
                $sql->execute(array(':pwdkey' => $pwdkey));
                $count = $sql->rowCount();
                $array = $sql->fetch();
                    if($count){
                        $userid = $array['userid'];
                        $id = $array['id']; 
                        $form = new Form();
                        ?>
                        <h2>Password Reset</h2>                       
                        <form action="../admin/includes/pwdprocess.php" method="POST">
                            <?php echo Csrf::field(); ?>
                        <input type="password" name="password" placeholder="New Password"/>                      
                        <input type="password" name="confirm_password" placeholder="Confirm New Password" />
                        <?php if(Form::error("password")) { echo "<div class='help-block' id='user-error'>".Form::error('password')."</div>"; } ?>
                        <input type="hidden" name="userid" value="<?php echo $userid; ?>" />
                        <input type="hidden" name="pwdkey" value="<?php echo $pwdkey; ?>" />
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <button>Save Changes</button>               
                        </form>
                        <?php
                    } else {
                        echo "The reset link you have followed is invalid. Please try again.";
                    }
                } else {
                    if(isset($_SESSION['password_changed']) AND ($_SESSION['password_changed'] == 1)){
                        echo "Password updated!";
                    } else {
                        echo "The reset link you have followed is invalid. Please try again.";
                    }
                    unset($_SESSION['password_changed']);
                }
                ?>
            </div>
        </div>
        <!-- END Form Module-->
        
        <!-- Footer -->
   

        <!-- JavaScript Resources -->
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>
</html>
