<?php 
include("includes/controller.php");
$pagename = 'summary';
$container = '';
if(!$session->isAdmin() || !isset($_SESSION['regsuccess'])){
    header("Location: ".$configs->homePage());
    exit;
}
else{
$form = new Form();
?>
<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="fonts/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">

        <link href="css/navigation.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">      
        
    </head>
    <body>
        <!-- Page Wrapper -->
        <div id="page-wrapper">

            <!-- Side Menu -->
            <nav id="side-menu" class="navbar-default navbar-static-side" role="navigation">
                <div id="sidebar-collapse">
               
                    <?php include('navigation.php'); ?>
                </div>
            </nav>
            <!-- END Side Menu -->

            <?php include('top-navbar.php'); ?>     

            <!-- Page Content -->
            <div id="page-content" class="gray-bg">

                <!-- Title Header -->
                <div class="title-header white-bg">
                    <i class="fas fa-star"></i>
                    <h2>Summary</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li class="active">
                            Summary
                        </li>
                    </ol>
                </div>
                <!-- END Title Header -->
             
                <div class="row">
                    <div class="col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
                        <div class="panel">

                            <div class="panel-body">
                                <?php
                                /* Registration Successful */
                                if($_SESSION['regsuccess']==0 || $_SESSION['regsuccess'] == 5){
                                    echo "<div class='login'><h1>Registered!</h1>";
                                    echo "<p>Thank you Admin, <strong>".$_SESSION['reguname']."</strong> has been added to the database.</p></div>";
              
                  $usera=$_SESSION['reguname'];
$servername = "localhost";
$username = "workingi_supportDBuser";
$password = "SyTPQ4adjz!^";
$dbname = "workingi_supportalDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users Where username='$usera'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
   $userid= $row["id"];
   $groupid= $row["groupid"];
  }
} else {
  echo "0 results";
}

$sql = "INSERT INTO users_groups (user_id,group_id)
VALUES ('$userid', '$groupid')";

if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id;
  echo "New record created successfully. Last inserted ID is: " . $last_id;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}



$conn->close();
                                    
                                    
                                }
                                /* Registration failed */
                                else if ($_SESSION['regsuccess'] == 2) {
                                    echo "<div class='login'><h1>Registration Failed</h1>";
                                    echo "<p>We're sorry, but an error has occurred and your registration for the username <strong>".$_SESSION['reguname']."</strong>"
                                    . " could not be completed.<br><br>Please try again.</p>";
                                    echo "<p>".Form::$num_errors." error(s) found</p>";
                                    foreach (Form::getErrorArray() as $key => $value) {
                                        echo "<p> * ".$value."</p>";
                                    }
                                    echo "</div>";
                                }
                                unset($_SESSION['regsuccess']);
                                unset($_SESSION['reguname']);
                                ?>              
                            </div>

                        </div>
                    </div>
                </div>

               

            </div>
            <!-- END Page Content -->

            <?php include('rightsidebar.php'); ?>

        </div>
        <!-- END Page Wrapper -->
        
        <!-- Scroll to top -->
        <a href="#" id="to-top" class="to-top"><i class="fas fa-angle-double-up"></i></a>

        <!-- JavaScript Resources -->
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/xavier.js"></script>

    </body>
</html>
<?php
}
?>