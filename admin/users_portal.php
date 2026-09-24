<?php
include_once 'config/Database.php';
include_once 'class/User.php';
include_once 'class/Post.php';
include_once 'class/Category.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$post = new Post($db);
$category = new Category($db);

if(!$user->loggedIn()) {
	header("location: index.php");
}


include('inc/header.php');
?>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/users.js"></script>	
<link href="css/style.css" rel="stylesheet" type="text/css" >  
</head>
<body>
<?php include "menus.php"; ?>

<header id="header">
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Manage Your Site</small></h1>
			</div>
			<br>			
		</div>
	</div>
</header>
<br>

<section id="main">
	<div class="container">
		<div class="row">
			<?php include "left_menus.php"; ?>
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading"style="background-color:  #095f59;>
						<h3 class="panel-title">Latest Users</h3>
					</div>
						<div class="panel-body"><?
						if ($_GET['useradded']=="1")
						{
						   echo "<center><span style=color:green>User has been added</span></center>";
						}
						
						?><br>
						<form method="post" action="process_addstud.php">
	<table width="400" border="0" cellspacing="1" cellpadding="2" align="center">
		
		<th colspan="2" align="left">Add Portal User</h2>
		<tr>
			<td width="100">First Name</td>
			<td><input name="f_name" type="text" id="f_name"></td>
		</tr>
		<tr>
			<td width="100">Last Name</td>
			<td><input name="l_name" type="text" id="l_name"></td>
		</tr>
		<tr>
			<td width="100">Email</td>
			<td><input name="email" type="text" id="email"></td>
		</tr>
		<tr>
			<td width="100">Default Password</td>
			<td><input name="password" type="text" id="contact" value="Winz110" disabled ></td>
		</tr>
			<td width="100"> </td>
			<td>
			<input name="save" type="submit" id="save" value="Add User">
			</td>
		</tr>
	</table>
</form>
						</div>
					<div class="panel-body" style="display:none;">
						<div class="panel-heading">
							<div class="row" >
								<div class="col-md-10" style="display:none;"> 
									<h3 class="panel-title"></h3>
								</div>
								<div class="col-md-2" align="right">
									<a href="add_users.php" class="btn btn-default btn-xs">Add New</a>				
								</div>
							</div>
						</div>
						<table id="userList" class="table table-bordered table-striped" style="display:none;">
							<thead>
								<tr>
									<th>Name</th>									
									<th>Email</th>
									<th>Type</th>	
									<th>Status</th>																				
									<th></th>
									<th></th>	
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


 <?php include('inc/footer.php');?>
