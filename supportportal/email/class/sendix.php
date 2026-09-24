<?php  session_start(); ?> 
<?
$userid=$_SESSION['username'];
$reciever=$_GET['reciever'];
$sender=$_GET['sender'];
$ApplyJob=$_GET['ApplyJob'];
$recievername=$_GET['recievername'];


$connect = new PDO("mysql:host=23.229.249.38;dbname=cec_lead_workingin", "cecworkingin", "Ali786!23");
$base_url = 'https://www.workingin-results.com/manage/email/'; //

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
	$mail->Password = 'Ali786!23';
	$mail->SMTPSecure = '';
	$mail->From = 'emails@workingin-results.com';
	$mail->AddReplyTo($_POST['senderid'], '');
	$mail->FromName = 'Working in New Zealand';	
	$mail->AddAddress($_POST["receiver_email"]);
	$mail->WordWrap = 50;
	$mail->IsHTML(true);
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
			':email_track_code'			=>		$track_code
		);
		$query = "
		INSERT INTO messagebox 
		(subject, message, username,senderid, email_track_code) VALUES 
		(:subject, :message, :username, :senderid, :email_track_code)
		";

		$statement = $connect->prepare($query);
		if($statement->execute($data))
		{
			$messageR = '<label class="text-success">Email Send Successfully</label>';
		}
	}
	else
	{
		$messageR = '<label class="text-danger">Email Send Successfully</label>';
	
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
		<?php
			
			echo $messageR;

			?>
			<form method="post">
				<div class="form-group">					
					<b>EAMIL SUBJECT:</b><input type="text" value="<?echo $ApplyJob;?>" name="subject" class="form-control" required />
				</div>
				
				<div class="form-group">
					<b>RECEIVER SUBJECT:</b><input type="email" name="receiver_email" value="<?echo $reciever;?>" class="form-control" required />
				</div>
				<div class="form-group">					
					SENDER EMAIL:<input type="email" name="senderid" class="form-control" required />
				</div>
				
				<div class="form-group">
							<textarea name="message" required rows="5" class="form-control">
					  <center><img style="width:200px;" src="https://www.workingin-results.com/manage/assets/images/logo.png"></center>
      Dear <?echo $recievername;?>
      
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