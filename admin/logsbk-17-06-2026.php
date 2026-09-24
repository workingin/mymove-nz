<?php 
include("includes/controller.php");
$pagename = 'logs';
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
                    <h2>Logs</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li class="active">
                            Logs
                        </li>
                    </ol>
                </div>
                <!-- END Title Header -->
             
                <div class="row">                                     
                    <div class="col-md-9 col-lg-10">
                        <div class="panel">
                            <div class="panel-heading">
                                <h2 class="panel-title">Logs</h2>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Event</th>
                                                <th>Date / Time</th>
                                                <th>IP Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Pagination
                                            $perPage = 25;
                                            $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                                            $start_at = $perPage * ($page - 1);
                                            $pagniate_query = "SELECT COUNT(*) as total FROM log_table ORDER BY timestamp DESC;";
                                            $pagniate_result = $db->prepare($pagniate_query);
                                            $pagniate_result->execute();
                                            $r = $pagniate_result->fetch();    
                                            $totalPages = ceil($r['total'] / $perPage);
                                            
                                            // Fetching & Showing Data
                                            $sql = "SELECT * FROM log_table ORDER BY timestamp DESC LIMIT $start_at, $perPage";
                                            $result = $db->prepare($sql);
                                            $result->execute();
                                            while ($row = $result->fetch()) {
                                                
                                                $username = $functions->getUserInfoSingularFromId('username', $row['userid']);

                                                echo "<tr>";
                                                echo "<td>$username</td>";
                                                echo "<td>".$row['log_operation']."</td>";
                                                echo "<td>".$adminfunctions->displayDate($row['timestamp'])."</td>";
                                                echo "<td>".$row['ip']."</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                </table>
                                    <nav style="float:right;">
                                            <ul class="pagination pagination-sm">
                                                <!--previous page-->
                                                <?php if($page < 2): ?>
                                                    <li class="disabled" ><a href="#">Previous</a></li>
                                                <?php else: ?>
                                                    <li><a href="/admin/logs.php?page=<?= ($page - 1) ?>">Previous</a></li>
                                                <?php endif; ?>
                                                
                                                
                                                <!--first page-->
                                                <?php if($page == 1): ?>
                                                <li class="active"><a href="#">1</a></li>
                                                <?php else: ?>
                                                <li><a href="/admin/logs.php?page=1">1</a></li>
                                                <?php endif; ?>
        
                                                <?php if($page < 5):
                                                        for($x = 2; $x <= 5; $x++) {
                                                            if($page == $x) echo "<li class='active'><a href='#'>";
                                                            else echo "<li><a href='/admin/logs.php?page=$x'>";
                                                            echo "$x</a></li>";
                                                        }
                                                        echo "<li class='disabled'><a href='#'>...</a></li>";
                                                ?>
                                                    
                                                <?php elseif($page >= 5 && $page < ($totalPages-3)): ?>
                                                    <li class="disabled"><a href="#">...</a></li>
                                                    <li><a href="/admin/logs.php?page=<?= $page - 1 ?>"><?= $page - 1 ?></a></li>
                                                    <li class="active"><a href="#"><?= $page ?></a></li>
                                                    <li><a href="/admin/logs.php?page=<?= $page + 1 ?>"><?= $page + 1 ?></a></li>
                                                    <li class="disabled"><a href="#">...</a></li>
                                                <?php else:
                                                        echo "<li class='disabled'><a href='#'>...</a></li>";
                                                        for($x = ($totalPages-4); $x <= ($totalPages-1) ; $x++) {
                                                            if($page == $x) echo "<li class='active'><a href='#'>";
                                                            else echo "<li><a href='/admin/logs.php?page=$x'>";
                                                            echo "$x</a></li>";
                                                        }
                                                ?>
                                                <?php endif; ?>
        
                                                <!--last page-->
                                                <?php if($page == $totalPages): ?>
                                                <li class="active"><a href="#"><?= $totalPages ?></a></li>
                                                <?php else: ?>
                                                <li><a href="/admin/logs.php?page=<?= $totalPages ?>"><?= $totalPages ?></a></li>
                                                <?php endif; ?>
                                                
                                                
                                                <!--next page-->
                                                <?php if($page >= $totalPages): ?>
                                                    <li class="disabled" ><a href="#">Next</a></li>
                                                <?php else: ?>
                                                    <li><a href="/admin/logs.php?page=<?= ($page + 1) ?>">Next</a></li>
                                                <?php endif; ?>
                                            </ul>
                                    </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-2" style="display:none;">
                        <div class="panel">
                            <div class="panel-body">
                            <form action="includes/logprocess.php" id="user-groups-edit" class="form-horizontal" method="post">
                                <input type="Submit" class="btn btn-main" value="Delete All Logs" onclick="return confirm ('Are you sure you want to delete all the logs, this cannot be undone?')">
                                <input type="hidden" name="form_submission" value="delete_logs">
                            </form>
                                <br>
                            <form action="includes/logprocess.php" id="user-groups-edit" class="form-horizontal" method="post">
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

        <!-- JavaScript Resources -->
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/xavier.js"></script>
        
        <!-- Datatables JS - https://cdn.datatables.net/ -->
        <script src="js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.min.js"></script>
        
       <script>
            $(document).ready(function () {
                $('#dataTable').dataTable({
                    searching: false,
                    ordering:  false,
                    paging: false,
                    info: false,
                    dom: 'Bfrtip',
                // "order": [[ 2, "desc"]],
                // "pageLength": 25
                });
            });
        </script>       

    </body>
</html>
<?php
}
?>