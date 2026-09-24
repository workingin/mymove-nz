<?php 
include("includes/controller.php");
$pagename = 'useradmin';
$container = '';

if(!$session->isAdmin() OR !isset($_GET['usertoedit'])){
    header("Location: ".$configs->homePage());
    exit;
} else {
    $usertoedit = $_GET['usertoedit'];
    if (!$functions->usernameTaken($usertoedit)) { header("Location: ".$configs->homePage()); exit; }
    $req_user_info = $functions->getUserInfo($usertoedit);
    if (!$req_user_info) { header("Location: ".$configs->homePage()); exit; }
    if (!$session->isSuperAdmin() AND (strtolower($_GET['usertoedit']) == strtolower(ADMIN_NAME) ||  $req_user_info['userlevel'] == '10')) { header("Location: ".$configs->homePage()); exit; }
    $form = new Form;
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            .dataTables_filter
            {
                display:none !important;
            }
            .dt-buttons
            {
                padding-bottom:10px;
            }
        </style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="fonts/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">

        <link href="css/navigation.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        
        <!-- Chosen CSS -->
        <link href="css/plugins/chosen/chosen.css" rel="stylesheet">       
        
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
                    <i class="fas fa-edit"></i>
                    <h2>User Edit : <?php echo $usertoedit; ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="useradmin.php">User Admin</a>
                        </li>
                        <li class="active">
                            User Edit
                        </li>
                    </ol>
                </div>
                <!-- END Title Header -->
                
                <?php if ($session->isSuperAdmin() && strtolower($usertoedit) != strtolower($session->username)){ ?>
                <div class="row">   
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" role="form" action="includes/adminprocess.php">
                                <?php echo Csrf::field(); ?>
                                    <?php echo $adminfunctions->stopField($session->username, 'delete-user'); ?>
                                    <input type="hidden" name="form_submission" value="delete_user">
                                    <input type="hidden" name="usertoedit" value="<?php echo $usertoedit; ?>">
                                    <?php if ($session->isSuperAdmin() && strtolower($usertoedit) != strtolower($session->username)){ ?>
                                    <button type="submit" id="submit" name="button" <?php if(($functions->checkBanned($usertoedit))) { echo "value='unban User'"; } else { echo "value='Ban User'"; } ?><?php if(($functions->checkBanned($usertoedit))) { echo "class='btn btn-primary'";  } else { echo "class='btn btn-warning'"; } ?> ><i class="fas fa-ban "></i> <?php if(($functions->checkBanned($usertoedit))) { echo "UnBan User"; } else { echo "Ban User"; } ?></button>
                                    <?php } if ($session->isSuperAdmin() && strtolower($usertoedit) != strtolower($session->username)){ ?>
                                    <button type="submit" id="submit" name="button" <?php if ($functions->getUserInfoSingular('userlevel', $usertoedit) != '9') { echo "value='Promotetoadmin'"; } else { echo "value='Demotefromadmin'"; } ?> class="btn btn-default" onclick="return confirm ('Are you sure you want to promote or demote this user?\n\n' + 'Click OK to continue or Cancel to Abort!')"><i class=" fa <?php if ($functions->getUserInfoSingular('userlevel', $usertoedit) != '9') { echo "fa-arrow-up"; } else { echo "fa-arrow-down"; } ?> "></i> <?php if ($functions->getUserInfoSingular('userlevel', $usertoedit) != '9') { echo "Promote to Admin"; } else { echo "Demote from Admin"; } ?></button> 
                                    <?php } if ($session->isSuperAdmin() && strtolower($usertoedit) != strtolower($session->username)){ ?>
                                    <button type="submit" id="submit" name="button" value="Delete" class="btn btn-danger" onclick="return confirm ('Are you sure you want to delete this user, this cannot be undone?\n\n' + 'Click OK to continue or Cancel to Abort!')"><i class=" fas fa-times "></i> Delete User</button>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
             
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">General Info</a></li>
                                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Edit Account</a></li>
                                    
                                    
                                    
                                   <?php if ($session->isSuperAdmin()){ ?> <li role="presentation"><a href="#groups" aria-controls="groups" role="tab" data-toggle="tab">Group Membership</a></li><?}?>
                                
                                    <li role="presentation"><a href="#sessions" aria-controls="sessions" role="tab" data-toggle="tab">Active Sessions</a></li>
                                    <li role="presentation"><a href="#logs" aria-controls="logs" role="tab" data-toggle="tab">Logs</a></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        
                                          
                                                          <? if ($session->isAdmin())
                                               {
                                               ?>  <div class="form-group">
                                               <form class="form-horizontal" method="POST" role="form" action="updatejobsettle.php">
                                               <?php echo Csrf::field(); ?>
                                        <div class="col-sm-12">  
                                        <table style="width:100%;border:0"><tr><td valign="top">  <b>Assign Portal Access:</b><br><br>
                                     
                                        <?php 
                                        if ($req_user_info['sportal']=="1")
                                        {
                                       ?> 
                                         <input type="hidden"  name="sportal" value="0" > 
                                       <input type="checkbox"  name="sportal" value="1" Checked>   <label for="vehicle1">Settlement Portal</label>
                                       <?
                                       } else
                                        {
                                            ?>
                                            <input type="hidden"  name="sportal" value="0" > 
                                            <input type="checkbox"  name="sportal" value="1" >   
                                              
                                            <label for="vehicle1">Settlement Portal</label><?
                                        }
                                        ?><br><?
                                          if ($req_user_info['jportal']=="1")
                                          {
                                      ?>
                                       <input type="hidden"  name="jportal" value="0" > 
                                      <input type="checkbox"  name="jportal" value="1" Checked >
                                       
                                      <?
                                      }  else
                                        {
                                           ?><input type="hidden"  name="jportal" value="0"  >
                                           <input type="checkbox"  name="jportal" value="1"  >
                                           <? 
                                        }
                                        
                                        ?>
  
 
  
  
  <label  >Job Portal</label>
  <br><?
                                          if ($req_user_info['tportal']=="1")
                                          {
                                      ?>
                                       <input type="hidden"  name="tportal" value="0" > 
                                      <input type="checkbox"  name="tportal" value="1" Checked >
                                       
                                      <?
                                      }  else
                                        {
                                           ?><input type="hidden"  name="tportal" value="0"  >
                                           <input type="checkbox"  name="tportal" value="1"  >
                                           <? 
                                        }
                                        
                                        ?>
                                    <label  >Teacher Portal</label><br>
                                
                                <br>
                                


</td></tr>
<tr>
<td>
<b>Assign Support Letter Access:</b><br>
<input type="radio" id="bothsupport" name="support_letter_access" value="both"<?php echo ($req_user_info['support_letter_access'] ?? '') === 'both' ? ' checked' : ''; ?>>
<label for="bothsupport">Both Support Letters</label><br>
<input type="radio" id="accredited" name="support_letter_access" value="aewv"<?php echo ($req_user_info['support_letter_access'] ?? '') === 'aewv' ? ' checked' : ''; ?>>
<label for="accredited">AEWV Support Letter</label><br>
<input type="radio" id="straight" name="support_letter_access" value="SRV"<?php echo ($req_user_info['support_letter_access'] ?? '') === 'SRV' ? ' checked' : ''; ?>>
<label for="straight">SRV Support Letter</label><br>
<br>
</td>
</tr>
<tr> 
<input type="hidden" value="<?echo $req_user_info['email'];?>" name="emailaddress">
<td><input type="Submit" value="Assign"></td>
</tr></table></form>


                                      

  </div>
  <?}
  else
  {
      
  }
  ?></div> 
   <form class="form-horizontal" method="POST" role="form" action="#">
  <div class="form-group">
     
                                                <label for="username" class="col-sm-4 col-md-3 control-label">Username:</label>
                                                <div class="col-sm-5 col-md-5">
                                                    <p class="form-control-static"><?php echo $usertoedit; ?></p>
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label for="status" class="col-sm-4 col-md-3 control-label">Status:</label>
                                                <div class="col-sm-5 col-md-5">
                                                    <p class="form-control-static"><?php echo $adminfunctions->displayStatus($usertoedit); ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="registered" class="col-sm-4 col-md-3 control-label">Registered:</label>
                                                <div class="col-sm-5 col-md-5">
                                                    <p class="form-control-static"><?php echo $adminfunctions->displayDate($req_user_info['regdate']); ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="lastactivedate" class="col-sm-4 col-md-3 control-label">Last Active:</label>
                                                <div class="col-sm-5 col-md-5">
                                                    <p class="form-control-static"><?php echo $adminfunctions->displayDate($req_user_info['timestamp']); ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="registeredfromip" class="col-sm-4 col-md-3 control-label">Registered IP:</label>
                                                <div class="col-sm-5 col-md-5">
                                                    <p class="form-control-static"><?php echo $req_user_info['ip']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="lastactiveip" class="col-sm-4 col-md-3 control-label">Last Active IP:</label>
                                                <div class="col-sm-5 col-md-5">
                                                    <p class="form-control-static"><?php echo $req_user_info['lastip']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="registeredfromip" class="col-sm-4 col-md-3 control-label">First Name:</label>
                                                <div class="col-sm-4 col-md-4">
                                                    <p class="form-control-static"><?php echo $req_user_info['firstname']; ?></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="lastactiveip" class="col-sm-4 col-md-3 control-label">Last Name:</label>
                                                <div class="col-sm-4 col-md-4">
                                                    <p class="form-control-static"><?php echo $req_user_info['lastname']; ?></p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                    <div role="tabpanel" class="tab-pane" id="profile">
                                        <form class="form-horizontal" id="admin-edit-user" method="POST" role="form" action="includes/adminprocess.php">      
                                        <?php echo Csrf::field(); ?>
                                            <div class="form-group">
                                                <div class="col-sm-4 col-md-3 col-lg-3">
                                                </div>                    
                                            </div>
            
                                            <div class="form-group <?php if(Form::error("username")){ echo 'has-error'; } ?>">
                                                <label for="inputUsername" class="col-sm-4 col-md-3 control-label">Username:</label>
                                                <div class="col-sm-4 col-md-4">
                                                    <input name="username" type="text" class="form-control" id="inputUsername" placeholder="Username" value="<?php if(Form::value("username") == ""){ echo $req_user_info['username']; } else { echo Form::value("username"); } ?>">                            
                                                </div>
                                                <div class="col-sm-4">
                                                    <small><?php echo Form::error("username"); ?></small>
                                                </div>
                                            </div>
            
                                            <div class="form-group <?php if(Form::error("firstname")){ echo 'has-error'; } ?> ">
                                                <label for="inputFirstname" class="col-sm-4 col-md-3 control-label">First Name:</label>
                                                <div class="col-sm-4 col-md-4">
                                                    <input type="text" name="firstname" class="form-control" id="inputFirstname" placeholder="First Name" value="<?php if(Form::value("firstname") == ""){ echo $req_user_info['firstname']; } else { echo Form::value("firstname"); } ?>">                             
                                                </div>
                                                <div class="col-sm-4">
                                                    <small><?php echo Form::error("firstname"); ?></small>
                                                </div>
                                            </div>
            
                                            <div class="form-group <?php if(Form::error("lastname")){ echo 'has-error'; } ?>">
                                                <label for="inputLastname" class="col-sm-4 col-md-3 col-lg-3 control-label">Last Name:</label>
                                                <div class="col-sm-4 col-md-4">
                                                    <input type="text" name="lastname" class="form-control" id="inputLastname" placeholder="Last Name" value="<?php if(Form::value("lastname") == ""){ echo $req_user_info['lastname']; } else { echo Form::value("lastname"); }?>">
                                                </div>
                                                <div class="col-sm-4">
                                                    <small><?php echo Form::error("lastname"); ?></small>
                                                </div>
                                            </div>
            
                                            <div class="form-group <?php if(Form::error("newpass")){ echo 'has-error'; } ?>">
                                                <label for="inputPassword" class="col-sm-4 col-md-3 control-label">New Password:</label>
                                                <div class="col-sm-4 col-md-4">
                                                    <input type="password" name="newpass" class="form-control" id="inputPassword" placeholder="New Password">
                                                </div>
                                                <div class="col-sm-4">
                                                    <small><?php echo Form::error("newpass"); ?></small>
                                                </div>
                                            </div>
            
                                            <div class="form-group <?php if(Form::error("conf_newpass")){ echo 'has-error'; } ?>">
                                                <label for="confirmPassword" class="col-sm-4 col-md-3 control-label">Confirm Password:</label>
                                                <div class="col-sm-4 col-md-4">
                                                    <input type="password" name="conf_newpass" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                                                </div>
                                                <div class="col-sm-4">
                                                    <small><?php echo Form::error("conf_newpass"); ?></small>
                                                </div>
                                            </div>
                        
                                            <div class="form-group <?php if(Form::error("email")){ echo 'has-error'; } ?>">
                                                <label for="email" class="col-sm-4 col-md-3 control-label">E-mail:</label>
                                                <div class="col-sm-4 col-md-4">
                                                    <input name="email" type="text" id="email" class="form-control" value="<?php if(Form::value("email") == ""){ echo $req_user_info['email']; }else{ echo Form::value("email"); } ?>">
                                                </div>
                                                <div class="col-sm-4">
                                                    <small><?php echo Form::error("email"); ?></small>
                                                </div>
                                            </div>
            
                                            <p></p>
                                            <div class="form-group">
                                                <div class="col-sm-4 col-md-3"></div>
                                                <div class="col-sm-4 col-md-4">
                                                    <?php echo $adminfunctions->stopField($session->username, 'edit-user'); ?>
                                                    <button type="submit" id="submit" name="button" value="Edit Account" class="btn btn-default"><i class="fas fa-sync-alt"></i> Submit Changes</button>
                                                    <button type="reset" id="reset" name="reset" class="btn btn-primary">Reset </button>
                                                </div>
                                            </div>
                                    
                                            <input type="hidden" name="form_submission" value="edit_user">
                                            <input type="hidden" name="usertoedit" value="<?php echo $usertoedit; ?>">
                                            <input type="hidden" name="usertoeditid" value="<?php echo $req_user_info['id']; ?>">
                                        </form>
                                    </div>
                                    
                                    <div role="tabpanel" class="tab-pane" id="groups">
                                        <form action="includes/adminprocess.php" method="post" class="form-horizontal form-bordered">   
                                        <?php echo Csrf::field(); ?>

                                        <?php
                                        $userid = $req_user_info['id'];
                                        $sql2 = "SELECT group_id FROM users_groups WHERE user_id = '$userid'";
                                        $result2 = $db->prepare($sql2);
                                        $result2->execute();
                                        ?>
                            
                                        <div class="form-group">
                                            <div class="col-sm-4 col-md-3">
                                            </div>                    
                                            <div class="col-sm-4 col-md-4">
                                                <p class="form-control-static">Edit the User's Group Membership</p>
                                                Click the text box below to add the user to more groups...
                                            </div>
                                        </div>
                            
                                        <?php
                                        // Instantiate array incase empty
                                        $group_array = array();
                                        while ($row2 = $result2->fetch()) {
                                            $group_array[] = $row2['group_id'];
                                        } 
                                        ?>
                            
                                        <div class="form-group">
                                            <label class="col-sm-4 col-md-3 control-label" for="edit-group-membership">Current Groups</label>
                                            <div class="col-md-4">
                                                <select id="chosen-select" name="groups[]" data-placeholder="Click Here" class="chosen-select" multiple>
                                                    <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                                    <?php
                                                    $sql = "SELECT * FROM `groups` WHERE group_id != '1'";
                                                    $result = $db->prepare($sql);
                                                    $result->execute();
                                                    while ($row = $result->fetch()) {
                                                        echo "<option value='" . $row['group_id'] . "'";
                                                        if (in_array($row['group_id'], $group_array)) {
                                                        echo " selected ";
                                                        }
                                                        echo ">" . $row['group_name'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                            
                                        <div class="form-group">
                                            <div class="col-sm-4 col-md-3"></div>
                                            <div class="col-sm-4 col-md-4">
                                                <?php echo $adminfunctions->stopField($session->username, 'edit-groups'); ?>
                                                <input type="hidden" name="form_submission" value="edit_group_membership">
                                                <input type="hidden" name="usertoedit" value="<?php echo $usertoedit; ?>">
                                                <button type="submit" id="submit" name="button" value="Change Groups" class="btn btn-default"><i class="fas fa-sync-alt"></i> Submit Changes</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    
                                    
                                    
                                    <div role="tabpanel" class="tab-pane" id="sessions">
                                        <form class="form-horizontal" role="form" action="includes/adminprocess.php" method="POST">
                                        <?php echo Csrf::field(); ?>                                
                                                <table class="table table-striped table-bordered table-hover" id="dataTable3">
                                                    <thead>
                                                        <tr>
                                                            <th><input type="checkbox" class="checkall"></th>
                                                            <th>Last IP Address</th>
                                                            <th>Persistent ?</th>
                                                            <th>Last Update</th>
                                                            <th>Session Expiry</th>                                                        
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $stop2 = $adminfunctions->createStop($session->username, 'delete-sessions');
                                                        $sql = "SELECT * FROM user_sessions WHERE userid = '$userid' ";
                                                        $result = $db->prepare($sql);
                                                        $result->execute();
                                                        while ($row = $result->fetch()) {
                                                            $userid = $row['userid'];
                                                            $id = $row['id'];
                                                            $persist = $row['persistent'];                                                          
                                                            $ipaddress = $row['ipaddress'];
                                                            $timestamp = $adminfunctions->displayDate($row['timestamp']);
                                                            $expires = $adminfunctions->displayDate($row['expires']);

                                                            echo "<tr>"
                                                            . "<td><input name='id[]' type='checkbox' value='" . $id . "' /></td>"
                                                            . "<td>" . $ipaddress . "</td>"
                                                            . "<td>";
                                                            if ($persist == '1') {
                                                                echo "Yes";
                                                            } else {
                                                                echo "No";
                                                            }
                                                            echo "</td>"
                                                            . "<td>" . $timestamp . "</td>"
                                                            . "<td>" . $expires . "</td>"
                                                            . "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <input type="hidden" name="form_submission" value="delete_individual_sessions">
                                                <input type="hidden" name="stop" value="<?php echo $stop2; ?>">
                                                <button type="submit" id="submit" name="submit" class="btn btn-default"><i class="fas fa-times"></i> Delete Selected Sessions</button>
                                            </form>
                                    </div>
                                    
                                    <div role="tabpanel" class="tab-pane" id="logs">
                                        <table class="table table-striped table-bordered table-hover" id="dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Username</th>
                                                        <th>Event / Page Viewed</th>
                                                        <th>Date / Time</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody><?php $userFullname=$req_user_info['firstname'].'&nbsp;'. $req_user_info['lastname']; ?>
                                                    <?php
                                                    $sql = "SELECT * FROM log_table WHERE userid = '$userid' ORDER BY timestamp DESC";
                                                    $result = $db->prepare($sql);
                                                    $result->execute();
                                                    while ($row = $result->fetch()) {

                                                        $username = $functions->getUserInfoSingularFromId('username', $row['userid']);
                                                        $username=$req_user_info['lastname'];
                                                        echo "<tr>";
                                                        echo "<td>$userFullname</td>";
                                                        echo "<td>" . $row['log_operation'] . "</td>";
                                                        echo "<td>" . $adminfunctions->displayDate($row['timestamp']) . "</td>";
                                                        //echo "<td>" . $row['ip'] . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                    </div>
                                    
                                </div>
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
        <?php include('inc/core-scripts.php'); ?>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        <!-- Initialize Form Validation -->
        <script src="js/plugins/formValidation/adminEditFormsValidation.js"></script>
        <script src="js/plugins/formValidation/jquery.validate.js"></script>
        <script>$(function() { FormsValidation.init(); });</script>  
        
        <!-- Chosen JS - https://harvesthq.github.io/chosen/ -->
        <script src="js/plugins/chosen/chosen.js"></script>
        <script>
            $(".chosen-select").chosen({ width: '100%' }); 
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
             

$(document).ready(function() {
    $('#dataTable').DataTable( {
      dom: 'Bfrtip',
        buttons: [
            {
            extend: 'csv',
            filename: 'INZ Settlement Report for Accreditation -<?php echo $req_user_info['firstname']; ?><?php echo $req_user_info['lastname']; ?>'
            },
          {
            extend: 'excel',
            filename: 'INZ Settlement Report for Accreditation - <?php echo $req_user_info['firstname']; ?><?php echo $req_user_info['lastname']; ?>'
            },
          {
            extend: 'pdf',
            filename: 'INZ Settlement Report for Accreditation - <?php echo $req_user_info['firstname']; ?><?php echo $req_user_info['lastname']; ?>'
            }
        ],
               
                  paging: false


    } );
} );
        </script>

    </body>
</html>
<?php
}
?>