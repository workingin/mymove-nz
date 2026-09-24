<?include("admin/includes/controller.php");


if($session->logged_in) {
  

} else {
$form = new Form;
$_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
header("Location: /index.php");
}
$userid=$session->id;
function fixCmsImageWidths($html) {
	if ($html === '' || $html === null) {
		return '';
	}
	// Strip the editor's baked-in width attribute so images scale with .cms-post-content img's max-width:100% instead of being capped at the editor's fixed width.
	$html = preg_replace('/(<img\b[^>]*?)\s+width=(["\']?)\d+\2/i', '$1', $html);
	// Defer offscreen images until they're scrolled into view.
	$html = preg_replace('/<img\b(?![^>]*\bloading=)([^>]*)>/i', '<img loading="lazy"$1>', $html);
	return $html;
}

?> <style>
.cms-post-content img {
	max-width: 100%;
	height: auto;
}
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
 <a href="settlement.php?cid=1"><div style="display:;"><img src="rev.jpg" style="width:100%;"></div></a><?
}

?> <link href="mediabox/mediabox.css" rel="stylesheet">
<script src="mediabox/mediabox.js"></script>


 
        <div class="wrapper" style="display:<?echo $dispalyc;?>">
            <div class="wrapper-box">
                <!-- BEGIN: Side Menu -->
                <nav class="side-nav">
                    <ul>
                       <li>
                            <a href="settlement.php?section=Welcome&cid=14&viewpage=1&pid=44" class="side-menu <?php echo ($cid == "14" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                    <!-- <i data-lucide="star"></i> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="star" data-lucide="star" class="lucide lucide-star">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                    </svg>
                                </div>
                                <div class="side-menu__title">
                                   Welcome
                                 
                                </div>
                            </a>
                        
                        </li>
                    
                    <li>
                            <a href="settlement.php?section=Relocation%20Support%20Partners&cid=37" class="side-menu side-menu--highlight <?php echo ($cid == "37" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                </svg>
                                </div>
                                <div class="side-menu__title">Relocation Support Partners</div>
                            </a>
                         
                        </li>
                        <li class="side-nav__devider my-6" style="display:none;"></li>
                        <li>
                            <a href="settlement.php?section=Accommodation&cid=10" class="side-menu <?php echo ($cid == "10" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon">
                                    <!--<i data-lucide="home"></i>-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="home" data-lucide="home" class="lucide lucide-home"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                </div>
                                <div class="side-menu__title">
                                    Accommodation 
                                 
                                </div>
                            </a>
                            
                        </li>
                        
                       
                        
                           
                        <li>
                            <a href="settlement.php?section=Banking and Finance &cid=12" class="side-menu <?php echo ($cid == "12" ? "side-menu--active" : "");?>" >
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="landmark"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="landmark" data-lucide="landmark" class="lucide lucide-landmark"><line x1="3" y1="22" x2="21" y2="22"></line><line x1="6" y1="18" x2="6" y2="11"></line><line x1="10" y1="18" x2="10" y2="11"></line><line x1="14" y1="18" x2="14" y2="11"></line><line x1="18" y1="18" x2="18" y2="11"></line><polygon points="12 2 20 7 4 7"></polygon></svg>
                                </div>
                                <div class="side-menu__title">
                                   Banking & Finance 
                                   
                                </div>
                            </a>
                            
                        </li>
                        <li>
                            <a href="settlement.php?section=Tax Rates&cid=15" class="side-menu <?php echo ($cid == "15" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="percent"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="percent" data-lucide="percent" class="lucide lucide-percent"><line x1="19" y1="5" x2="5" y2="19"></line><circle cx="6.5" cy="6.5" r="2.5"></circle><circle cx="17.5" cy="17.5" r="2.5"></circle></svg>
                                </div>
                                <div class="side-menu__title">
                                  Tax Rates
                                
                                </div>
                            </a>
                         
                        </li>
                        
                              <li>
                            <a href="settlement.php?section=Transportation&cid=11" class="side-menu <?php echo ($cid == "11" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="car"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="car" data-lucide="car" class="lucide lucide-car"><path d="M14 16H9m10 0h3v-3.15a1 1 0 00-.84-.99L16 11l-2.7-3.6a1 1 0 00-.8-.4H5.24a2 2 0 00-1.8 1.1l-.8 1.63A6 6 0 002 12.42V16h2"></path><circle cx="6.5" cy="16.5" r="2.5"></circle><circle cx="16.5" cy="16.5" r="2.5"></circle></svg>
                                </div>
                                <div class="side-menu__title">
                                  Transportation
                                
                                </div>
                            </a>
                         
                        </li>
                        
                            <li>
                            <a href="settlement.php?section=Living Cost in NZ&cid=17" class="side-menu <?php echo ($cid == "17" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="coins"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="coins" data-lucide="coins" class="lucide lucide-coins"><circle cx="8" cy="8" r="7"></circle><path d="M19.5 9.94a7 7 0 11-9.56 9.56"></path><path d="M7 6h1v4"></path><path d="M17.3 14.3l.7.7-2.8 2.8"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                    Living Cost in NZ
                                 
                                </div>
                            </a>
                            
                        </li>
                            <li>
                            <a href="settlement.php?section=Healthcare and Emergency Services&cid=18" class="side-menu <?php echo ($cid == "18" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="cross"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="cross" data-lucide="cross" class="lucide lucide-cross"><path d="M11 2a2 2 0 00-2 2v5H4a2 2 0 00-2 2v2c0 1.1.9 2 2 2h5v5c0 1.1.9 2 2 2h2a2 2 0 002-2v-5h5a2 2 0 002-2v-2a2 2 0 00-2-2h-5V4a2 2 0 00-2-2h-2z"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                  Healthcare & Emergency Services 
                                
                                </div>
                            </a>
                         
                        </li>
                          <li>
                            <a href="settlement.php?section=Community Groups&cid=19" class="side-menu <?php echo ($cid == "19" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="users"></i>-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="users" data-lucide="users" class="lucide lucide-users"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 00-3-3.87"></path><path d="M16 3.13a4 4 0 010 7.75"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                  Community Groups
                                
                                </div>
                            </a>
                         
                        </li>
                          <li>
                            <a href="settlement.php?section=NZ Culture and Custom&cid=20" class="side-menu <?php echo ($cid == "20" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="palette"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="palette" data-lucide="palette" class="lucide lucide-palette"><circle cx="13.5" cy="6.5" r=".5"></circle><circle cx="17.5" cy="10.5" r=".5"></circle><circle cx="8.5" cy="7.5" r=".5"></circle><circle cx="6.5" cy="12.5" r=".5"></circle><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 011.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                  NZ Culture and Custom
                                
                                </div>
                            </a>
                         
                        </li>
                        <li>
                            <a href="settlement.php?section=NZ Working Culture&cid=21" class="side-menu <?php echo ($cid == "21" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="briefcase"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="briefcase" data-lucide="briefcase" class="lucide lucide-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                  NZ Working Culture
                                
                                </div>
                            </a>
                         
                        </li>
                        <li>
                            <a href="settlement.php?section=New Zealand Climate&cid=22" class="side-menu <?php echo ($cid == "22" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="cloud-sun"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="cloud-sun" data-lucide="cloud-sun" class="lucide lucide-cloud-sun"><path d="M12 2v2"></path><path d="M5.22 5.22l1.42 1.42"></path><path d="M20 12h2"></path><path d="M15.97 12.5A4 4 0 009.5 8.88"></path><path d="M13.63 22A3.3 3.3 0 0017 18.79a3.3 3.3 0 00-3.38-3.22h-1.34A5.23 5.23 0 007.25 12 5.13 5.13 0 002 17c0 2.76 2.35 5 5.25 5h6.38z"></path><path d="M17.36 6.64l1.42-1.42"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                  New Zealand Climate
                                
                                </div>
                            </a>
                         
                        </li>
                          <li>
                            <a href="settlement.php?section=Religion in New Zealand&cid=23" class="side-menu <?php echo ($cid == "23" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="book"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="book" data-lucide="book" class="lucide lucide-book"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                  Religion in New Zealand
                                
                                </div>
                            </a>
                         
                        </li>
                        
                           <!--<li>
                            <a href="settlement.php?section=Refugee Support&cid=24" class="side-menu <?php echo ($cid == "24" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                                <div class="side-menu__title">
                                  Refugee Support
                                
                                </div>
                            </a>
                         
                        </li> -->
                        
                            <!--<li><?php echo ($cid == "14" ? "side-menu--active" : "");?>
                            <a href="settlement.php?section= Upcoming Webinars&cid=9" class="side-menu <?php echo ($cid == "9" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                                <div class="side-menu__title">
                                  Upcoming Webinars
                                
                                </div>
                            </a>
                         
                        </li> -->
                        <!--<li>
                            <a href="settlement.php?section=Relocation Support&cid=35" class="side-menu <?php echo ($cid == "35" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                                <div class="side-menu__title">
                                   Relocation Support
                                 
                                </div>
                            </a>
                            
                        </li>-->
                        <?php if($_SESSION['has_company_documents'] == 1): ?>
                             <li>
                                <a href="settlement.php?section=company_docs&cid=25" class="side-menu <?php echo ($cid == "25" ? "side-menu--active" : "");?>">
                                    <div class="side-menu__icon"> <i data-lucide="file"></i> </div>
                                    <div class="side-menu__title">
                                       Company Documents
                                    </div>
                                </a>
                                
                            </li>
                        <?php endif; ?>
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
