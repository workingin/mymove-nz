<?php

//email_track.php


if(isset($_GET["code"]))
{

$servername = "23.229.184.164";
$username = "cecworkingin";
$password = "Ali786!23";
$dbname = "cec_lead_workingin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE messagebox SET email_status='yes', email_open_datetime = '".date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')))."' WHERE email_track_code = '".$_GET["code"]."' ";

if ($conn->query($sql) === TRUE) {
   // echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
}

?>

<?php

?>