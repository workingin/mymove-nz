<?include("admin/includes/controller.php");


if($session->logged_in) {
  

} else {
$form = new Form;
$_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
header("Location: /index.php");
}
$userid=$session->id;


?> <style>

.buttonRead {
  background-color: #8bc147; /* Green */
  border: none;
  color: white;
  padding: 12px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  
  cursor: pointer;
}
.buttonMore {
  background-color: #00953b;
  color: #fff;
  border: 2px solid #00953b;
  margin-bottom:20px;
  border-radius:50px;
}
</style>
<?php
require_once 'header.view.php';
?>
<!--<div style="display:none;"><img src="supportnz.jpg"></div>-->
<?php 
$cid=$_GET['cid'];

$log_operation=$_GET['section'];
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
  $ipaddress = $_SERVER['REMOTE_ADDR'];
        $timestamp = time();
   
 $sqlup =  "INSERT INTO log_table (userid, log_operation, timestamp, ip) VALUES ($userid, '$log_operation','$timestamp', '$ipaddress')";

if ($conn->query($sqlup) === TRUE) {
  
} else {
  echo "Error: " . $sqlup . "<br>" . $conn->error;
}
       
$sql = "SELECT * FROM cms_category WHERE id='$cid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $categorytitle= $row["name"];
   //echo $categorytitle;
    
    $categorydesc= $row["content"];
  }
} else {
  //echo "0 results";
}
//$conn->close();

$dispalyc="block";

if ($cid=="100")
{
    $dispalyc="none";
    ?><a href="settlement.php?cid=1"><!--<div style="display:none;"><img src="supportnz.jpg" style="width:100%;"></div>--></a><?
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
 <a href="teacher.php?cid=39"><div style="display:;"><img src="rev.jpg" style="width:100%;"></div></a><?
}

