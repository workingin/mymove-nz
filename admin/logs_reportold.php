<?php
include("includes/controller.php");
$pagename = 'inz_report';

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
        
        
        <style>
            .d-flex-between {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .filter {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 10px 16px 7px;
                gap: 10px;
                text-wrap: nowrap;
            }
            
            .filter > * {
                margin: 0;
            }
            
            .filter > select {
                max-width:270px; 
            }
        </style>
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
                    <h2>All Employees INZ Settlement Report for Accreditation</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li class="active">
                            INZ Settlement Report for Accreditation
                        </li>
                    </ol>
                </div>
                <!-- END Title Header -->
             
                <div class="row">                                     
                    <div class="col-md-12 col-lg-12">
                        <div class="panel">
                            <div class="d-flex-between panel-heading">
                                <h2 class="panel-title">All Employees INZ Settlement Report for Accreditation</h2>
                                <div class="filter">
                                    <?php $filter_group = $_GET['group'] ?? null ?>
                                    <p>Filter by Groups:</p>
                                    <select class="form-control form-control-sm" onchange="applyFilters(this.options[this.selectedIndex].value)">
                                        <option value="all" >All</option>
                                        <?php
                                        if($session->isSuperAdmin()){
                                            $sqlgr = "SELECT * FROM groups";
                                        }else{
                                            $sqlgr = "SELECT groups.* FROM `users` INNER JOIN users_groups ON users.id = users_groups.user_id INNER JOIN groups ON users_groups.group_id = groups.group_id WHERE groups.group_id != 1 AND username= '$session->username'";
                                        }
                                        $resultgr = $db->prepare($sqlgr);
                                        $resultgr->execute();
                                        while ($rowgr = $resultgr->fetch()):
                                        ?>
                                        
                                        <option value="<?= $rowgr['group_id'] ?>" <?php if($rowgr['group_id'] == $filter_group): echo 'selected'; endif; ?> ><?= $rowgr['group_name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="panel-body table-responsive">
                                <!--<form method="post">-->
                                <!--  <div class="input-daterange">-->
                                <!--   <div class="col-md-4">-->
                                <!--    <label>From Date</label>-->
                                <!--    <input type="text" name="start_date" class="form-control" readonly />-->
                                <!--    <?php echo @$start_date_error; ?>-->
                                <!--   </div>-->
                                <!--   <div class="col-md-4">-->
                                <!--    <label>To Date</label>   -->
                                <!--    <input type="text" name="end_date" class="form-control" readonly />-->
                                <!--    <?php echo @$end_date_error; ?>-->
                                <!--   </div>-->
                                <!--  </div>-->
                                <!--  <div class="col-md-2">-->
                                <!--   <input type="submit" name="export" value="Export" class="btn btn-info" />-->
                                <!--  </div>-->
                                <!-- </form>-->
                                 <br>
                                <table style="width:100%;" class="table table-striped table-bordered table-hover" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>User Email</th>
                                                <!--<th>Full Name</th>-->
                                                <th>Event</th>
                                                <th>Date / Time</th>
                                            
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
                                           
                                            // Pagination
                                            $perPage = 25;
                                            $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                                            $start_at = $perPage * ($page - 1);
                                            $pagniate_query = "SELECT COUNT(*) as total FROM 
                                                                (
                                                                    SELECT * FROM log_table WHERE (log_operation='LOGIN' OR log_operation LIKE 'REGISTERED%') GROUP BY  userid, log_operation 		ORDER BY timestamp DESC
                                                                ) AS x;";
                                            $pagniate_result = $db->prepare($pagniate_query);
                                            $pagniate_result->execute();
                                            $r = $pagniate_result->fetch();    
                                            $totalPages = ceil($r['total'] / $perPage);
                                            
                                            // print_r(compact('perPage','page','start_at','totalPages'));die;
                                            
                                           $sql = "SELECT * FROM log_table as lt 
                                                JOIN users_groups ON lt.userid = users_groups.user_id 
                                                WHERE (lt.log_operation='LOGIN' OR lt.log_operation LIKE 'REGISTERED%') ";
                                            
                                            if(!$session->isSuperAdmin()){
                                                $sql .= "AND users_groups.group_id IN (SELECT group_concat(groups.group_id) FROM `users` INNER JOIN users_groups ON users.id = users_groups.user_id INNER JOIN groups ON users_groups.group_id = groups.group_id WHERE groups.group_id != 1 AND username= '$session->username')";
                                            }
                                            
                                            if($filter_group != null){
                                                $sql .= " AND users_groups.group_id = $filter_group";
                                            }    
                                                
                                            $sql .= " GROUP BY lt.userid, lt.log_operation 
                                                    ORDER BY lt.timestamp DESC
                                                    LIMIT $start_at, $perPage;";
                                            // if($session->username == 'domains@workingin.com'){
                                            //     echo'<pre>'; print_r($sql); exit;
                                            // }
                                            // $sql = "SELECT * FROM log_table WHERE log_operation='LOGIN' OR log_operation LIKE 'REGISTERED%' GROUP BY userid, log_operation ORDER BY timestamp DESC";
                                            $result = $db->prepare($sql);
                                            $result->execute();
                                            $log_data = $result->fetchAll();
                                            
                                            
                                            
                                            foreach ($log_data as $row) {
                                                
                                                $email = $functions->getUserInfoSingularFromId('email', $row['userid']);
                                                $firstname = $functions->getUserInfoSingularFromId('firstname', $row['userid']);
                                                $lastname = $functions->getUserInfoSingularFromId('lastname', $row['userid']);
                                                // if($functions->getUserInfoSingularFromId('groupid', $row['userid'])=="$groupid")
                                                // {
                                                echo "<tr>";
                                                echo "<td>$email</td>";
                                                // echo "<td>$firstname $lastname</td>";
                                                echo "<td>".$row['log_operation']."</td>";
                                                echo "<td>".$adminfunctions->displayDate($row['timestamp'])."</td>";
                                       
                                                echo "</tr>";
                                            // }
                                            //     else
                                            // {
                                                
                                            // }
                                                
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
                                                <li><a href="/admin/logs_report.php?page=<?= ($page - 1) ?>">Previous</a></li>
                                            <?php endif; ?>
                                            
                                            
                                            <!--first page-->
                                            <?php if($page == 1): ?>
                                            <li class="active"><a href="#">1</a></li>
                                            <?php else: ?>
                                            <li><a href="/admin/logs_report.php?page=1">1</a></li>
                                            <?php endif; ?>
    
                                            <?php if($page < 5): ?>
                                                <?php 
                                                    for($x = 2; $x <= 5; $x++) {
                                                        if($page == $x) echo "<li class='active'><a href='#'>";
                                                        else echo "<li><a href='/admin/logs_report.php?page=$x'>";
                                                        echo "$x</a></li>";
                                                    }
                                                    echo "<li class='disabled'><a href='#'>...</a></li>";
                                                ?>
                                                
                                            <?php elseif($page >= 5 && $page < ($totalPages-3)): ?>
                                                <li class="disabled"><a href="#">...</a></li>
                                                <li><a href="/admin/logs_report.php?page=<?= $page - 1 ?>"><?= $page - 1 ?></a></li>
                                                <li class="active"><a href="#"><?= $page ?></a></li>
                                                <li><a href="/admin/logs_report.php?page=<?= $page + 1 ?>"><?= $page + 1 ?></a></li>
                                                <li class="disabled"><a href="#">...</a></li>
                                            <?php else:
                                                echo "<li class='disabled'><a href='#'>...</a></li>";
                                                for($x = ($totalPages-4); $x <= ($totalPages-1) ; $x++) {
                                                    if($page == $x) echo "<li class='active'><a href='#'>";
                                                    else echo "<li><a href='/admin/logs_report.php?page=$x'>";
                                                    echo "$x</a></li>";
                                                }
                                            ?>
                                            <?php endif; ?>
    
                                            <!--last page-->
                                            <?php if($page == $totalPages): ?>
                                            <li class="active"><a href="#"><?= $totalPages ?></a></li>
                                            <?php else: ?>
                                            <li><a href="/admin/logs_report.php?page=<?= $totalPages ?>"><?= $totalPages ?></a></li>
                                            <?php endif; ?>
                                            
                                            
                                            <!--next page-->
                                            <?php if($page >= $totalPages): ?>
                                                <li class="disabled" ><a href="#">Next</a></li>
                                            <?php else: ?>
                                                <li><a href="/admin/logs_report.php?page=<?= ($page + 1) ?>">Next</a></li>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
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
        var dataTable = $('#dataTable').DataTable( {
        searching: false,
        ordering:  false,
        paging: false,
        info: false,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: ' INZ Settlement Report for Accreditation'
            },
            {
                extend: 'pdfHtml5',
                title: ' INZ Settlement Report for Accreditation'
            }
        ]
    } );
        
} );


        function applyFilters(value) {
            $redirect_url = (value == "all") ? (window.location.href).split("?")[0] : (window.location.href).split("?")[0] + '?group=' + value;
            window.location = $redirect_url;
        }
        </script>       

    </body>
</html>
<?php
}
?>