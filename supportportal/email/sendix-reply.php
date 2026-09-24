<?php  session_start(); ?> 
<?
$notes="Email Sent";
$username3="workingin";

$reciever=$_GET['reciever'];
$sender=$_GET['sender'];
$ApplyJob=$_GET['ApplyJob'];
$recievername=$_GET['recievername'];
$campid2=$_GET['campid2'];
$sender2=$_POST['sender2'];
$reciever2=$_POST['reciever2'];
$datetime2=$_POST['datetime2'];
$subject2=$_POST['subject2'];
$senderemail2=$_POST['senderemail2'];

$connect = new PDO("mysql:host=23.229.184.164;dbname=cec_lead_workingin", "cecworkingin", "Ali786!23");
$base_url = 'https://www.workingin-results.com/manage/email/'; //
$path = 'upload/' . $_FILES["resume"]["name"];
move_uploaded_file($_FILES["resume"]["tmp_name"], $path);
$message = '';
$name=$_GET['name'];

if(isset($_POST["send"]))
{
	
	require 'class/class.phpmailer.php';
	$mail = new PHPMailer;
	$mail->IsSMTP();
	$mail->Host = 'mail.workingin-results.com';
	$mail->Port = '26';
	$mail->SMTPAuth = true;
	$mail->Username = 'emails@workingin-results.com';
	$mail->Password = 'Workingin!23';
	$mail->SMTPSecure = '';
	//$mail->From = 'emails@workingin-results.com';
	$mail->From =$_POST['sender_email'];
	$mail->AddReplyTo($_POST['sender_email'], '');
	$mail->FromName = 'Working In';	
	$mail->AddAddress($_POST["receiver_email"]);
	$mail->WordWrap = 50;
	$mail->IsHTML(true);
	$mail->AddAttachment($path);					//Adds an attachment from a path on the filesystem
	$mail->Subject = $_POST['subject'];

	$track_code = md5(rand());

	$message_body = $_POST['message'];

	$message_body .= '<img src="'.$base_url.'email_track.php?code='.$track_code.'" width="1" height="1" />';
		$mail->Body = $message_body;

	if($mail->Send())
	{

		$data = array(
			':subject'			=>		$_POST["subject"],
			
			':message'				=>		$_POST["message"],
			':username'			=>		$_POST["receiver_email"],
			':senderid'			=>		$_POST["senderid"],
			':sender_email'			=>		$_POST["sender_email"],			
			':email_track_code'			=>		$track_code
		);
		$query = "
		INSERT INTO messagebox 
		(subject, message, username,senderid,sender_email, email_track_code) VALUES 
		(:subject, :message, :username, :senderid, :sender_email, :email_track_code)
		";

		$statement = $connect->prepare($query);
		if($statement->execute($data))
		{
			$messageR = '<label class="text-success"><h2>Email Sent Successfully</h2></label>';
				unlink($path);
				
				
		}
	}
	else
	{
		$messageR = '<label class="text-danger">Email Sent Successfully</label>';
	unlink($path);
	}

}

function fetch_email_track_data($connect)
{
	$query = "SELECT * FROM messagebox ORDER BY email_id";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<tr>
				<th width="25%">Email</th>
				<th width="45%">Subject</th>
				<th width="10%">Status</th>
				<th width="20%">Open Datetime</th>
			</tr>
	';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$status = '';
			if($row['email_status'] == 'yes')
			{
				$status = '<span class="label label-success">Open</span>';
			}
			else
			{
				$status = '<span class="label label-danger">Not Open</span>';
			}
			$output .= '
				<tr>
					<td>'.$row["username"].'</td>
					<td>'.$row["subject"].'</td>
					<td>'.$status.'</td>
					<td>'.$row["email_open_datetime"].'</td>
				</tr>
			';
		}
	}
	else
	{
		$output .= '
		<tr>
			<td colspan="4" align="center">No Email Send Data Found</td>
		</tr>
		';
	}
	$output .= '</table>';
	return $output;
}


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
			<form method="post" enctype="multipart/form-data" >
				<div class="form-group">					
					<b>EMAIL SUBJECT :</b><input type="text" value="Re: <?echo $subject2;?> - <?echo $campid;?>" name="subject" class="form-control" required />
				</div>
				
				<div class="form-group">
					<b>RECEIVER EMAIL :</b><input type="email" name="receiver_email" value="<?echo $reciever2;?>" class="form-control" required />
				</div>
				<div class="form-group">					
					<b>SENDER NAME :</b>
					<select id="sender_email" name="sender_email" class="form-control" required>
					 <option value="">Select Sender</option>
  <option value="jane.hawkes@workingin.com">Jane Hawkes</option>
  <option value="Suzanne.Fay@workingin.com">Suzanne Fay</option>
  <option value="emma.tilsley@workingin.com">Emma Tilsley</option>
  <option value="help@workingin.com">Working In</option>
</select>
					
					<input type="hidden" value="<?echo $sender2;?>" name="senderid">
				</div>
						<div class="form-group">
									<label>Attach a File</label>
									<input type="file" name="resume" accept=".doc,.docx, .pdf" />
								</div>
				
				<div class="form-group">
							<textarea name="message" required rows="4" class="form-control">
					  <center><br><br><br><hr></center>
      <br>From: < <?echo $senderemail2;?> ></br> 
Sent: <?echo $datetime2;?><br>
To: < <?echo $reciever2;?> ><br>
Subject: <?echo $subject2;?><br>

	  <?echo $_POST['message2'];?>
      
					</textarea>
				</div>
				<div class="form-group">
					<input type="submit" name="send" style="cursor:pointer;padding:5px;border:0px;background-color: #3a9135;color:#fff;" value="Send Email" /> <button style="cursor:pointer;padding:5px;border:0px;background-color: #f44336;color:#fff;" onclick="self.close()">Close this window</button>
				</div>
			</form>
			 <script>
                        CKEDITOR.replace( 'message' );
                </script>
			<br />
			
			<?php 
			
		//	echo fetch_email_track_data($connect);

			?>
		</div>
		<br />
		<br />
	</body>
</html>