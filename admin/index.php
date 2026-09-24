<?php 
include("includes/controller.php");
$pagename = 'useradmin';

$container = '';
if(!$session->isAdmin()){
    header("Location: login.php");
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
                    <i class="fas fa-user"></i>
                    <h2>User Admin</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li class="active">
                            User Admin <?
                            
                            
                            $usern=$session->username;
                            $sql = "SELECT * FROM users WHERE username = '$usern'";
                                                            $result = $db->prepare($sql);
                                                            $result->execute();
                                                            while ($row = $result->fetch()) {
                                                                $groupid = $row['groupid'];
                                                                $username = $row['username'];
                                                                
                                                            }
                            
                            ?>
                        </li>
                    </ol>
                </div>
                <!-- END Title Header -->
                
     
             
                <div class="row">   
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <button href="#createUser" type="button" class="btn btn-main" data-toggle="modal">Create User</button>
                                <?php 
                               // $stop = $adminfunctions->createStop($session->username, 'delete-inactive');
                                ?>
                              
                            </div>
                        </div>
                    </div>
                </div>
             
                <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#user_table" aria-controls="user_table" role="tab" data-toggle="tab">User Table</a></li>
                                      <? if ($session->isSuperAdmin()){?>   <li role="presentation"><a href="#users_activation" aria-controls="users_activation" role="tab" data-toggle="tab">Users Awaiting Activation</a></li>
                                          
                                        <li role="presentation"><a href="#current_sessions" aria-controls="current_sessions" role="tab" data-toggle="tab">Current Sessions</a></li>
                                        <?}?>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <!-- Tab panes -->
                                    <div class="tab-content">

                                        <div role="tabpanel" class="tab-pane active" id="user_table">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <h2 class="panel-title">User's Table</h2>
                                                </div>
                                                <div class="panel-body table-responsive">
                                                    <table class="table table-striped table-bordered table-hover" id="dataTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Username</th>
                                                                <th>Status</th>
                                                                <th>Company/Group</th>
                                                                <th>Registered</th>
                                                                <th>Last Login</th>
                                                                <th class='text-center'>View</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                             if ($session->isSuperAdmin()){
                                                                   $sql = "SELECT * FROM users WHERE username != '" . ADMIN_NAME . "' order by id desc";
                                                            }
                                                            else
                                                            {
                                                                if ($username=="Shirley.Mok@oceaniahealthcare.co.nz")
                                                                {
                                                            $sql = "SELECT * FROM users WHERE username != '" . ADMIN_NAME . "' AND groupid='91' OR groupid='14' order by id desc";
                                                                }
                                                                else
                                                                {
                                                                    
                                                                      $sql = "SELECT * FROM users WHERE username != '" . ADMIN_NAME . "' AND groupid='$groupid'  order by id desc";
                                                                }
                                                            }
                                                            $result = $db->prepare($sql);
                                                            $result->execute();
                                                            while ($row = $result->fetch()) {
                                                                $email = $row['email'];
                                                                 $email = $row['email'];
                                                                 $groupid=$row['groupid'];
                                                                 
                                                            $sqlgroup = "SELECT * FROM `groups` WHERE group_id='$groupid' ";
                                                            
                                                            $resultgroup = $db->prepare($sqlgroup);
                                                            $resultgroup->execute();
                                                            while ($rowgroup = $resultgroup->fetch()) {
                                                                 $rowgroup=$rowgroup['group_name'];
                                                                
                                                            
                                                                $email = strlen($email) > 25 ? substr($email, 0, 25) . "..." : $email;
                                                                $lastlogin = $adminfunctions->displayDate($row['timestamp']);
                                                                $reg = $adminfunctions->displayDate($row['regdate']);

                                                                echo "<tr><td><a href='adminuseredit.php?usertoedit=" . $row['username'] . "'>" . $row['username'] . "</a></td>"
                                                                . "<td>" . $adminfunctions->displayStatus($row['username']) . "</td>"
                                                                
                                                                
                                                                
                                                                . "<td>" . $rowgroup . "</td>"
                                                                
                                                                . "<td>" . $reg . "</td><td>" . $lastlogin . "</td>"
                                                                . "<td class='text-center'><div class='btn-group btn-group-xs'><a href='adminuseredit.php?usertoedit=" . $row['username'] . "' title='Edit' class='open_modal btn btn-default'><i class='fas fa-edit'></i> View</a></td>"
                                                                . "</tr>";
                                                            }}
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        $orderby = 'regdate';
                                        $result2 = $adminfunctions->displayAdminActivation($orderby);
                                        ?>
                                        <div role="tabpanel" class="tab-pane" id="users_activation">
                                            <div class="panel">
                                                    <div class="panel-heading">
                                                        <h2 class="panel-title">Users Awaiting Activation</h2>
                                                    </div>
                                                    <div class="panel-body table-responsive">
                                                        <form class="form-horizontal" role="form" action="includes/adminprocess.php" method="POST">
                                                        <?php echo Csrf::field(); ?>                                
                                                            <table class="table table-striped table-bordered table-hover" id="dataTable2">
                                                                <thead>
                                                                    <tr>
                                                                        <th><input type="checkbox" class="checkall"></th>
                                                                        <th>Username</th>
                                                                        <th>E-mail</th>
                                                                        <th>Registered</th>
                                                                        <th>IP Address</th>
                                                                        <th class='text-center'>View</th>                                                           
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    while ($row = $result2->fetch()) {
                                                                        $reg = $adminfunctions->displayDate($row['regdate']);
                                                                        $dbemail = $row['email'];
                                                                        $ip = $row['ip'];
                                                                        $email = strlen($dbemail) > 25 ? substr($dbemail, 0, 25) . "..." : $dbemail;
                                                                        echo "<tr>"
                                                                        . "<td><input name='user_name[]' type='checkbox' value='" . $row['username'] . "' /></td>"
                                                                        . "<td><a href='adminuseredit.php?usertoedit=" . $row['username'] . "'>" . $row['username'] . "</a></td>"
                                                                        . "<td><div class='shorten'><a href='mailto:" . $row['email'] . "'>" . $email . "</a></div></td>"
                                                                        . "<td>" . $reg . "</td>"
                                                                        . "<td>" . $ip . "</td>"
                                                                        . "<td class='text-center'><div class='btn-group btn-group-xs'><a href='adminuseredit.php?usertoedit=" . $row['username'] . "' title='Edit' class='open_modal btn btn-default'><i class='fas fa-edit'></i> View</a></td>"
                                                                        . "</tr>";
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                            <input type="hidden" name="form_submission" value="activate_users">
                                                            <button type="submit" id="submit" name="submit" class="btn btn-default"><i class="fas fa-sync-alt"></i> Activate Users</button>
                                                        </form>
                                                    </div>
                                                </div>       
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="current_sessions">
                                                <div class="panel">
                                                    <div class="panel-heading">
                                                        <h2 class="panel-title">Current Sessions</h2>
                                                    </div>
                                                    <div class="panel-body table-responsive">
                                                        <form class="form-horizontal" role="form" action="includes/adminprocess.php" method="POST">
                                                        <?php echo Csrf::field(); ?>                                
                                                            <table class="table table-striped table-bordered table-hover" id="dataTable3">
                                                                <thead>
                                                                    <tr>
                                                                        <th><input type="checkbox" class="checkall"></th>
                                                                        <th>Username</th>
                                                                        <th>Last IP Address</th>
                                                                        <th>Last</th>
                                                                        <th>Expiry</th>                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php 
                                                                $stop2 = $adminfunctions->createStop($session->username, 'delete-sessions');                             
                                                                $sql = "SELECT * FROM user_sessions ";
                                                                $result = $db->prepare($sql);
                                                                $result->execute();
                                                                while ($row = $result->fetch()) {
                                                                $userid = $row['userid'];
                                                                $id = $row['id'];
                                                                $username = $functions->getUserInfoSingularFromId('username', $userid);
                                                                $ipaddress = $row['ipaddress'];
                                                                $timestamp = $adminfunctions->displayDate($row['timestamp']);
                                                                $expires = $adminfunctions->displayDate($row['expires']);

                                                                echo "<tr>"
                                                                . "<td><input name='id[]' type='checkbox' value='" . $id . "' /></td>"
                                                                . "<td>" . $username . "</td>"
                                                                . "<td>" . $ipaddress . "</td>"
                                                                . "<td>" . $timestamp . "</td>"
                                                                . "<td>" . $expires . "</td>"
                                                                . "</tr>";
                                                                }
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                            <input type="hidden" name="form_submission" value="delete_individual_sessions">
                                                            <input type="hidden" name="stop" value="<?php echo $stop2; ?>">
                                                            <button type="submit" id="submit2" name="submit" class="btn btn-default"><i class="fas fa-times"></i> Delete Selected</button>
                                                            <a href="includes/adminprocess.php?form_submission=delete_all_user_sessions&amp;stop=<?php echo $stop2; ?>&amp;<?php echo Csrf::queryParam(); ?>" class='btn btn-main confirmation' onclick="return confirm ('Are you sure you want to delete all existing user sessions?')">Kill All User Sessions</span></a>
                                                        </form>
                                                    </div>
                                                </div>   
                                        </div>

                                    </div>
                                </div>                               
                            </div>                           
                        </div>
                    </div>
                
                <!-- Modal -->
                <div class="modal fade" id="createUser" class="modal" tabindex="-1" role="dialog" aria-labelledby="createUser" aria-hidden="true">
                    <div class="modal-dialog">
                            <div class="modal-content" id="modal-content">
                                <form class="form-horizontal" id="admin-create-user" action="includes/adminprocess.php" method="POST" role="form">
                                <?php echo Csrf::field(); ?>
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Create New User</h4>
                                    </div>
                                    <div class="modal-body">
                                            <div class="form-group <?php if(Form::error("firstname")){ echo 'has-error'; } ?> ">
                                               <? if ($usern=='admin')
                                               {
                                               ?>
                                        <div class="col-sm-12">  
                                        <table style="width:100%;border:0"><tr><td valign="top">  <b>Assign Portal Access:</b><br>
                                                  <input type="checkbox"  name="sportal" value="1">
                                                  <label for="vehicle1">Settlement Portal</label><br>
                                                  <input type="checkbox"  name="jportal" value="1">
                                                  <label  >Job Portal</label><br>
                                                  <input type="checkbox"  name="tportal" value="1">
                                                  <label  >Teacher Portal</label><br>
                                                  <br></td>
                                                  <td>
                                                  <b>Assign Support Letter Access:</b><br>
                                                  <input type="radio" id="bothsupport" name="support_letter_access" value="both">
                                                  <label for="bothsupport">Both Support Letters</label><br>
                                                  <input type="radio" id="accredited" name="support_letter_access" value="aewv">
                                                  <label for="accredited">AEWV Support Letter</label><br>
                                                  <input type="radio" id="straight" name="support_letter_access" value="SRV">
                                                  <label for="straight">SRV Support Letter</label><br>
                                                  <br>
                                                  </td>
                                                  <td><b>Client Type:</b><br>
                                                  <input type="radio" id="vehicle1" name="ctype" value="B2CCOS">
                                                  <label for="radio">B2C COS Client</label><br>
                                                  <input type="radio" id="vehicle2" name="ctype" value="B2BVisa">
                                                  <label for="vehicle2">B2B Visa Client </label><br>
                                                  <input type="radio" id="vehicle3" name="ctype" value="B2BRow">
                                                  <label for="vehicle3">B2C ROW Client </label> <br>
                                                  <input type="radio" id="vehicle3" name="ctype" value="B2BSilver">
                                                  <label for="vehicle3">B2B Silver Settlement Clients </label> </td></tr></table>
                                                                                      
                                                
                                                  </div>
                                                  <?}
                                                  else
                                                  {
                                                      
                                                  }
                                                  ?>                                        
                                            <div class="form-group <?php if (Form::error("groupid")) { echo 'has-error'; } ?>">
      
                                            
                                            
                                                   <? if ($session->isSuperAdmin()){?>
                                                 <label for="groupid" class="col-sm-4 control-label">Group/Company:</label>  
                                               <div class="col-sm-7" >
                                                <select name="groupid" class="form-control" id="groupid" >
                                                         <?php
                                                
                                                            $sqlg = "SELECT * FROM  groups ";
                                                            $resultg = $db->prepare($sqlg);
                                                            $resultg->execute();
                                                            while ($rowg = $resultg->fetch()) {
                                                                $group_name = $rowg['group_name'];
                                                                $group_id = $rowg['group_id'];
                                                            // echo $group_name;
                                                            ?><option value="<?echo $group_id;?>"><?echo $group_name;?></option><?
                                                               
                                                            }
                                                               }
                                                               else
                                                               {
                                                                ?>
                                                                <input type="hidden" name="groupid" value="<? echo $groupid;?>"><br>
                                                                <? 
                                                               }
                                                            ?>
                                                </select>
                                              <script>
                                                function FillBilling(f) {
                                                  if(f.billingtoo.checked == true) {
                                                    f.email.value = f.inputUsername.value;
                                                    f.conf_email.value = f.inputUsername.value;
                                                  }
                                                }
                                                </script><style>
                                                input:required:not(:checked) + label {
                                                  color: red;
                                                  font-size:20px;
                                                }
                                                </style>
                                               
                                            </div>
         
                                            <div class="col-sm-4">
                                                <small><?php echo Form::error("firstname"); ?></small>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="form-group <?php if (Form::error("user")) { echo 'has-error'; } ?>">
                                            <label for="inputUsername" class="col-sm-4 control-label">Username/Email ID:</label>
                                            <div class="col-sm-7">
                                                <input name="user" type="email" class="form-control" id="inputUsername" placeholder="Username/Email" value="<?php echo Form::value("user"); ?>">                            
                                            </div>
                                            <div class="col-sm-4">
                                                <small><?php echo Form::error("user"); ?></small>
                                            </div>
                                        </div>
                                             
                                    
                                        
                                        <div class="form-group <?php if(Form::error("firstname")){ echo 'has-error'; } ?> ">
                                            <label for="inputFirstname" class="col-sm-4 control-label">First Name:</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="firstname" class="form-control" id="inputFirstname" placeholder="First Name" value="<?php echo Form::value("firstname"); ?>">                             
                                            </div>
                                            <div class="col-sm-4">
                                                <small><?php echo Form::error("firstname"); ?></small>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group <?php if(Form::error("lastname")){ echo 'has-error'; } ?>">
                                            <label for="inputLastname" class="col-sm-4 control-label">Last Name:</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="lastname" class="form-control" id="inputLastname" placeholder="Last Name" value="<?php echo Form::value("lastname"); ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <small><?php echo Form::error("lastname"); ?></small>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group <?php if(Form::error("pass")){ echo 'has-error'; } ?>">
                                            <label for="inputPassword" class="col-sm-4 control-label">New Password:</label>
                                            <div class="col-sm-7">
                                                <input type="password" name="pass" class="form-control" id="inputPassword" placeholder="New Password">
                                            </div>
                                            <div class="col-sm-4">
                                                <small><?php echo Form::error("pass"); ?></small>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group <?php if(Form::error("conf_newpass")){ echo 'has-error'; } ?>">
                                            <label for="confirmPassword" class="col-sm-4 control-label">Confirm Password:</label>
                                            <div class="col-sm-7">
                                                <input type="password" name="conf_pass" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                                            </div>
                                            <div class="col-sm-4">
                                                <small><?php echo Form::error("pass"); ?></small>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group <?php if(Form::error("email")){ echo 'has-error'; } ?>">
                                           
                                            <div class="col-sm-8" style="text-align:center;">
                                                <br>
                                          <input required type="checkbox" name="billingtoo" onclick="FillBilling(this.form)">
                                          <label for="required">*</label>Agree to our TOS and privacy policy
                                          <br>
                                                <input style="display:none;" type="text" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo Form::value("email"); ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <small><?php echo Form::error("email"); ?></small>
                                            </div>
                                        </div>
                                        
                                        <div style="display:none;" class="form-group <?php if(Form::error("email")){ echo 'has-error'; } ?>">
                                            <label for="conf_email" class="col-sm-4 control-label">Confirm E-mail:</label>
                                            <div class="col-sm-7">
                                                <input style="display:none;" name="conf_email" type="text" id="conf_email" class="form-control" placeholder="Confirm Email" value="<?php echo Form::value("email"); ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <small><?php echo Form::error("email"); ?></small>
                                            </div>
                                        </div>

                                    <input type="hidden" name="form_submission" value="admin_registration">                                         

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="submit3" >Create New User</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END Modal -->

              

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
                    "order": [[ 3, "desc"]],
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