<?php


$winz110="$2y$10$SfZSai9CE5Frbfg2Ak3TRex1yRwpF73i4g8LlPlBZ0ASUowvw97P6";


$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$email	= $_POST['email'];
$contact= $winz110;

$servername = "localhost";
$username = "conzvisa_portalUser";
$password = "YVMJAT@#\$#AYWinP";
$dbname = "conzvisa_epsPortal110";

// Create connection
$conn = new mysqli($servername, $username, 'YVMJAT@#\$#AYWinP', $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO users (user_first_name, user_last_name, user_email)
VALUES ('$f_name', '$l_name', '$email')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  
  ?>
  <meta http-equiv="refresh" content="0; url=users_portal.php?useradded=1">
  <?
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>
