
<div style="display:none;"><img src="supportnz.jpg"></div>
<?php 
$cid=$_GET['cid'];

$servername = "localhost";
$username = "workingi_supportDBuser";
$password = "SyTPQ4adjz!^";
$dbname = "workingi_supportalDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cms_category WHERE id='$cid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $categorytitle= $row["name"];
   // echo $categorytitle;
    
    $categorydesc= $row["content"];
  }
} else {
  //echo "0 results";
}
//$conn->close();

if ($cid=="100")
{
    $dispalyc="none";
    ?><a href="settle.php?cid=1"><div style="display:;"><img src="supportnz.jpg" style="width:100%;"></div></a><?
}
elseif ($cid=="110")
{
     $dispalyc="none";
 ?>
 <style>
     .selectedsection {
  background-color: #fff;
  color: #003e7e;
}
 </style>
 <a href="main.php?cid=1"><div style="display:;"><img src="rev.jpg" style="width:100%;"></div></a><?
}

?> <link href="mediabox/mediabox.css" rel="stylesheet">
<script src="mediabox/mediabox.js"></script>


 
        <div class="wrapper" style="display:<?echo $dispalyc;?>">
            <div class="wrapper-box">
                <!-- BEGIN: Side Menu -->
                <nav class="side-nav">
                    <ul>
                       <li>
                            <a href="settle.php?section=welcome&cid=14" class="side-menu <?php echo ($cid == "1" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                                <div class="side-menu__title">
                                   Welcome 
                                 
                                </div>
                            </a>
                        
                        </li>
                    
                        <li class="side-nav__devider my-6" style="display:none;"></li>
                        <li>
                            <a href="main.php?section=yes&cid=10" class="side-menu <?php echo ($cid == "2" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                                <div class="side-menu__title">
                                    Accommodation 
                                 
                                </div>
                            </a>
                            
                        </li>
                        <li>
                            <a href="main.php?section=job&cid=3" class="side-menu <?php echo ($cid == "3" ? "side-menu--active" : "");?>" >
                                <div class="side-menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                                <div class="side-menu__title">
                                    Find a Job 
                                   
                                </div>
                            </a>
                            
                        </li>
                        <li>
                            <a href="main.php?section=yourapp&cid=5" class="side-menu <?php echo ($cid == "5" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                                <div class="side-menu__title">
                                  Your Application
                                
                                </div>
                            </a>
                         
                        </li>
                        
                              <li>
                            <a href="main.php?section=theapp&cid=6" class="side-menu <?php echo ($cid == "6" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                                <div class="side-menu__title">
                                  The Application
                                
                                </div>
                            </a>
                         
                        </li>
                        
                            <li>
                            <a href="main.php?section=support&cid=7" class="side-menu <?php echo ($cid == "7" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                                <div class="side-menu__title">
                                    How We Support Your Application
                                 
                                </div>
                            </a>
                            
                        </li>
                            <li>
                            <a href="main.php?section=tools&cid=8" class="side-menu <?php echo ($cid == "8" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                                <div class="side-menu__title">
                                  Tools
                                
                                </div>
                            </a>
                         
                        </li>
                            <li>
                            <a href="main.php?section=webinars&cid=9" class="side-menu <?php echo ($cid == "9" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                                <div class="side-menu__title">
                                  Upcoming Webinars
                                
                                </div>
                            </a>
                         
                        </li>
                    </ul>
                </nav>
                <!-- END: Side Menu -->
                <!-- BEGIN: Content -->
                <div class="content">
                                            
                     
<?

if ($_GET['viewpage']=="1")
{
?>
<div class='embed-container'>
<?
$pid=$_GET['pid'];
$sqlpostview = "SELECT * FROM cms_posts WHERE id='$pid'";
$resultpostview = $conn->query($sqlpostview);

if ($resultpostview->num_rows > 0) {
 
  while($rowpostview = $resultpostview->fetch_assoc()) {
      $titleview=$rowpostview['title'];
        $longdesc=$rowpostview['longdesc'];
      
  }
}
?>

<span style="font-size:15px;">

   <br>  <h2 class="text-lg font-medium mr-auto" style="color:#003e7e;font-size:25px;">
                           <center><?echo $titleview;?></center>
                        </h2>
                        <br><br>
                        <p><?echo $longdesc;?></p>
                        

</span><br>

 
 </div>
<?if ($cid=="14")
{
?>


   <style>
.embed-container {
  position: relative;
  padding-bottom: 56.25%;
  height: 0;
  overflow: hidden;
  max-width: 100%;
}

.embed-container iframe,
.embed-container object,
.embed-container embed {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
</style>
<br><br>
 <div class='embed-container'>
<p style="font-size:15px;">We’re so happy you’re finally (or almost) here and moments away from enjoying everything your new home has to offer. <br>
To help you get settled, we’ve put together this comprehensive document with all the ins and outs of Kiwi living,<br> 
including getting to know your local community, customs and culture, taxes, and more.</p><br>

 
 </div>
 
 <?}?>
                    
    <?}?>                
                   <br>  <h2 class="text-lg font-medium mr-auto" style="color:#003e7e;font-size:25px;">
                           <center><?echo $categorytitle;?></center>
                        </h2>
                        
                        <div class="intro-y grid grid-cols-12 gap-6 mt-5"> 
                        
                        
                        
            <?php
	    $sqlpost = "SELECT * FROM cms_posts WHERE category_id='$cid'";
$resultpost = $conn->query($sqlpost);

if ($resultpost->num_rows > 0) {
 
  while($rowpost = $resultpost->fetch_assoc()) {
   

			?>
			
	  	     
                        <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
                      
                      
                            <div class="p-5">
                                <div class="h-40 2xl:h-56 image-fit">
                                 <a href="<?echo $rowpost['filename'];?>" class="mediabox rounded-md"><img alt="" class="rounded-md" src="admin/img/<?php echo $rowpost['thumbnail']; ?>"></a>
                                </div>
                                
                                
                                
                                <a href="?viewpage=1&pid=<? echo $rowpost['id'];?>" class="block font-medium text-base mt-5"><?php echo $rowpost['title']; ?> </a> 
                                <div class="text-slate-600 dark:text-slate-500 mt-2"><?php echo $rowpost['message']; ?> </div>
                            </div>
                        
                         
                        </div>	<?  }
} else {
  
} ?> 
                       
                        
                            
                        
                      
                       
                    </div>
                </div>
                <!-- END: Content -->
            </div>
        </div>
<script type="text/javascript">
   MediaBox('.mediabox');
</script>
        
      