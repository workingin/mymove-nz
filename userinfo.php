<?php
include("admin/includes/controller.php");

if (!isset($_GET['user'])) { 
    header("Location: ".$configs->loginPage());
} else if (strtolower($_GET['user']) == strtolower(ADMIN_NAME)) {
    header("Location: ".$configs->loginPage());
}
$req_user = trim(filter_input(INPUT_GET, 'user'));
$req_user_info = $functions->getUserInfo($req_user);
if($req_user_info['userlevel'] == '10') { header("Location: ".$configs->loginPage()); exit; }
?>

<html>
<head>
    
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<div class='login'>
<?php
/* Requested Username error checking */
if(!$req_user || strlen($req_user) == 0 ||
   !$functions->usernameRegex($req_user) ||
   !$functions->usernameTaken($req_user, $db)){
   die("Username not registered");
}

/* Logged in user viewing own account */
if(strcmp($session->username,$req_user) == 0){
    echo "<h1>My Account</h1>";
}
/* Visitor not viewing own account */
else{
    echo "<h1>User Info - ".$req_user."</h1>";
}

/* Display the user's info */
echo "<strong>Username: </strong>".$req_user_info['username']."<br>";
echo "<strong>First Name: </strong>".$req_user_info['firstname']."<br>";
echo "<strong>Last Name: </strong>".$req_user_info['lastname']."<br>";
echo "<strong>Email: </strong> ".$req_user_info['email'];

/**
 * Note: when you add your own fields to the users table to hold more information, like homepage, 
 * location, etc. they can be easily accessed by the user info array.
 *
 * $session->user_info['location']; (for logged in users)
 * $req_user_info['location']; (for any user)
 */

/* If logged in user viewing own account, give link to edit */
if(strcasecmp($session->username,$req_user) == 0){
   echo '<p><a href="useredit.php">Edit Account Information</a></p>';
}
?>
</div>

<div class="form-help">
<?php echo "<a href='index.php'>Back to Home Page</a>"; ?>
</div>

</body>
</html>