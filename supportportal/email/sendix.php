<?
$notes="Email Sent";
$username3="workingin";
$userid=$_GET['userid'];
$emailidd=$_GET['emailidd'];
$staffid=$_GET['staffid'];

$useremail=['useremail'];

$reciever=$_GET['email'];
$sender=$_GET['sender'];
$ApplyJob=$_GET['ApplyJob'];
$recievername=$_GET['recievername'];
$campid=$_GET['campid'];
$staffcontacts=$_POST['staffcontacts'];
$dealidR=$_POST['dealid'];

$servername = "localhost";
$usernameDB = "conzvisa_yourvisauser";
$passwordDB = "6hqQ$~kHoIXU";
$dbname = "conzvisa_yourvisapathCRM";




$url = 'https://workingin91596.api-us1.com';
$params = array(
'api_key' => '9229acccf9ff43180e40f8dba16af88f693dcb9fbe885b43eb80ec690d1c4bad9d83ff2d',
'api_action' => 'deal_list',
'api_output' => 'json',
'filters[email]' =>$reciever ,
'full' => 1,
);
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');
$url = rtrim($url, '/ ');
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}
$result = json_decode($response, true);
//echo $result['deals']['0']['id'];

$dealid=$result['deals']['0']['id'];

$dateadded= date('Y-m-d H:i:s');
$name=$_GET['name'];

// Create connection
$connD = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
// Check connection
if ($connD->connect_error) {
  die("Connection failed: " . $connD->connect_error);
}





$base_url = 'https://www.workingin-results.com/manage/email/'; //
$path = 'upload/' . $_FILES["resume"]["name"];

$message = '';
$name=$_GET['name'];
if(isset($_POST["send"]))
{
	
	require 'class/class.phpmailer.php';
	$mail = new PHPMailer;
	$mail->Host = 'send.smtp.com';
	$mail->Port = '2525';
	$mail->SMTPAuth = true;
	$mail->Username = 'myvisapathadmin';
	$mail->Password = 'MyVisapath786!23';
	$mail->SMTPSecure = '';
	$mail->From = 'info@myvisapath.co.nz';
	$mail->AddReplyTo($_POST['sender_email'], '');
	$mail->FromName = 'MyVisaPath';	

       

	$mail->WordWrap = 50;
	$mail->IsHTML(true);
	
	if(!empty($_POST['colour'])) {

        foreach($_POST['colour'] as $value){
            $mail->addAttachment($value);         // Add attachments
          
        }

    }
	
	$mail->Subject = $_POST['subject'];

	$track_code = md5(rand());

	$message_body = $_POST['message'];

	$message_body .= '<img src="'.$base_url.'email_track.php?code='.$track_code.'" width="1" height="1" />';
		$mail->Body = $message_body;


      foreach($_POST['staffcontacts'] as $value){
            	$mail->AddAddress($value);
            	  $entry .= $value.",";
        }
$emailsentto=$entry;
//echo $emailsentto;

	if($mail->Send())
	{
			$subject=$_POST["subject"];
			
			$message=$_POST["message"];
			$username=$_POST["receiver_email"];
			$senderid=$_POST["senderid"];
			$sender_email=$_POST["sender_email"];			
		$messagenote="To: ".$emailsentto."<br>";
		$messagenote=$messagenote."".$message."";
		
$sql = "INSERT INTO messagebox (subject, message, username,senderid,sender_email, email_track_code,datetime,crmid)
VALUES ('$subject', '$message', '$emailsentto','$senderid','$sender_email','$email_track_code','$dateadded','$userid') ";


if ($connD->query($sql) === TRUE) {
   $last_id = $connD->insert_id;

///AC
$params = array(
'api_key' => '9229acccf9ff43180e40f8dba16af88f693dcb9fbe885b43eb80ec690d1c4bad9d83ff2d',
    'api_action'   => 'deal_note_add',
    'api_output'   => 'json'
);

$post = array(
    'note'    => $messagenote,
    'dealid'         => $dealidR,
    
);


$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

$data = "";
foreach( $post as $key => $value ) $data .= urlencode($key) . '=' . urlencode($value) . '&';
$data = rtrim($data, '& ');

// clean up the url
$url = rtrim($url, '/ ');
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl post and store results in $response

curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}
$result = json_decode($response, true);




} else {
  echo "Error: " . $sql . "<br>" . $connD->error;
}


} else {
            $errors[] = "Unable to create account";
        }

    


		
	
			$messageR = '<label class="text-success"><h2>Email Sent Successfully</h2></label>';
			$formdisplay="none";
			
				unlink($path);

}

