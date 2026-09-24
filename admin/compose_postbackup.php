<?php

include_once 'config/Database.php';
include_once 'class/User.php';
include_once 'class/Post.php';
include_once 'class/Category.php';

$admincms=$_GET['admincms'];

$container = '';
if ($admincms !=="cmsadmin")
{
    header("Location: login.php");
    exit;
}
else
{
$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$post = new Post($db);
$category = new Category($db);


$post = new Post($db);

$categories = $post->getCategories();

$post->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';
$saveMessage = '';
if(!empty($_POST["savePost"]) && $_POST["title"]!=''&& $_POST["message"]!='') {
    
    
    $target_dir = "img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
//if (file_exists($target_file)) {
//  echo "Sorry, file already exists. Please change the image file name.";
//  $uploadOk = 0;
 // exit;
//}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
   // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    $thumbnail=htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
  } else {
    //echo "Sorry, there was an error uploading your file.";
  }
}


if ($thumbnail=="")
{
    $thumbnail= $_POST["thumbnail2"];
}
else
{
  //  $thumbnail= $thumbnail;
}
//exit;
    
	$post->title = $_POST["title"];
	$post->message = $_POST["message"];
	$post->longdesc = $_POST["longdesc"];
	$post->filename = $_POST["filename"];
	$post->thumbnail = $thumbnail;
	$post->author_id = $author_id;
	$post->category = $_POST["category"];
	$post->status = $_POST["status"];	 	
	if($post->id) {	
		$post->updated = date('Y-m-d H:i:s');
		if($post->update()) {
			$saveMessage = "Post updated successfully!";
			 header("Location: cms.php");
		}
	} else {
		$post->userid = "1";
		$post->created = date('Y-m-d H:i:s'); 
		$post->updated = date('Y-m-d H:i:s'); 	
		$lastInserId = $post->insert();
		if($lastInserId) {
			$post->id = $lastInserId;
			$saveMessage = "Post saved successfully!";
			 header("Location: cms.php");
			
		}
	}
}

$postdetails = $post->getPost();
 
include('inc/header.php');
?>

<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/posts.js"></script>	
<link href="css/style.css" rel="stylesheet" type="text/css" >  
<script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<!--<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>-->
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	nicEditors.allTextAreas({ uploadURI: 'nicUpload.php?admincms=cmsadmin' });
});
</script>						
</head>
<body>


<section id="main">
	<div class="container">
		<div class="row">	
		
			<div class="col-md-9">
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title">Add/Update New Post</h3> 	<input type="button" style="float:right;color:red;" value="X Cancel" onclick="location.href='cms.php'";  >
				  </div>
				  <div class="panel-body">
				  
					<form method="post" id="postForm" enctype="multipart/form-data">							
						<?php if ($saveMessage != '') { ?>
							<div id="login-alert" class="alert alert-success col-sm-12"><?php echo $saveMessage; ?></div>                            
						<?php } ?>
						<div class="form-group">
							<label for="title" class="control-label">Title</label>
							<input type="text" class="form-control" id="title" name="title" value="<?php echo $postdetails['title']; ?>" placeholder="Post title..">	
							  <input type="hidden" value="cmsadmin" name="admincms">
						</div>
						
						<div class="form-group">
							<label for="lastname" class="control-label">Short Description</label>							
							<textarea class="form-control" rows="5" id="message" name="message" placeholder="Short description"><?php echo $postdetails['message']; ?></textarea>					
						</div>	
                        	<div class="form-group">
							<label for="lastname" class="control-label">Long Description</label>							
							<textarea class="form-control" rows="5" id="message" name="longdesc" placeholder="Long Description"><?php echo $postdetails['longdesc']; ?></textarea>					
						</div>	

							<div class="form-group">
							<label for="lastname" class="control-label">Vimeo URL OR PDF File URL for Download</label>							
							<textarea class="form-control" rows="5" id="filename" name="filename" placeholder="File Name/Vimeo URL.."><?php echo $postdetails['filename']; ?></textarea>					
						</div>	
							<div class="form-group">
							<label for="lastname" class="control-label">Image for Post</label>							
							<input type="file" name="fileToUpload" id="fileToUpload"><br>
							<input type="hidden" value="<?php echo $postdetails['thumbnail']; ?>" name="thumbnail2">
							<img src="img/<?php echo $postdetails['thumbnail']; ?>" style="width:200px;">
						</div>	
						  
						
						
						
						<div class="form-group">
							<label for="sel1">Category</label>
							<select class="form-control" id="category" name="category">
							<?php
							while ($category = $categories->fetch_assoc()) {
								$selected = '';
								if($category['name'] ==$postdetails['name']) {
									$selected = 'selected=selected';
								}									
								echo "<option value='".$category['id']."' $selected>".$category['name']."</option>";
							}
							?>							
							</select>
						</div>	
						
						<div class="form-group">
							<label for="sel1">Users</label>
							<select class="form-control" id="user" name="author_id">
							<option value="5" selected="selected">Pat Vinay</option>
							<option value="6">Nassim Lalehzari</option>
							<option value="4">Zinny Cheng</option>
							<option value="7">Paul Goddard</option>
							<option value="8">Jo Bradshaw</option>
							</select>
						</div>
						
						<div class="form-group">
							<label for="status" class="control-label"></label>							
							<label class="radio-inline">
								<input type="radio" name="status" id="publish" value="published" <?php if($postdetails['status'] == 'published') { echo "checked";} ?>>Publish
							</label>
							<label class="radio-inline">
								<input type="radio" name="status" id="draft" value="draft" <?php if($postdetails['status'] == 'draft') { echo "checked";} ?>>Draft
							</label>
							<label class="radio-inline">
								<input type="radio" name="status" id="archived" value="archived" <?php if($postdetails['status'] == 'archived') { echo "checked";} ?>>Archive
							</label>							
						</div>				
					
						
						<input type="submit" name="savePost" id="savePost" class="btn btn-info" value="Save" />			<input type="button" value="Cancel" onclick="location.href='cms.php'";  >									
					</form>				
				  </div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include('inc/footer.php');
}
?>
