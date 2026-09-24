 <?php
 require '../class/class.phpmailer.php';
$mail = new PHPMailer;


session_start();
$servername = "localhost";
$username = "conzvisa_wof";
$password = "Wof@@11@@11";
$dbname = "conzvisa_wof";
$user_id=$_GET['user_id'];
$agent_id=$_GET['agent_id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

    $lia_sql = "SELECT * FROM lia_agents WHERE id='$agent_id'";  
$result_lia = $conn->query($lia_sql);
 	if ($result_lia->num_rows > 0) {
  // output data of each row
  while($row_lia = $result_lia->fetch_assoc()) {
      $lia_name=$row_lia["lia_name"];
      $lia_email=$row_lia["lia_email"];
      
  }
 	}


$sql = "UPDATE users SET assigned_agent ='$agent_id', assigned_agent_name='$lia_name' WHERE user_id='$user_id'";
if ($conn->query($sql) === TRUE) {
  echo "<span class='textclass'><center><br><br><h3>LIA Agent has been assigned</h3> </center></span>";
  //echo $lia_email;
  ?>
  <?

$first_name = $lia_name;
$email = $lia_email;


//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP

$mail->Host = 'send.smtp.com';
	$mail->Port = '2525';
	$mail->SMTPAuth = true;
	$mail->Username = 'newzealanddotcomadmin';
	$mail->Password = '5%6$98HBggft%2@';
	$mail->SMTPSecure = '';
	$mail->From = 'info@myvisapath.co.nz';
	
$mail->FromName = 'MyVisaPath';
$mail->addAddress($email, $first_name);     // Add a recipient



	
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'You have been assigned a New MVP';

//messagebodystart
$mail->Body = '<html><body>
<table style="max-width:600px; font-family: "Open Sans", sans-serif;"><tr><td>
<p>Dear ' . $first_name . ',</p>
<p>You have been assigned a new MVP form to review and create MVP report.</p>
<p>Your personal Licensed Immigration Adviser is ready and waiting to receive all your information.</p>
<p>Simply <a href="https://www.myvisapath.co.nz/mvp/admin">click here</a> to login and view the <b>MyVisaPath</b> form.</p>

</td></tr></table></body></html>
'; 
//messagebodyend.



if(!$mail->send()) {
/*
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
*/
} else {
/*    
    echo 'Message has been sent';
*/
}


?>
  <?
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?> 

<style>
    .textclass
    {
        font-family:arial;
        
    }
    
</style>   <script type="text/javascript">
        function RefreshParent() {
            if (window.opener != null && !window.opener.closed) {
                window.opener.location.reload();
            }
        }
        window.onbeforeunload = RefreshParent;
    </script>
