<?php
include("includes/controller.php");
$pagename = 'cms';
$container = '';

if(!$session->isSuperAdmin()){
    header("Location: ".$configs->homePage());
    exit;
}

$categoryId = (isset($_GET['id']) && $_GET['id']) ? (int)$_GET['id'] : 0;

$saveMessage = '';
if(!empty($_POST["categorySave"]) && $_POST["categoryName"] != '') {

	$categoryName = htmlspecialchars(strip_tags($_POST["categoryName"]));

	if($categoryId) {
		$stmt = $db->prepare("UPDATE cms_category SET name = ? WHERE id = ?");
		$stmt->execute([$categoryName, $categoryId]);
	} else {
		$stmt = $db->prepare("INSERT INTO cms_category (name) VALUES (?)");
		$stmt->execute([$categoryName]);
	}

	header("Location: cms-categories.php");
	exit;
}

$categoryDetails = null;
if($categoryId) {
	$stmt = $db->prepare("SELECT id, name FROM cms_category WHERE id = ?");
	$stmt->execute([$categoryId]);
	$categoryDetails = $stmt->fetch();
}
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
                            <a href="cms-categories.php">Categories</a>
                        </li>
                    </ol>
                </div>
                <!-- END Title Header -->

                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Add / Edit Category</h3>
                            </div>
                            <div class="panel-body">

                                <form method="post" id="postForm">
                                    <?php if ($saveMessage != '') { ?>
                                        <div id="login-alert" class="alert alert-success col-sm-12"><?php echo $saveMessage; ?></div>
                                    <?php } ?>

                                    <div class="form-group">
                                        <label for="categoryName" class="control-label">Category Name</label>
                                        <input type="text" required class="form-control" id="categoryName" name="categoryName" value="<?php echo isset($categoryDetails['name']) ? $categoryDetails['name'] : ''; ?>" placeholder="Category name..">
                                    </div>
                                    <input type="submit" name="categorySave" id="categorySave" class="btn btn-info" value="Save" />
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

    </body>
</html>