?> <link href="mediabox/mediabox.css" rel="stylesheet">
<script src="mediabox/mediabox.js"></script>


 
        <div class="wrapper" style="display:<?echo $dispalyc;?>">
            <div class="wrapper-box">
                <!-- BEGIN: Side Menu -->
                <nav class="side-nav">
                    <ul>
                       <li>
                            <a href="/teacher.php?section=Welcome&cid=39" class="side-menu <?php echo ($cid == "39" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                    <!-- <i data-lucide="star"></i> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="package-plus" data-lucide="package-plus" class="lucide lucide-package-plus"><path d="M16 16h6"></path><path d="M19 13v6"></path><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"></path><path d="M16.5 9.4 7.55 4.24"></path><path d="M3.29 7 12 12m0 0 8.71-5M12 12v10"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                   Introduction to the Teachers Pack
                                 
                                </div>
                            </a>
                        
                        </li>
                    
                        <li class="side-nav__devider my-6" style="display:none;"></li>
                        <li>
                            <a href="/teacher.php?section=Documents&cid=40" class="side-menu <?php echo ($cid == "40" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon">
                                    <!--<i data-lucide="home"></i>-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-text" data-lucide="file-text" class="lucide lucide-file-text"><path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><line x1="10" y1="9" x2="8" y2="9"></line></svg>
                                    </div>
                                <div class="side-menu__title">
                                    Documents and Registration 
                                 
                                </div>
                            </a>
                            
                        </li>
                        
                       
                        
                           
                        <li>
                            <a href="/teacher.php?section=Benefits&cid=41" class="side-menu <?php echo ($cid == "41" ? "side-menu--active" : "");?>" >
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="landmark"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="cross" data-lucide="cross" class="lucide lucide-cross"><path d="M11 2a2 2 0 00-2 2v5H4a2 2 0 00-2 2v2c0 1.1.9 2 2 2h5v5c0 1.1.9 2 2 2h2a2 2 0 002-2v-5h5a2 2 0 002-2v-2a2 2 0 00-2-2h-5V4a2 2 0 00-2-2h-2z"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                   Benefits
                                   
                                </div>
                            </a>
                            
                        </li>
                        <li>
                            <a href="/teacher.php?section=The%20NZ%20Education%20System&cid=42" class="side-menu <?php echo ($cid == "42" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="percent"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="graduation-cap" data-lucide="graduation-cap" class="lucide lucide-graduation-cap"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                  The NZ Education System
                                
                                </div>
                            </a>
                         
                        </li>
                        
                              <li>
                            <a href="/teacher.php?section=Job%20Search&cid=43" class="side-menu <?php echo ($cid == "43" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="car"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="briefcase" data-lucide="briefcase" class="lucide lucide-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                  The Job Search
                                
                                </div>
                            </a>
                         
                        </li>
                        
                            <li>
                            <a href="/teacher.php?section=Maori%20Classroom%20Culture&cid=44" class="side-menu <?php echo ($cid == "44" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="coins"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="palette" data-lucide="palette" class="lucide lucide-palette"><circle cx="13.5" cy="6.5" r=".5"></circle><circle cx="17.5" cy="10.5" r=".5"></circle><circle cx="8.5" cy="7.5" r=".5"></circle><circle cx="6.5" cy="12.5" r=".5"></circle><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 011.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                    Māori Culture in the Classroom
                                 
                                </div>
                            </a>
                            
                            <li>
                            <a href="/teacher.php?section=Maori%20Curriculum%20Integration&cid=45" class="side-menu <?php echo ($cid == "45" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="coins"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="book" data-lucide="book" class="lucide lucide-book"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                    Māori Integration into the NZ Curriculum
                                 
                                </div>
                            </a>
                            
                        </li>
                        <li>
                            <a href="/teacher.php?section=Curriculum%201%20to%2013&cid=46" class="side-menu <?php echo ($cid == "46" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="coins"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="book-open" data-lucide="book-open" class="lucide lucide-book-open"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"></path><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                    NZ Curriculum – Primary & Senior School Years (1 – 13)
                                 
                                </div>
                            </a>
                            
                        </li>
                        <li>
                            <a href="https://www2.nzqa.govt.nz/ncea/subjects/past-exams-and-exemplars/" target="_blank" class="side-menu">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="landmark"></i>-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="landmark" data-lucide="landmark" class="lucide lucide-landmark"><line x1="3" y1="22" x2="21" y2="22"></line><line x1="6" y1="18" x2="6" y2="11"></line><line x1="10" y1="18" x2="10" y2="11"></line><line x1="14" y1="18" x2="14" y2="11"></line><line x1="18" y1="18" x2="18" y2="11"></line><polygon points="12 2 20 7 4 7"></polygon></svg>
                                </div>
                                <div class="side-menu__title">
                                    NCEA Exemplars, past examination papers and assessment resource
                                 
                                </div>
                            </a>
                            
                        </li>
                    </ul>
                </nav>
                <!-- END: Side Menu -->
                <!-- BEGIN: Content -->
                <div class="content">
                                            
                     

<?

