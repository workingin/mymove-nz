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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
        <!--Select2-->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
            .dt-paging > nav{
                float:right;
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
                                
                            </div>
                            <div class="col-md-12" style="margin-top:10px; margin-left:3px;" >
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?php $filter_group = $_GET['group'] ?? null ?>
                                            <p>Filter by Groups:</p>
                                            <!--onchange="applyFilters(this.options[this.selectedIndex].value)"-->
                                            <select class="form-control form-control-sm" id="filter_group" >
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
                                        <div class="col-md-3">
                                            <p>From Date</p>
                                            <input type='date' id='from_date' class='form-control'/>
                                        </div>
                                        <div class="col-md-3">
                                            <p>End Date</p>
                                            <input type='date' id='end_date' class='form-control'/>
                                        </div>
                                        <div class="col-md-3">
                                            <p></p>
                                            </br>
                                            <button class="btn btn-primary" id="btnfilter">Filter</button>
                                        </div>
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
                                                <th>Event</th>
                                                <th>Date / Time</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>User Email</th>
                                                <th>Event</th>
                                                <th>Date / Time</th>
                                            </tr>
                                        </tfoot>
                                </table>
                                   
                            </div>
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
        <!--Datepicker-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
        <!--Datatable-->
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
         <!--Select2-->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
       <script>
       
        var table =  $('#dataTable').DataTable({
         processing: true,
        serverSide: true,
        order: [[2, 'desc']],
        'ajax':{
            'url' : '../admin/includes/ServerProcessing.php',
            'data' : function(d){
                return $.extend( {}, d , {
                    "filter_group" : $('#filter_group').val(),
                    "filter_from_date" : $('#from_date').val(),
                    "filter_end_date" : $('#end_date').val(),
                })
            },
        },
        
        searching:false,
        responsive: true,
        lengthMenu: [
                [100, 200, 500, 1000,  -1],
                [100, 200, 500, 1000, "All"]
            ],
        dom: 'Bfrtip',
        buttons: [{extend: 'pageLength',},{
                extend: 'excel',
                title: ' INZ Settlement Report for Accreditation',
                exportOptions : {
                    modifier : {
                        // DataTables core
                        order : 'current',  // 'current', 'applied', 'index',  'original'
                        page : 'all',      // 'all',     'current'
                        search : 'none'     // 'none',    'applied', 'removed'
                    }
                }
            },{
                extend: 'pdf',
                title: ' INZ Settlement Report for Accreditation',
                exportOptions : {
                    modifier : {
                        // DataTables core
                        order : 'current',  // 'current', 'applied', 'index',  'original'
                        page : 'all',      // 'all',     'current'
                        search : 'none'     // 'none',    'applied', 'removed'
                    }
                }
            }
            ]
    } );
        

        $(document).ready(function() {
            // table.draw();
            $('#btnfilter').on('click',function(){
                table.draw();
            })
        } );


        function applyFilters(value) {
            $redirect_url = (value == "all") ? (window.location.href).split("?")[0] : (window.location.href).split("?")[0] + '?group=' + value;
            window.location = $redirect_url;
        }
        
          $(document).ready(function() {
            // Initialize Select2 on the group filter
            $('#filter_group').select2({
                placeholder: "Select a group",
                allowClear: true,  
                width: '100%', 
            });
        
            $('#btnfilter').on('click', function(){
                table.draw();
            });
        });
        </script>       

    </body>
</html>
<?php
}
?>