echo $errors;

?>
<!DOCTYPE html>
<html>
	<head>
		
		<script src="jquery.min.js"></script>
		<link rel="stylesheet" href="bootstrap.min.css" />
		<script src="bootstrap.min.js"></script>
		      <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
		<center><?php
			
			echo $messageR;

			?></center> 

			<form method="post" enctype="multipart/form-data" style="display:<?echo $formdisplay;?> !important;">
				
				<?
if ($useremail=="1")
{
?>
					
					<b>EMAIL SUBJECT :</b><input type="text" value="Your MyVisaPath report is ready to view" name="subject" class="form-control" required />
		
<?}

else
{
?>

				
					<b>EMAIL SUBJECT :</b><input type="text" value="Your Client: <?echo $name;?> report is ready " name="subject" class="form-control" required />
				
<?}?>
				
					<b>RECEIVER EMAIL :</b><input type="email" name="staffcontacts[]" value="<?echo $reciever;?>" class="form-control" />
				
		
					<input type="hidden" value="info@myvisapath.co.nz" name="sender_email">
				    <input type="hidden" value="<?echo $dealid;?>" name="dealid">
				
			
<div style="width:100%;float:left;">
				<br><b>OR Choose Contacts Below:</b><br>

					<?
						    
$sqlST = "SELECT * FROM tblstaff  ";
$resultST = $connD->query($sqlST);

if ($resultST->num_rows > 0) {
  // output data of each row
  while($rowST = $resultST->fetch_assoc()) {
   ?>
<div style="width:23%;float:left;"><input type="checkbox" name='staffcontacts[]' value="<?echo $rowST["email"];?>">&nbsp;<?echo $rowST["firstname"];?> <?echo $rowST["lastname"];?></div>     

   <?
  }

} else {
  echo "0 results";
}

?>

</div>
<table style="width:100%;">
    <tr><td style="padding-top:10px;"><label>Attach a File/Report</label><br></td></tr>

			<br>

<?
$sqlF = "SELECT * FROM tblfiles WHERE rel_id='$userid' ";
$resultF=$connD->query($sqlF);

if ($resultF->num_rows > 0) {
  
  while($rowF = $resultF->fetch_assoc()) {
   
   ?>

<tr><td><input type="checkbox" name='colour[]' value="../reports/<?echo $userid;?>/<?echo $rowF["file_name"];?>"><a target="_blank" href="../reports/<?echo $userid;?>/<?echo $rowF["file_name"];?>"> <?echo $rowF["file_name"];?></a> <br/>
</td></tr>

   <?
  }
  ?>
  
<tr><td><input type="checkbox" name='colour[]' value="../reports/MVisareport.pdf"><a target="_blank" href="../reports/MVisareport.pdf"> NZ Guide (MVisareport.pdf)</a> <br/><br></td></tr>
  <?
} else {
  echo "0 results";
}

?>
</table>									
								
<?
$sqlSTA = "SELECT * FROM tblstaff WHERE staffid='$staffid'  ";
$resultSTA = $connD->query($sqlSTA);

if ($resultSTA->num_rows > 0) {
  // output data of each row
  while($rowSTA = $resultSTA->fetch_assoc()) {

$email_signature=$rowSTA["email_signature"];
  }

} else {
  echo "0 results";
}
$connD->close();

?>				

<textarea name="message" required rows="4" class="form-control">


<p>Hi <?echo $name;?> </p>

	You can also download/view the report in your MyVisaPath dashboard.<br><br>
	The Team at MyVisaPath
<?echo $email_signature;?>

      
</textarea>
		
	<br>
					<input type="submit" name="send" style="cursor:pointer;padding:5px;border:0px;background-color: #3a9135;color:#fff;" value="Send Email" /> <button style="cursor:pointer;padding:5px;border:0px;background-color: #f44336;color:#fff;" onclick="self.close()">Close this window</button>
		
			</form>
			 <script>
                        CKEDITOR.replace( 'message' );
                </script>
			<br />
			
		
		</div>
		<br />
		<br />
	</body>
</html>