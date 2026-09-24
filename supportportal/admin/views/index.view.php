<?php
$servername = "localhost";
$username = "conzvisa_YVPdbuserWOF";
$password = "YVMJAT@#\$#AYWinP";
$dbname = "conzvisa_YVPDBpathWOF";
$statusrp=$_GET['statusrp'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($statusrp=="100")
{
$sql = "SELECT * FROM users WHERE user_form_status='100%'";
$pagetitle="All 100% Completed Forms";
}
else
{
$sql = "SELECT * FROM users WHERE user_form_status!='100%'";  
$pagetitle="All Incomplete Forms";
}
$result = $conn->query($sql);


?> 
					


<!DOCTYPE html>
<html lang="en">
<head>
    <script language="JavaScript" type="text/javascript">
<!--
function openPop(){
	var Sel_Ind = document.getElementById('myURLs').selectedIndex;
	var popUrl = document.getElementById('myURLs').options[Sel_Ind].value;
	winpops=window.open(popUrl,"","width=400,height=338,resizable,")
}
//-->
</script>
    <title>View MVPs</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>

    
    <style> #thead>tr>th{ color: white; } </style>
    <style>
    .btn-success {
    color: #fff;
    background-color: #6c3;
    border-color: #6c3;
}

.selectBox{
 color:White;
}
.optionBox{
  color:black;
}

</style>

</head>
<body>
    
<div class="container" style="width:100% !important;max-width:100% !important;">
    <center><h3><?echo $pagetitle;?></h3></center>
    <table id="exampleTable" class="table table-striped table-bordered" style="width: 100%">
        <thead id="thead">
        <tr style="background-color: #6c3;">
            <th>ID</th>
                        	<th><a href="#" style="color:#fff;">Name/Email</a></th>
							<th>Form Status</th>
							<th>Form Submitted</th>
							<th>Referred by:</th>
							<th>View Form</th>
								<th>Assigned To</th>
							<th>Report</th>
							<th>Upload Report</th>
 
        </tr>
        </thead>
        <tbody>
       	<?
				if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $lia_sql = "SELECT * FROM lia_agents ORDER by lia_name ASC";  
$result_lia = $conn->query($lia_sql);
  $report_file=$row["report_file"];
  
      $ref_sql = "SELECT * FROM refferedby ORDER by lia_name ASC";  
$result_ref = $conn->query($ref_sql);
  
  
  
				?>
        <tr><td><?echo $row["user_id"];?></td>
            <td><?echo $row["user_first_name"];?>&nbsp;<?echo $row["user_last_name"];?><br><a href="mailto:<?echo $row["user_email"];?>"><?echo $row["user_email"];?></a></td>
                <td><?echo $row["user_form_status"];?></td>
							<td><?echo $row["user_created"];?></td>
							<td><?echo $row["referby"];?>
							
							<?if ($row["referby"]=="")
{

?>
							<form name="referby" action="ref_update.php" method="post">
							    <input type="hidden" name="user_id" value="<?echo $row['user_id'];?>">
							      <input type="hidden" name="pagetype" value="<?echo $statusrp;?>">
							    <select id="myURLs" name="referby" >
    <option value="">Set</option>
<option value="Anita">Anita</option>
<option value="Aman Jaspal">Aman Jaspal</option>
<option value="Candy Leung">Candy Leung</option>
<option value="Dada">Dada Li</option>
<option value="Darrell Enright">Darrell Enright</option>
<option value="Hamneet Jaggi">Hamneet Jaggi</option>
<option value="Mavis Benedicto">Mavis Benedicto</option>
<option value="Monique Power">Monique Power</option>
<option value="Petra Lipoth">Petra Lipoth</option>
<option value="Paul Goddard">Paul Goddard</option>
<option value="Sameena Jaspal">Sameena Jaspal</option>
<option value="Simon">Simon</option>
<option value="Sarah Allen">Sarah Allen</option>
<option value="Sophie Sun">Sophie Sun</option>
<option value="Witthawat Chalanant">Witthawat Chalanant</option>
</select><input type="submit" value="Set">
							    
							</form><?}?>
							</td>
						
							<td>
							    
<a href="<?=href('admin/view_data.php?f='.$row['user_id'], false)?>" onclick="javascript:void window.open('<?=href('admin/view_data.php?f='.$row['user_id'], false)?>','1638669608835','width=950px,height=750,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" class="btn btn-success btn-sm">View Form</button></td>
<td>
    <?if ($statusrp=="100")
{

?>
    <form action="lia_update.php" method="get" onsubmit="target_popup(this)" >
<select id="myURLs" name="agent_id" style="width:200px;" >
    <option value="">Select an LIA</option>
<?	if ($result_lia->num_rows > 0) {
  // output data of each row
  while($row_lia = $result_lia->fetch_assoc()) {
      
  if ($row_lia["id"]==$row["assigned_agent"])
  {
      $selected="selected";
     $assignedto="Assigned: ";
  }
  else
  {
     $selected=""; 
     $assignedto="";
  }
  ?>
<option <?echo $selected;?> value="<?echo $row_lia["id"];?>"><?echo $assignedto;?><?echo $row_lia["lia_name"];?></option>
<? 
} 
}
?>
</select>
<input type="hidden" name="user_id" value="<?echo $row["user_id"];?>">
<input type="submit" value="Assign">
</form></td>
<td>
    <?
if ($report_file=="")
{

}
else
{
?>							    
<center><a href="../<?echo $report_file;?>" target="_blank"><img style="width: 35px;" src="/mvp/down.png"></a></center>							    <?}?>
    
</td>
<td>
<?
if ($report_file=="")
{

}
else
{
?>							    
		    <?}?>
<a style="padding: 5px;border: 1px solid;background: #6c3;color: #fff;width:50%;" href="#" onclick="window.open('/mvp/reportupload.php?user_id=<?echo $row["user_id"];?>','Popup','width=500,height=300,toolbar=no,menubar=no,location=no,status=no,scrollbars=no,resizable=no,left=0,top=0');return false;">Upload</a></td>
         
       <?}
       
       else
       {
       ?><td></td><?    
       }
       
       ?>
       </tr>
        	<? }
} else {
  echo "0 results";
}
$conn->close();?>
        </tbody>

    </table>
</div>
<script>
function goclicky(meh)
{
    var x = screen.width/2 - 700/2;
    var y = screen.height/2 - 450/2;
    window.open(meh.href, 'sharegplus','height=485,width=700,left='+x+',top='+y);
}
function target_popup(form) {
    window.open('', 'Popup', 'width=400,height=150,resizeable,scrollbars');
    form.target = 'Popup';
}
$(document).ready(function () {
    $('#exampleTable').dataTable({
        "sPaginationType": "full_numbers",
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "oLanguage": {
            "sLengthMenu": "Show _MENU_"
        }
    });
});
</script>		

	
	</div>
	</div>
</div>
</body>
</html>