 <?php
$servername = "localhost";
$username = "conzvisa_wof";
$password = "Wof@@11@@11";
$dbname = "conzvisa_wof";

$mvpamount=$_POST['mvpamount'];
$currency_symbol=$_POST['currency_symbol'];
$cid=$_POST['cid'];
$updateq=$_POST['updateq'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($updateq=="1")
{
$sql = "UPDATE countprice SET currency_symbol='$currency_symbol',mvpamount=$mvpamount WHERE cid=$cid";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}
}
else
{
}
?>
<html lang="en-US" class="wf-loading">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>Countries</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>

    <link   rel="icon" href="" type="image/x-icon">
    <style> #thead>tr>th{ color: white; } </style>
</head>
<body><div class="container">
    <table id="exampleTable" class="table table-striped table-bordered" style="width: 70%">
        <thead id="thead">
        <tr style="background-color: #6c3">
            <th>Country</th>
            
            <th>MVP Custom Amount </th>
            <th>Currency Symbol </th>
            <th>Update</th>
            
        </tr>
        </thead>
        <tbody>
<?




$sql = "SELECT * FROM countprice WHERE mvpamount IS NOT NULL ORDER BY mvpamount DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
   ?>


        <tr>
            <form name="form<? echo $row["country_iso"];?>" action="countprice.php" method="post">
                <td><?echo $row["country_name"];?></td>


            
            <td><input type="text" name="mvpamount" value="<?echo $row["mvpamount"];?>"></td>
            <td><input type="text" name="currency_symbol" value="<?echo $row["currency_symbol"];?>"></td>
              <input type="hidden" name="cid" value="<?echo $row["cid"];?>">
            <input type="hidden" name="updateq" value="1">
            
            <td><input type="Submit" value="Update"></td></form>
          
            
        </tr>
  
       
   
   <?
   
  }
} else {
  echo "0 results";
}
$conn->close();
?>  

</tbody>
    </table>
</div>
<script>
 $(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 1, "desc" ]]
    } );
} );
</script>
</body>
</html>
    