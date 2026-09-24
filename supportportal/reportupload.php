<?php

$servername = 'localhost';
$username = 'conzvisa_YVPdbuserWOF';
$password = 'YVMJAT@#\$#AYWinP';
$dbname = 'conzvisa_YVPDBpathWOF';


if(isset($_POST['submit'])){
$user_id=$_POST['user_id'];

  $total = count($_FILES['files']['tmp_name']);
  for($i=0;$i<$total;$i++){
    $fileName = $_FILES['files']['name'][$i];
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $filenameW = array_pop(array_reverse(explode(".", $fileName)));
$time = strtotime('today');
$mycode = str_shuffle($time);

    $newFileName =$filenameW."_".$mycode;
    $finalfilename=$newFileName.'.'.$ext;
    $fileDest = 'cvresumes/'.$newFileName.'.'.$ext;
    if($ext === 'pdf' || 'doc' || 'docx' || 'jpeg' || 'JPG'){
        move_uploaded_file($_FILES['files']['tmp_name'][$i], $fileDest);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE users SET cvfile='$finalfilename' WHERE user_id='$user_id'";
if ($conn->query($sql) === TRUE) {
  echo "<span class='textclass'><center><br><br><h3>CV has been uploaded</h3> </center></span>";
    ?>
    <script type="text/javascript">
alert("CV has been uploaded");
window.location.href = "main.php";
</script>
    
    
  <?


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
    
</style>
        <?
        
    }else{
      echo 'Pdfs and jpegs only please';
    }
  }
}

 ?>



 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>

    <center> <h3>Upload CV/Resume File</h3><form class="" action="reportupload.php" method="post" enctype="multipart/form-data">
       <input required style="padding: 8px;border: 1px solid;color: #000;width: 245px;border: 2px solid #6c3;font-weight: bold;text-transform: uppercase;" type="file" name="files[]" multiple>
       <input type="hidden" name="user_id" value="<?echo $_GET['user_id'];?>"><br><br>
       <button style="cursor:pointer;padding: 8px;border: 1px solid;background: #6c3;color: #fff;width: 245px;border: 2px solid #000;font-weight: bold;text-transform: uppercase;" type="submit" name="submit">Upload</button>
     
     </form></center>
     


   </body>
 </html>