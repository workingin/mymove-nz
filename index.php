<?php
include("admin/includes/controller.php");
/*
 * This is an example of the index page of a website. Here users will be able to login. 
 * However, like on most sites the login form doesn't just have to be on the main page,
 * but re-appear on subsequent pages, depending on whether the user has logged in or not.
*/
  if($session->isAdmin()){
        //echo "[<a href=\"\">Admin Control Panel</a>] ";
         header("Location: admin/index.php");
    }
?>
<html>
<head>
    
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VYPMS1NP0H"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VYPMS1NP0H');
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MSF2Q2NT');</script>
<!-- End Google Tag Manager -->


    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="admin/css/style.css" type="text/css" />
    <style>
    body{
    background-image: url("https://portal.mymove.nz/bgnz.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    }
    .button {
      background-color: #4CAF50;
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
    .button2 {background-color: #003e7e;}
    html {
        height: 100%
    }
    .login-error {
        color: #b94a48;
        background: #f2dede;
        border: 1px solid #ebccd1;
        padding: 10px;
        border-radius: 4px;
        margin: 8px 0;
        font-size: 14px;
    }
    </style>
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MSF2Q2NT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
        <!-- BEGIN: Mobile Menu -->
<?php

/* Activation Query String was included in URL - try to activate */
if ((isset($_GET['mode'])) && ($_GET['mode'] == 'activate')) { 
    
    echo "<div class='login'>";
    $session->activateUser($_GET['user'], $_GET['activatecode']); 
    echo "</div>";

/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
} else if($session->logged_in) {
?>
<div class='login'>
<h1>Logged In</h1>
<?
$username=$session->id;

    $sql = "SELECT * FROM users WHERE id='$username' ";
                                                        
                                                            $result = $db->prepare($sql);
                                                            $result->execute();
                                                            while ($row = $result->fetch()) {
                                                               if ($row['jportal']=="1")
                                                               
                                                              {
                                                                   
                                                                   ?>
                                                                   <meta http-equiv="refresh" content="0; url=main.php?section=welcome&cid=1" />

                                                                   <?
                                                              }
                                                              else 
                                                              {
                                                                ?>
                                                                   <meta http-equiv="refresh" content="0; url=/settlement.php?section=Welcome&cid=14&viewpage=1&pid=44" />

                                                                   <?
                                                              }
                                                              
                                                              }
                                                         
                                                              
                                                              
?>

   
<?php
  
?>   
    
        <?php
     
       
        ?>
</div>
<?php
} else {
$form = new Form;
/**
 * User not logged in, display the login form. If the user has already tried to login, 
 * but errors were found, they will be displayed.
 */
?>

<div class="login" style="width:320px;"><br>
  <center>  <img src="/img/logo.png" style="width:200px"></center>
    <br>
    <?php if (Form::error("form")) { echo "<div class='login-error' role='alert'>".Form::error('form')."</div>"; } ?>
    <form action="admin/includes/process.php?path=referrer" method="POST">
        <?php echo Csrf::field(); ?>
        <p>
            <input type="text" style=" width: 100%;
  padding: 12px;
  margin: 5px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  text-decoration: none;" name="username" placeholder="Username" value="<?php echo Form::value("username"); ?>">
        </p>
        <?php if (Form::error("username")) { echo "<div class='login-error' role='alert'>".Form::error('username')."</div>"; } ?>
        <p>
            <input style=" width: 100%;
  padding: 12px;
  margin: 5px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  text-decoration: none;" type="password" name="password" placeholder="Password" value="">
        </p>
        <?php if (Form::error("password")) { echo "<div class='login-error' role='alert'>".Form::error('password')."</div>"; } ?>
       
        <div style="padding-top:10px; padding-bottom:20px;">
            <p style="color: #616161; font-size: 12px;">Forgot your password? <a style="color:#303998" href="forgotpass.php#reset">Click here to reset it</a></p>
            <p style="color: #616161; font-size: 12px;">Don't have an account? <a style="color:#303998" target="_blank" href="https://www.workingin-newzealand.com/mymove/">Click here to find out more</a></p>
        </div>
        
        <input type="hidden" name="form_submission" value="login">
          <input type="submit" style="" class="" name="commit" value="Login">   
    </form>  
     
</div>


        
<?php
}
?>

    <?php include __DIR__ . '/admin/includes/flash_messages.php'; ?>
    <script src="admin/js/jquery-3.6.0.min.js"></script>
    <script src="admin/js/flash-notify.js"></script>
</body>
</html>