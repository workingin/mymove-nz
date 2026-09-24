<?php 
include("includes/controller.php");
$pagename = 'filesreport';

$container = '';
if(!$session->isAdmin()){
    header("Location: ".$configs->homePage());
    exit;
}
else{
?>
<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="fonts/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">

        <link href="css/navigation.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        
        <!-- Datatables CSS -->
        <link href="css/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet"> 
        
    </head>
    <body>
        <!-- Page Wrapper -->
        <div id="page-wrapper">

            <!-- Side Menu -->
            <nav id="side-menu" class="navbar-default navbar-static-side" role="navigation">
                <div id="sidebar-collapse">
             
                    <?php include('navigation.php'); ?>
                </div>
            </nav>
            <!-- END Side Menu -->

            <?php include('top-navbar.php'); ?>        

            <!-- Page Content -->
            <div id="page-content" class="gray-bg">

                <!-- Title Header -->
                <div class="title-header white-bg">
                    <i class="fas fa-chart-bar"></i>
                    <h2>Uploaded Files </h2> 
                    <ol class="breadcrumb">
                        <li>
                            <!-- style="color: #fff;font-weight: bold;background: #003e7e;padding: 11px;" -->
                            <a class="btn btn-main" href="/admin/files_report.php?uploadnow=upload#uploadnow">Upload a new File</a>
                        </li>
                      
                    </ol>
                   
                </div>
                <!-- END Title Header -->
             
                <div class="row">                                     
                    <div class="col-md-12 col-lg-12">
                        <div class="panel">
                         
                            <div class="panel-body table-responsive">


             
             <table style="width:100%;" class="table table-striped table-bordered table-hover" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>File Name</th>
                                                
                                                <th>Date / Time</th>
                                                <th>Action</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $usergr= $session->username;
                                           
                                            $sqlgr = "SELECT * FROM users WHERE username='$usergr' ";
                                            $resultgr = $db->prepare($sqlgr);
                                            $resultgr->execute();
                                            while ($rowgr = $resultgr->fetch()) {
                                                
                                                $groupid = $rowgr['groupid'];

                                              
                                       
                                                echo "</tr>";
                                            }
                                           
                                        
                                            $sql = "SELECT * FROM uploadedfiles WHERE user_id='$groupid' ";
                                            $result = $db->prepare($sql);
                                            $result->execute();
                                            while ($row = $result->fetch()) {
                                                
                                           ?><tr>
                                           
                                           <td><a href="upload/uploads/<?echo $filename = $row['filename']; ?>" target='_blank'><?echo $row['file_title']; ?></a></td>
                                           <td><?echo $filecategory=$row['datetime'];?></td>
                                           <td>
                                               <form method="post" action="upload/deletefile.php" style="display:inline;" onsubmit="return confirm('Delete this file?');">
                                                   <?php echo Csrf::field(); ?>
                                                   <input type="hidden" name="id" value="<?php echo (int) $row['id']; ?>">
                                                   <input type="hidden" name="filename" value="<?php echo htmlspecialchars($row['filename'], ENT_QUOTES, 'UTF-8'); ?>">
                                                   <button type="submit" class="btn btn-danger" style="border:none;"><i class="fas fa-times"></i></button>
                                               </form>
                                           </td>
                                           <?    
                                                
                                                
                                         
                                              
                                          
                                                
                                            }
                                            
                                            ?></tr>
                                        </tbody>
                                </table>
                            </div>
                            <?php if(isset($_GET['uploadnow'])=="upload"):
{
   

?>
<style>
.table-responsive
{
    display:none !important;
}
input {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}

</style>
<center><h2>Upload File</h2></center>
<div style="width:600px;margin: auto;background: #eeeeee;padding: 36px;border: 2px solid #303988;" id="uploadnow">
<form method="post" enctype="multipart/form-data" action="upload/fileupload.php">
<?php echo Csrf::field(); ?>
<input type="hidden" name="user_id" value="<?php echo (int) $groupid; ?>">
  <input type="text" name="filetitle" value="" size="40" required placeholder="File Title"><br>
        <label id="fileLabel" style="color: #000;font-weight: bold; ">Upload Document</label>
	<input id="aa" class="confirmationx" style="background: #fff;border: 1px solid #a3a3a3;" onchange="pressed()" type="file" required name="fileToUpload" size="40" accept="<?php echo htmlspecialchars(UploadValidator::getAcceptAttribute(), ENT_QUOTES, 'UTF-8'); ?>" aria-invalid="false">
     

        <br></p><p> 
 
   <p> 
<input type="submit" value="UPLOAD NOW"  class=" btn btn-main">
</p>
</form></div><br><br>
             <?}
endif
?>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-2" style="display:none;">
                        <div class="panel">
                            <div class="panel-body">
                            <form action="includes/logprocess.php" id="user-groups-edit" class="form-horizontal" method="post">
                                <?php echo Csrf::field(); ?>
                                <input type="Submit" class="btn btn-main" value="Delete All Logs" onclick="return confirm ('Are you sure you want to delete all the logs, this cannot be undone?')">
                                <input type="hidden" name="form_submission" value="delete_logs">
                            </form>
                                <br>
                            <form action="includes/logprocess.php" id="user-groups-edit" class="form-horizontal" method="post">
                                <?php echo Csrf::field(); ?>
                                <input type="Submit" class="btn btn-main" value="Delete Logs (> 30 days)" onclick="return confirm ('Are you sure you want to delete some logs, this cannot be undone?')">
                                <input type="hidden" name="form_submission" value="delete_some_logs">
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

            

            </div>
            <!-- END Page Content -->

            <?php include('rightsidebar.php'); ?>

        </div>
        <!-- END Page Wrapper -->
        
        <!-- Scroll to top -->
        <a href="#" id="to-top" class="to-top"><i class="fas fa-angle-double-up"></i></a>

        <?php include('inc/core-scripts.php'); ?>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        <!-- Datatables JS - https://cdn.datatables.net/ -->
        <script src="js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.min.js"></script>
        

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

       <script>
       $(document).ready(function() {
    $('#dataTable').DataTable( {
       
    } );
} );
        </script>       

    </body>
</html>
<?php
}
?>