<?php 
include("includes/controller.php");
$pagename = 'cms';

$container = '';
if(!$session->isSuperAdmin()){
    header("Location: ".$configs->homePage());
    exit;
}
else{
    
    //Delete Content
    if(isset($_GET['action']) && isset($_GET['cmsid'])): 
    
   $action= $_GET['action'];
    
    if ($action=="delete")
    {
        $cmsid=$_GET['cmsid'];
    $sqldel = "DELETE FROM cms_category WHERE id='$cmsid'";
    $resultdel = $db->prepare($sqldel);
    $resultdel->execute();
    }
    endif; 
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
                    <i class="fas fa-user"></i>
                    <h2>CMS</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <form name="post" action="add_categories.php" method="get">
                                <input type="hidden" value="cmsadmin" name="admincms">
                                <input type="submit" class="btn btn-main" value="Add New Category">
                                 <input type="button" onclick="location.href='cms.php'" class="btn btn-main" value="View Content/Pages">
                                </form>
                               
                                
                        </li>
                    </ol>
                </div>
                <!-- END Title Header -->
             
             
           
             
                <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="panel">
                          
                                <div class="panel-body">
                                    <!-- Tab panes -->
                                    <div class="tab-content">

                                        <div role="tabpanel" class="tab-pane active" id="user_table">
                                            <div class="panel">
                                             
                                                <div class="panel-body table-responsive">
                                                    <table class="table table-striped table-bordered table-hover" id="dataTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Category / Section Name</th>
                                                               
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                          
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            
                                                            $sql = "SELECT * FROM cms_category ORDER BY id desc";
                                                        
                                                            $result = $db->prepare($sql);
                                                            $result->execute();
                                                            while ($row = $result->fetch()) {
                                                                $title = $row['name'];
                                                                 $portaltype = $row['portaltype'];
                                                                 $id=$row['id'];
                                                                  echo "<tr><td><a href='add_categories.php?admincms=cmsadmin&id=" . $row['id'] . "'>" . $row['name'] . "</a></td>"
                                                               // . "<td>" . $portaltype . "</td>"
                                                                . "<td><a href='add_categories.php?admincms=cmsadmin&id=" . $row['id'] . "'>Edit</a></td><td><a class='confirmation' href='cms-categories.php?action=delete&cmsid=" .$row['id']."'>Delete</a></td>"
                                                               
                                                                . "</tr>";
                                                            }
                                                            ?>
<script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure, you want to delete this post?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>
                                                        </tbody>
                                                    </table>
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
        
        <!-- Initialize Form Validation -->
        <script src="js/plugins/formValidation/useradminFormsValidation.js"></script>
        <script src="js/plugins/formValidation/jquery.validate.js"></script>
        <script>$(function() { FormsValidation.init(); });</script> 
        
        <!-- Datatables JS - https://cdn.datatables.net/ -->
        <script src="js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.min.js"></script>
        
        <script>
            $(document).ready(function () {
                $('#dataTable').dataTable({
                    "columnDefs": [
                    { "width": "15px", "targets": 5 },
                    { "orderable": false, "targets": 5 }
                    ]
                });
            });

            $(document).ready(function () {
                $('#dataTable2').dataTable({         
                    "order": [[ 3, "desc"]],
                    "columnDefs": [
                    { "width": "15px", "targets": 0 },
                    { "width": "15px", "targets": 5 },
                    { "orderable": false, "targets": 0 },
                    { "orderable": false, "targets": 5 }                  
                    ]
                });
            });
           
            $(document).ready(function () {
                $('#dataTable3').dataTable({         
                    "order": [[ 1, "asc"]],
                    "columnDefs": [
                    { 
                        "width": "15px", "targets": 0,
                        "orderable": false, "targets": 0 }
                    ]
                });
            });
            
        </script>
        
        <script type="text/javascript">
            $(function() {
                // Javascript to enable link to tab
                var hash = document.location.hash;
                if (hash) {
                    console.log(hash);
                    $('.nav-tabs a[href='+hash+']').tab('show');
                }

                // Change hash for page-reload
                $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                    window.location.hash = e.target.hash;
                });
             });
        </script>
        
        <!-- Check all (set for closest table) -->
        <script>
        $(function () {
            $('.checkall').on('click', function () {
            $(this).closest('table').find(':checkbox').prop('checked', this.checked);
            });
        });
        </script>   

    </body>
</html>
<?php
}
?>