<?include("admin/includes/controller.php");

if (!isset($_GET['user'])) { 
    header("Location: ".$configs->loginPage());
} else if (strtolower($_GET['user']) == strtolower(ADMIN_NAME)) {
    header("Location: ".$configs->loginPage());
}

?>
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
$conn->set_charset("utf8mb4");
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
    ?><a href="main.php?cid=1"><div style="display:;"><img src="supportnz.jpg" style="width:100%;"></div></a><?
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
                            <a href="main.php?section=welcome&cid=1" class="side-menu <?php echo ($cid == "1" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                                <div class="side-menu__title">
                                   Welcome 
                                 
                                </div>
                            </a>
                        
                        </li>
                    
                        <li class="side-nav__devider my-6" style="display:none;"></li>
                        <li>
                            <a href="main.php?section=yes&cid=2" class="side-menu <?php echo ($cid == "2" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="tv"></i> </div>
                                <div class="side-menu__title">
                                    Your Employment Strategy 
                                 
                                </div>
                            </a>
                            
                        </li>
                        <li>
                            <a href="main.php?section=job&cid=3" class="side-menu <?php echo ($cid == "3" ? "side-menu--active" : "");?>" >
                                <div class="side-menu__icon"> <i data-lucide="tv"></i> </div>
                                <div class="side-menu__title">
                                    Find a Job 
                                   
                                </div>
                            </a>
                            
                        </li>
                        <li>
                            <a href="main.php?section=yourapp&cid=5" class="side-menu <?php echo ($cid == "5" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="tv"></i> </div>
                                <div class="side-menu__title">
                                  Your Application
                                
                                </div>
                            </a>
                         
                        </li>
                        
                              <li>
                            <a href="main.php?section=theapp&cid=6" class="side-menu <?php echo ($cid == "6" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="tv"></i> </div>
                                <div class="side-menu__title">
                                  The Application
                                
                                </div>
                            </a>
                         
                        </li>
                        
                            <li>
                            <a href="main.php?section=support&cid=7" class="side-menu <?php echo ($cid == "7" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="tv"></i> </div>
                                <div class="side-menu__title">
                                    How We Support Your Application
                                 
                                </div>
                            </a>
                            
                        </li>
                            <li>
                            <a href="main.php?section=tools&cid=8" class="side-menu <?php echo ($cid == "8" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="tv"></i> </div>
                                <div class="side-menu__title">
                                  Tools
                                
                                </div>
                            </a>
                         
                        </li>
                            <li>
                            <a href="main.php?section=webinars&cid=9" class="side-menu <?php echo ($cid == "9" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="tv"></i> </div>
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
                                            
                     

<br>  <h2 class="text-lg font-medium mr-auto" style="color:#003e7e;font-size:25px;">
                           <center><?echo $categorytitle;?></center>
                        </h2>
                         <div class="text-slate-600 dark:text-slate-500 mt-2" style="display:none; width:90%;margin: auto;text-align: center;padding-top: 9px;"><?echo $categorydesc;?><br><br></div>
<?if ($cid=="1")
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
 <div class='embed-container'><iframe src='https://player.vimeo.com/video/699248707?h=c53c470728&title=0&byline=0&portrait=0' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
                    
    <?}?>                
                   <div class="intro-y grid grid-cols-12 gap-6 mt-5"> 
                        
                        
                        
            <?php
	    $sqlpost = "SELECT * FROM cms_posts WHERE category_id='$cid'";
$resultpost = $conn->query($sqlpost);

if ($resultpost->num_rows > 0) {
 
  while($rowpost = $resultpost->fetch_assoc()) {
   

			?>
			
	  	     
                        <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
                               <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-4">
                                <div class="w-10 h-10 flex-none image-fit">
                                    
                                    <img alt="" class="rounded-full" src="dist/images/profile-3.jpg">
                                </div>
                                <div class="ml-3 mr-auto">
                                    <a href="" class="font-medium">Pat Vinay</a> 
                                    <div class="flex text-slate-500 truncate text-xs mt-0.5">Commercial Manager Recruitment</div>
                                </div>
                                
                            </div>
                      
                            <div class="p-5">
                                <div class="h-40 2xl:h-56 image-fit">
                                 <a href="<?echo $rowpost['filename'];?>" class="mediabox rounded-md"><img alt="" class="rounded-md" src="/admin/img/<?php echo $rowpost['thumbnail']; ?>"></a>
                                </div>
                                
                                
                                
                                <a href="" class="block font-medium text-base mt-5"><?php echo $rowpost['title']; ?> </a> 
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
        
      