
 <?
 echo "11111111111";
$servername = "localhost";
$usernameDB = "conzvisa_myvisauser";
$passwordDB = "6hqQ$~kHoIXU";
$dbname = "conzvisa_myvisapathCRM";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tblfiles";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["file_name"]. " " . $row["file_name"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?> 
<form method="post" action="">
    <span>What are your favourite colours?</span><br/>
    <input type="checkbox" name='colour[]' value="https://myvisapath.co.nz/manage/uploads/leads/26/testcv_pdf.pdf"> Red <br/>
    <input type="checkbox" name='colour[]' value="https://myvisapath.co.nz/manage/uploads/leads/26/testcv_pdf.pdf"> Green <br/>
    <input type="checkbox" name='colour[]' value="reports/f28ae24cf180bf0500aecd94072a3f67.pdf"> Blue <br/>
    <input type="checkbox" name='colour[]' value="reports/b75e303ae203e140a5d778143d254e9c.docx"> Black <br/>
	<br/>
    <input type="submit" value="Submit" name="submit">
</form>

<?php
$servername = "localhost";
$usernameDB = "conzvisa_myvisauser";
$passwordDB = "6hqQ$~kHoIXU";
$dbname = "conzvisa_myvisapathCRM";

$connD = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
// Check connection
if ($connD->connect_error) {
  die("Connection failed: " . $connD->connect_error);
}


$sqlF = "SELECT * FROM tblfiles ";
$connD->query($sqlF);

if ($resultF->num_rows > 0) {
  // output data of each row
  while($row = $resultF->fetch_assoc()) {
   
   ?>
     <input type="checkbox" name='colour[]' value="../reports/<?echo $userid;?>/<?echo $row["file_name"];?>"><a target="_blank" href="../reports/<?echo $userid;?>/<?echo $row["file_name"];?>"> <?echo $row["file_name"];?></a> <br/>

   <?
  }
  ?>
  <input type="checkbox" name='colour[]' value="../reports/MVisareport.pdf"><a target="_blank" href="../reports/MVisareport.pdf"> NZ Guide (MVisareport.pdf)</a> <br/><br>

  <?
} else {
  echo "0 results";
}
$connD->close();



if(isset($_POST['submit'])){



	require 'class/class.phpmailer.php';
$mail = new PHPMailer;


session_start();
$first_name = "Mehboob";
$email = "mehboob@dataintel.co.nz";
$jobname = $_SESSION['thanksrole'];

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
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('domains@workingin.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');


	
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters

if(!empty($_POST['colour'])) {

        foreach($_POST['colour'] as $value){
            $mail->addAttachment($value);         // Add attachments

        }

    }



$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Thank you for your job application';
$mail->AltBody = 'Thank you for your application ' . $first_name . '. You have successfully applied for the position of ' . $jobname . '. Our team will review your application and get back to you shortly.';
//messagebodystart
$mail->Body = '<html><body>
<table style="max-width:600px; font-family: "Open Sans", sans-serif;"><tr><td>
<img src="https://www.myvisapath.co.nz/mvp/emailheader.jpg" />
<h3>Your <b>MyVisaPath</b> account is ready to go when you are!</h3>
<p>Congratulations on taking the first step on your journey to beautiful New Zealand. We are so pleased that you are considering joining us in our little patch of paradise.</p>
<p>Your personal Licensed Immigration Adviser is ready and waiting to receive all your information.</p>
<p>Once you have completed <b>MyVisaPath</b>, they will be in touch with your next steps, including a face-to-face online meeting to assess your best possible path to New Zealand.</p>
<p>Your  id is: ' . $email . '.</p>
<p>Your Password: ' . $password . '.</p>
<p>Simply <a href="https://www.myvisapath.co.nz/mvp/">click here</a> to login and start the <b>MyVisaPath</b> process</p>
<p>We look forward to meeting you online soon and working with you to achieve your dream life in New Zealand.</p>
<p><em>The team at Working In Visas | <a href="https://workingin-newzealand.com/" target="_blank">workingin-newzealand.com</a></em></p>
</td></tr></table></body></html>
'; 
//messagebodyend.



if(!$mail->send()) {

    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;

} else {
 
    echo 'Message has been sent';

}
}


?>