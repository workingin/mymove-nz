<?php
if(!$session->isAdmin()){
    header("Location: ".$configs->homePage());
    exit;
}
?>
<!-- Top Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
    <a class="close-sidebar btn btn-main" href="#"><i class="fas fa-bars"></i> </a>
   
    <a href="logout.php?path=admin" class="navbar-top-icons btn btn-main" data-original-title="Logout" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-power-off"></i> </a>
    <!-- Settings -->
    <div class="btn-group pull-right">
     <?php
                                                             if ($session->isSuperAdmin()){?>     <button type="button" class="btn btn-main navbar-top-icons dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
      <ul class="dropdown-menu animated fadeIn" role="menu">
            <li class="dropdown-header">Settings</li>
            <li><a href="configurations.php"><i class="fas fa-cog"></i> General Settings</a></li>
            <li><a href="registration.php"><i class="fas fa-envelope"></i> Registration Settings</a></li>
            <li><a href="session-settings.php"><i class="fas fa-globe"></i> Session Settings</a></li>
            <li><a href="security.php"><i class="fas fa-lock"></i> Security Settings</a></li>
            <li><a href="user-settings.php"><i class="fas fa-user"></i> User Settings</a></li>
        </ul><?}?>
    </div>
    <!-- User -->
    <div class="btn-group pull-right">
        <button type="button" class="btn btn-main navbar-top-icons dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user"></i>
        </button>
        <ul class="dropdown-menu profile-dropdown animated fadeIn" role="menu">
            <li class="dropdown-header"><?php echo $session->username; ?></li>
            <li><a href="adminuseredit.php?usertoedit=<?php echo $session->username; ?>"><i class="fas fa-user"></i>Profile</a></li>
            <li><a href="logout.php?path=admin"><i class="fas fa-power-off"></i>Log Out</a></li>
        </ul>
    </div>
   <div id="toggle">
        <a id="btn-fullscreen" class="navbar-top-icons btn btn-main hidden-xs" data-original-title="Fullscreen" data-toggle="tooltip" data-placement="bottom" href="#"><i id="toggle" class="fas fa-arrows-alt"></i> </a>
    </div>     
    <div id="toggle">
        <a  style="width:170px;" class="navbar-top-icons btn btn-main" data-original-title="View teacher portal" data-toggle="tooltip" data-placement="bottom" target="_blank" href="/teacher.php?section=Welcome&cid=39&viewpage=1&pid=127">View Teacher Portal </a>
    </div>
    <div id="toggle">
        <a  style="width:170px;" class="navbar-top-icons btn btn-main" data-original-title="View settlement portal" data-toggle="tooltip" data-placement="bottom" target="_blank" href="/settlement.php?section=Welcome&cid=14&viewpage=1&pid=44">View Settlement Portal </a>
    </div>  
    <div id="toggle">
        <a  style="width:170px;" class="navbar-top-icons btn btn-main" data-original-title="View employment portal" data-toggle="tooltip" data-placement="bottom" target="_blank" href="/main.php?section=welcome&cid=1">View Employment Portal </a>
    </div>
</nav> 
<?php include __DIR__ . '/includes/flash_messages.php'; ?>
<!-- END Top Navbar -->