if (isset($_GET['viewpage'])=="1")
{

?>
<div class='embed-container'>
<?
global $pid;
global $titleview;
global $longdesc;

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

   <br>  <h2 class="text-lg font-medium mr-auto" style="font-family:helveticanow-bold; color:#303998;font-size:25px;">
                           <?echo $titleview;?>
                        </h2>
                        <br>
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
  /*overflow: hidden;*/
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
<p style="font-size:15px;"></p><br>

 
 </div>
 
 <?}?>
                    
    <?}?>                    
                   <div class="intro-y grid grid-cols-12 gap-6 mt-5"> 
                        

                        
            <?php
            
           if ($log_operation=="company_docs")
           {
                $usergr= $session->username;
                 $sqlgr = "SELECT * FROM users WHERE username='$usergr' ";
                                            $resultgr = $db->prepare($sqlgr);
                                            $resultgr->execute();
                                            while ($rowgr = $resultgr->fetch()) {
                                                
                                                $groupid = $rowgr['groupid'];

                                                                                        }
                                                                                        
                           $sql = "SELECT * FROM uploadedfiles WHERE user_id='$groupid' ";
                                            $result = $db->prepare($sql);
                                            $result->execute();
                                            while ($row = $result->fetch()) {                                                             
               
              ?>
               <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
                          
                      
                            <div class="p-5" style="text-align:center;" >
                                <div>
                                 <a href="admin/upload/uploads/<?echo $filename = $row['filename']; ?>" target='_blank'>
                                     <center><img src="/filesys.jpg"></center>
                                     </a>
                                </div>
                                <a href="admin/upload/uploads/<?echo $filename = $row['filename']; ?>" target='_blank' style="font-weight:bold;font-size:15px;"><?echo $row['file_title']; ?></a>
                                
                              
                            </div>
                     
                         
                        </div>
              <?
           }
           }
           
           else
           {
           
           
$sqlpost = "SELECT * FROM cms_posts WHERE category_id='$cid'";
$resultpost = $conn->query($sqlpost);


if (isset($_GET['viewpage'])=="1"){
    if ($resultpost->num_rows > 1) {
 
  while($rowpost = $resultpost->fetch_assoc()) {
   
                if ($rowpost['id'] != $_GET['pid']) {
                
			?>
			
	  	     
                        <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
                          
                      <!-- style 'style="height:370px;"' removed -->
                            <div class="p-5">
                                <!-- class 'h-40 2xl:h-56' removed -->
                                <div class="image-fit">
                                 <a  href="?section=<?php echo $rowpost['title']; ?>&cid=<?php echo $_GET['cid']; ?>&pid=<?php echo $rowpost['id']; ?>&viewpage=1" class="end rounded-md"><img alt="" class="rounded-md" src="/admin/img/<?php echo $rowpost['thumbnail']; ?>"></a>
                                </div>
                                
                                
                                
                                <a href="?section=<?php echo $rowpost['title']; ?>&cid=<?php echo $_GET['cid']; ?>&pid=<?php echo $rowpost['id']; ?>&viewpage=1" class="block font-medium text-base mt-5"><?php echo $rowpost['title']; ?> </a> 
                                <div class="text-slate-600 dark:text-slate-500 mt-2">
                                <?
                               
                                $message = implode(" ", explode(" ",  $rowpost['message'], 20));
                                echo $message;?> </div>
                            
                            </div>
                          <div style="margin-top:0px;margin-left: 21px;"> <button onclick="location.replace('?section=<?php echo $rowpost['title']; ?>&cid=<?php echo $_GET['cid']; ?>&pid=<?php echo $rowpost['id']; ?>&viewpage=1')"   class="buttonRead buttonMore">Read More</button></div> 
                         
                        </div>	<?
                    
                }
    }
}
    
} else if ($resultpost->num_rows == 1) {
    ?> <p>here</p> <?
    while($rowpost = $resultpost->fetch_assoc()) {
			?>
			<p>here</p>
			<script>
			window.location.replace("?section=<?php echo $rowpost['title']; ?>&cid=<?php echo $_GET['cid']; ?>&pid=<?php echo $rowpost['id']; ?>&viewpage=1");
			</script>
			<?  }
} else if ($resultpost->num_rows > 0) {
 
  while($rowpost = $resultpost->fetch_assoc()) {
            

			?>
			
	  	     
                        <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
                          
                      <!-- style 'style="height:370px;"' removed -->
                            <div class="p-5">
                                <!-- class 'h-40 2xl:h-56' removed -->
                                <div class="image-fit">
                                 <a  href="?section=<?php echo $rowpost['title']; ?>&cid=<?php echo $_GET['cid']; ?>&pid=<?php echo $rowpost['id']; ?>&viewpage=1" class="end rounded-md"><img alt="" class="rounded-md" src="/admin/img/<?php echo $rowpost['thumbnail']; ?>"></a>
                                </div>
                                
                                
                                
                                <a href="?section=<?php echo $rowpost['title']; ?>&cid=<?php echo $_GET['cid']; ?>&pid=<?php echo $rowpost['id']; ?>&viewpage=1" class="block font-medium text-base mt-5"><?php echo $rowpost['title']; ?> </a> 
                                <div class="text-slate-600 dark:text-slate-500 mt-2">
                                <?
                               
                                $message = implode(" ", explode(" ",  $rowpost['message'], 20));
                                echo $message;?> </div>
                            
                            </div>
                          <div style="margin-top:0px;margin-left: 21px;"> <button onclick="location.replace('?section=<?php echo $rowpost['title']; ?>&cid=<?php echo $_GET['cid']; ?>&pid=<?php echo $rowpost['id']; ?>&viewpage=1')"   class="buttonRead buttonMore">Read More</button></div> 
                         
                        </div>	<?  
  }
}
 



}
?> 
                       
                        
                            
                        
                      
                       
                    </div>
                </div>
                <!-- END: Content -->
            </div>
        </div>
<script type="text/javascript">
   MediaBox('.mediabox');
</script>
        
      
<?
require_once 'footer.view.php';
