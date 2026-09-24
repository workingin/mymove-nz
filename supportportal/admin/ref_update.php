 <?php
$servername = "localhost";
$username = "conzvisa_wof";
$password = "Wof@@11@@11";
$dbname = "conzvisa_wof";
$user_id=$_POST['user_id'];
$referby=$_POST['referby'];
$pagetype=$_POST['pagetype'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "UPDATE users SET referby ='$referby' WHERE user_id='$user_id'";
if ($conn->query($sql) === TRUE) {
  echo "<span class='textclass'><center><br><br><h3>Referral has been set</h3> </center></span><br>";
  ?><center><a href="https://myvisapath.co.nz/mvp/admin/index.php?statusrp=<?echo $pagetype;?>">Click here to go back</a></center><?
  move('https://myvisapath.co.nz/mvp/admin/index.php?statusrp?statusrp='.$pagetype);
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
