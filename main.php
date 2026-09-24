<?include("admin/includes/controller.php");


if($session->logged_in) {
  

} else {
$form = new Form;
header("Location: /index.php");
}
$userid=$session->id;

function fixCmsContentPaths($html) {
	if ($html === '' || $html === null) {
		return '';
	}
	$html = preg_replace(
		'/(<img\b[^>]*\bsrc=(["\']))(?!https?:|\/\/|\/)(img\/)/i',
		'$1/admin/$3',
		$html
	);
	// Strip the editor's baked-in width attribute so images scale with .cms-post-content img's max-width:100% instead of being capped at the editor's fixed width.
	$html = preg_replace('/(<img\b[^>]*?)\s+width=(["\']?)\d+\2/i', '$1', $html);
	// Defer offscreen images until they're scrolled into view.
	$html = preg_replace('/<img\b(?![^>]*\bloading=)([^>]*)>/i', '<img loading="lazy"$1>', $html);
	return $html;
}

?>
<?php
require_once 'header.view.php';
?>
<style>
.cms-post-content img {
	max-width: 100%;
	height: auto;
}
</style>
<div style="display:none;"><img src="supportnz.jpg"></div>
<?php 
$cid = isset($_GET['cid']) ? trim($_GET['cid']) : '';
$log_operation = isset($_GET['section']) ? trim($_GET['section']) : '';

$ipaddress = $_SERVER['REMOTE_ADDR'];
$timestamp = time();

$stmtup = $db->prepare("INSERT INTO log_table (userid, log_operation, timestamp, ip) VALUES (?, ?, ?, ?)");
$stmtup->execute([$userid, $log_operation, $timestamp, $ipaddress]);

$stmt = $db->prepare("SELECT * FROM cms_category WHERE id = ?");
$stmt->execute([$cid]);
$result = $stmt;

$row = $result->fetch(PDO::FETCH_ASSOC);
if ($row) {
    $categorytitle = htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8');
    $categorydesc  = htmlspecialchars($row["content"], ENT_QUOTES, 'UTF-8');
}
//$conn->close();

if ($cid=="100")
{
    $dispalyc="none";
    ?><a href="?cid=1"><div style="display:;"><img src="supportnz.jpg" style="width:100%;"></div></a><?
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
 <a href="?cid=1"><div style="display:;"><img src="rev.jpg" style="width:100%;"></div></a><?
}

?> <link href="mediabox/mediabox.css" rel="stylesheet">
<script src="mediabox/mediabox.js"></script>

<?
$username1 = $session->username;
$stmtuser = $db->prepare("SELECT * FROM users WHERE username = ?");
$stmtuser->execute([$username1]);
$rowuser = $stmtuser->fetch(PDO::FETCH_ASSOC);
if ($rowuser) {
    $firstname = htmlspecialchars($rowuser['firstname'], ENT_QUOTES, 'UTF-8');
    $lastname  = htmlspecialchars($rowuser['lastname'], ENT_QUOTES, 'UTF-8');
    $middle    = " ";
    $supportLetterAccess = $rowuser['support_letter_access'] ?? null;
    if ($supportLetterAccess === 'both') {
        $allowedSupportLetterVisaTypes = array('Accredited Employer Work Visa', 'Straight to Residence Visa');
    } elseif ($supportLetterAccess === 'aewv') {
        $allowedSupportLetterVisaTypes = array('Accredited Employer Work Visa');
    } elseif ($supportLetterAccess === 'SRV') {
        $allowedSupportLetterVisaTypes = array('Straight to Residence Visa');
    } else {
        $allowedSupportLetterVisaTypes = array();
    }
} else {
    $allowedSupportLetterVisaTypes = array();
}
?>
 
        <div class="wrapper" style="display:<?echo $dispalyc;?>">
            <div class="wrapper-box">
                <!-- BEGIN: Side Menu -->
                <nav class="side-nav">
                    <ul>
                       <li>
                            <a href="?section=Welcome&cid=1" class="side-menu <?php echo ($cid == "1" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="home"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="home" data-lucide="home" class="lucide lucide-home"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                </div>
                                <div class="side-menu__title">
                                   Welcome
                                 
                                </div>
                            </a>
                        
                        </li>
                    
                        <li class="side-nav__devider my-6" style="display:none;"></li>
                        <li>
                            <a href="?section=Find a Job in NZ&cid=26" class="side-menu <?php echo ($cid == "26" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="briefcase-search"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="briefcase-search" data-lucide="briefcase-search" class="lucide lucide-briefcase-search"><path d="M10 2h4"></path><path d="M20 13V7a2 2 0 0 0-2-2h-3.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 11.93 2H8a2 2 0 0 0-2 2v11"></path><circle cx="18" cy="18" r="3"></circle><path d="M18 16.5V21"></path><path d="m21.6 21.6-2.1-2.1"></path><path d="M6 13a2 2 0 0 0 2 2h3"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                    Find a Job in NZ 
                                 
                                </div>
                            </a>
                            
                        </li>
                 
                        <li>
                            <a href="?section=Your Application&cid=27" class="side-menu <?php echo ($cid == "27" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="clipboard-list"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="clipboard-list" data-lucide="clipboard-list" class="lucide lucide-clipboard-list"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><path d="M12 11h4"></path><path d="M12 16h4"></path><path d="M8 11h.01"></path><path d="M8 16h.01"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                  Your Application
                                
                                </div>
                            </a>
                         
                        </li>
                        
                              <li>
                            <a href="?section=The Interview&cid=28" class="side-menu <?php echo ($cid == "28" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="mic"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="mic" data-lucide="mic" class="lucide lucide-mic"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"></path><path d="M19 10v2a7 7 0 0 1-14 0v-2"></path><line x1="12" x2="12" y1="19" y2="22"></line></svg>
                                </div>
                                <div class="side-menu__title">
                                  The Interview
                                
                                </div>
                            </a>
                         
                        </li>
                         <!--<li>
                            <a href="?section=Engagement Form&cid=eef" class="side-menu <?php echo ($cid == "eef" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="tv"></i> </div>
                                <div class="side-menu__title">
                                  Employer Engagement Form
                                
                                </div>
                            </a>
                         
                        </li>
                         <li>
                            <a href="?section=I Have Received a Job Offer&cid=joffer" class="side-menu <?php echo ($cid == "joffer" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="tv"></i> </div>
                                <div class="side-menu__title">
                                  I have Received a Job Offer
                                
                                </div>
                            </a>
                         
                        </li>-->
                        <li>
                            <a href="?section=Testimonials&cid=47" class="side-menu <?php echo ($cid == "47" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="file-pen"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-pen" data-lucide="file-pen" class="lucide lucide-file-pen"><path d="M12.5 22H18a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v9.5"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M13.378 15.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                    CV and Cover Letter Support
                                 
                                </div>
                            </a>
                            
                        </li>
                        <li>
                            <a href="?section=Industry Hubs&cid=49" class="side-menu <?php echo ($cid == "49" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="building-2"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="building-2" data-lucide="building-2" class="lucide lucide-building-2"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                Industry Hubs
                                </div>
                            </a>
                            
                        </li>
                            <li>
                            <a href="?section=Testimonials&cid=30" class="side-menu <?php echo ($cid == "30" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="quote"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="quote" data-lucide="quote" class="lucide lucide-quote"><path d="M16 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"></path><path d="M5 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                    Testimonials
                                 
                                </div>
                            </a>
                            
                        </li>
                           
                            <li>
                            <a href="?section=Forms / Contact Us&cid=33" class="side-menu <?php echo ($cid == "33" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="mail"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="mail" data-lucide="mail" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                  Forms / Contact Us
                                
                                </div>
                            </a>
                         
                        </li>
                        
                           <!-- <li>
                            <a href="https://jobsadmin.workingin.com/htpd/?cname=<?//echo $firstname.$middle.$lastname?>" target="_blank" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="file"></i> </div>
                                <div class="side-menu__title">
                                 Download Support Letter
                                
                                </div>
                            </a>
                         
                        </li> -->
                        
                        <li>
                            <a href="?section=Download Support Letter&cid=36" class="side-menu <?php echo ($cid == "36" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="file-down"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-down" data-lucide="file-down" class="lucide lucide-file-down"><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M4 5a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h6"></path><path d="M12 18v-6"></path><path d="m9 15 3 3 3-3"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                 Download Support Letter
                                
                                </div>
                            </a>
                         
                        </li>
                        
                        <li>
                            <a href="https://portal.mymove.nz/downloads/NZ-Job-Application-Tracker.xlsx" target="_blank" class="side-menu">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="table-2"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="table-2" data-lucide="table-2" class="lucide lucide-table-2"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                 Job application tracking sheet template
                                
                                </div>
                            </a>
                         
                        </li>
                        
                        <li>
                            <a href="https://portal.mymove.nz/downloads/WINZ-Visiting-NZ-Strategy.pdf" target="_blank" class="side-menu">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="map"></i>-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="map" data-lucide="map" class="lucide lucide-map"><path d="M14.106 5.553a2 2 0 0 0 1.788 0l3.659-1.83A1 1 0 0 1 21 4.619v12.764a1 1 0 0 1-.553.894l-4.553 2.277a2 2 0 0 1-1.788 0l-4.212-2.106a2 2 0 0 0-1.788 0l-3.659 1.83A1 1 0 0 1 3 19.381V6.618a1 1 0 0 1 .553-.894l4.553-2.277a2 2 0 0 1 1.788 0z"></path><path d="M15 5.764v15"></path><path d="M9 3.236v15"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                 Guide for visiting NZ to look for work
                                
                                </div>
                            </a>
                         
                        </li>
                        
                        <li>
                            <a href="?section=Frequently Asked Questions&cid=38" class="side-menu <?php echo ($cid == "38" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> 
                                <!--<i data-lucide="circle-help"></i>-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="circle-help" data-lucide="circle-help" class="lucide lucide-circle-help"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><path d="M12 17h.01"></path></svg>
                                </div>
                                <div class="side-menu__title">
                                 Frequently Asked Questions
                                
                                </div>
                            </a>
                         
                        </li>
                        
                        <!--; <li>
                            <a href="?section=Upcoming Webinars&cid=9" class="side-menu <?php echo ($cid == "9" ? "side-menu--active" : "");?>">
                                <div class="side-menu__icon"> <i data-lucide="tv"></i> </div>
                                <div class="side-menu__title">
                                  Upcoming Webinars
                                
                                </div>
                            </a>
                         
                        </li> -->
                    </ul>
                </nav>
                <!-- END: Side Menu -->
                <!-- BEGIN: Content -->
                <div class="content">
                    

<!-- Display articles start -->
<style>
    iframe {
    background-image: url("spinner.gif");
    background-repeat: no-repeat;
      background-attachment: fixed;
  background-position: center;
  background-position: top;

   }
   .hs-form-frame iframe {
    background-image: none;
   }</style>
<?

if (isset($_GET['viewpage']) && $_GET['viewpage'] == "1")
{

?>
<div class="cms-post-content">
<?
global $pid;
global $titleview;
global $longdesc;

$pid = isset($_GET['pid']) ? trim($_GET['pid']) : '';

$stmtpostview = $db->prepare("SELECT * FROM cms_posts WHERE id = ?");
$stmtpostview->execute([$pid]);
$rowpostview = $stmtpostview->fetch(PDO::FETCH_ASSOC);
if ($rowpostview) {
    $titleview = htmlspecialchars($rowpostview['title'], ENT_QUOTES, 'UTF-8');
    $longdesc  = $rowpostview['longdesc'];
}
?>

<span style="font-size:15px;">

   <br>  <h2 class="text-lg font-medium mr-auto" style="font-family: helveticanow-bold, Roboto; color:#303998; font-size:25px;">
                           <?echo $titleview;?>
                        </h2>
                        <br>
                        <div><?echo fixCmsContentPaths($longdesc);?></div>
                        <?if ($pid == "102") { ?>
                        <script src="https://js-ap1.hsforms.net/forms/embed/442755232.js" defer></script>
                        <div style="max-width: 100%; border: 1px solid #d8dae8; border-radius: 16px; background-color: #ffffff; box-shadow: 0 2px 8px rgba(48, 57, 152, 0.08);">
                            <div
                                class="hs-form-frame"
                                data-region="ap1"
                                data-form-id="c3f4c145-9a13-48f6-8047-c070caef0956"
                                data-portal-id="442755232">
                            </div>
                        </div>
                        <?}?>

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
<p style="font-size:15px;"></p><br>

 
 </div>
 
 <?}?>
                    
    <?}?>
<!-- Display articles end -->
                                            
                     
<?
$stmtpost = $db->prepare("SELECT * FROM cms_posts WHERE category_id = ?");
$stmtpost->execute([$cid]);
$posts = $stmtpost->fetchAll(PDO::FETCH_ASSOC);
$postCount = count($posts);
if ($cid=="eef" || $cid=="joffer")
{?>
<?}else if ($postCount > 1)
{?>
<br>  <h2 class="text-lg font-medium mr-auto" style="font-family:helveticanow-bold, Roboto;color:#303998;font-size:25px;">
                          <?echo $categorytitle;?>
                        </h2>
                         <div class="text-slate-600 dark:text-slate-500 mt-2" style="display:none; width:90%;margin: auto;text-align: center;padding-top: 9px;"><?echo $categorydesc;?><br></div>
<?}?>
<?if ($cid=="eef")
{?>
<style>
    iframe {
    background-image: url("spinner.gif");
    background-repeat: no-repeat;
      background-attachment: fixed;
  background-position: center;
  background-position: top;

   }
   .hs-form-frame iframe {
    background-image: none;
   }</style>
<iframe src="https://workingin-newzealand.com/employer-engagement-form/?formview=1" style="" name="iframe" scrolling="yes" frameborder="1" marginheight="0px" marginwidth="0px" height="700px" width="100%"  onload="document.getElementById('spinner').style.display='none';"></iframe>
<?}?>

<?if ($cid=="joffer")
{?>
<style>
    iframe {
    background-image: url("spinner.gif");
    background-repeat: no-repeat;
      background-attachment: fixed;
  background-position: center;
  background-position: top;

   }
   .hs-form-frame iframe {
    background-image: none;
   }</style>
<iframe src="https://workingin-newzealand.com/job-offer-form/?formview=1" style="" name="iframe" scrolling="yes" frameborder="1" marginheight="0px" marginwidth="0px" height="700px" width="100%"  onload="document.getElementById('spinner').style.display='none';"></iframe>
<?}?>





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


/* mediabox only styles the opened lightbox, so the trigger needs its own play button. The previous thumbnail had one baked into the image; this one is a frame from the video. */
.welcome-video {
  position: relative;
  display: block;
}

.welcome-video::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  width: 100px;
  height: 70px;
  margin: -35px 0 0 -50px;
  background: rgba(0, 0, 0, 0.55);
  border-radius: 12px;
  pointer-events: none;
  transition: background 0.2s;
}

.welcome-video::after {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  /* Nudged 2px right of centre so the triangle reads as centred inside the rectangle. */
  margin: -14px 0 0 -10px;
  border-style: solid;
  border-width: 14px 0 14px 24px;
  border-color: transparent transparent transparent #fff;
  pointer-events: none;
}

.welcome-video:hover::before {
  background: rgba(0, 0, 0, 0.75);
}
</style>
<br>
<!-- new vid implementation start -->
<a href="https://vimeo.com/1218164414/4d23e2190d" class="mediabox rounded-md"><center><img alt="" class="rounded-md" src="/admin/img/mymove-scott-welcome-thumb.jpg"></center></a>
<!-- new vid implementation end -->
<!-- old vid implementation  <div class='embed-container'><iframe src='https://player.vimeo.com/video/765923693?h=c53c470728&title=0&byline=0&portrait=0' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>  -->                
    <?} else if ($cid=="36") {?>
    <br>
    <?php if (empty($allowedSupportLetterVisaTypes)) { ?>
    <p>You do not currently have access to download support letters. Please contact your administrator if you believe this is an error.</p>
    <?php } else { ?>
    <p>Download a support letter below by selecting the Licensed Immigration Adviser you are working with, then clicking the submit button. You can attach this letter of support alongside your CV when submitting job applications. This letter of support helps employers validate that you can make the move by showing that we are backing up your application as your immigration specialists. This goes a long way to assuring employers that your application is good.</p>
    <form target="_blank" style="margin-top:30px;" action="https://portal.mymove.nz/htpd/" method="GET">
        <input type="hidden" id="cname" name="cname" value="<?echo $firstname.$middle.$lastname?>" />
        <label style="font-weight:bold;font-size:120%;">Select the Licensed Immigration Adviser you are working with</label>
        <br>
        <select id="liadviser" name="liadviser" style="margin-top:10px;" required>
          <option value="" disabled selected>Select your option</option>
          
          <option value="Andrey Kutyaev">Andrey Kutyaev</option>
          <option value="Rachel Thornton">Rachel Thornton</option>
          <option value="Darrell Enright">Darrell Enright</option>
          <option value="Sarah Hewitt">Sarah Hewitt</option>
          <option value="Mia Lim">Mia Lim</option>
          <option value="Kraig Soltwedel">Kraig Soltwedel</option>
          
          <!--
          <option value="Monika Warszawska">Monika Warszawska</option>
          <option value="Witthawat Chalanant">Witthawat Chalanant</option>
          <option value="Petra Lipoth">Petra Lipoth</option>
          <option value="Sana Ansari">Sana Ansari</option>
          <option value="Sophie Sun">Sophie Sun</option>
          <option value="Aaron Chen">Aaron Chen</option>
          <option value="Sameena Jaspal">Sameena Jaspal</option>
          <option value="Candy Leung">Candy Leung</option>
          <option value="Hailey Long">Hailey Long</option>
          -->
          
          
        </select>
        <br>
        <br>
        <label style="font-weight:bold;font-size:120%;">Select the Visa you are applying for</label>
        <br>
        <select id="visatype" name="visatype" style="margin-top:10px;" required>
          <option value="" disabled selected>Select your option</option>
          <?php foreach ($allowedSupportLetterVisaTypes as $visaType) { ?>
          <option value="<?php echo htmlspecialchars($visaType, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($visaType, ENT_QUOTES, 'UTF-8'); ?></option>
          <?php } ?>
          
        </select>
        <br>
        <br>
    <input id="supportlettersubmit" type="submit" value="Get support letter" style="background-color:lightgrey; cursor: pointer; padding:11px;">
    </form>
    <?php } ?>
    <br>
    <h2 class="text-lg font-medium mr-auto">How our LIAs can help</h2>
    <div><br></div>
<div>As a Licensed Immigration Adviser, their role is to guide and support you through the immigration process, including identifying suitable visa pathways, ensuring compliance with Immigration New Zealand requirements, and explaining how employment opportunities link to your visa options.</div>
   <div><br></div>
   <div>When it comes to securing a job, this is something you’ll need to manage directly. That said, there are several ways you can strengthen your approach:</div>
   <div><br></div>
   <div><b>Right to work question: </b>We recommend selecting “Yes” and briefly explaining that while you are currently offshore, you would be eligible to obtain a work visa with a suitable job offer. This helps prevent your application from being automatically filtered out by employer systems.</div>
  <div><br></div>
   <div><b>Targeted applications:</b> Tailor your CV and cover letter for each role. Focus on transferable skills, highlight any experience relevant to the New Zealand market, and where appropriate, briefly explain that you are working with a Licensed Immigration Adviser on your visa options.</div>
   <div><br></div>
   <div>If you would like support with preparing a New Zealand–style CV, we have an agreement with CV.co.nz, who are very familiar with local employer expectations. You are welcome to contact Tom&nbsp; from CV.co.nz directly if you decide to proceed.</div>
   <div><br></div>
   <div>I also strongly recommend watching the videos that Paul Goddard regularly shares in our <a href="https://www.facebook.com/groups/newtonzcommunity/members" title="" target="">Facebook group</a>. He offers very practical advice on approaching the New Zealand job market, refining CVs, and connecting with employers, many of our clients have found his insights extremely helpful.</div>
   <div><br></div>
   <div>Often, a small change in strategy, such as refining your CV for the NZ market or approaching employers more directly can make a significant difference.</div>
   
   
    <style>
    #supportlettersubmit {
        -webkit-transition: opacity .5s;
        transition: opacity .5s;
        font-weight:bold;
        border-radius:10px;
    }
        #supportlettersubmit:hover {
            opacity:0.8;
        }
    </style>
    
    
    <?}?>
                   <div class="intro-y grid grid-cols-12 gap-6 mt-5"> 
                        
                        
                        
            <?php
if (isset($_GET['viewpage']) && $_GET['viewpage'] == "1"){
    if ($postCount > 1) {
        foreach ($posts as $rowpost) {
            if ($rowpost['id'] != $pid) {
                $postTitle     = htmlspecialchars($rowpost['title'], ENT_QUOTES, 'UTF-8');
                $postId        = htmlspecialchars($rowpost['id'], ENT_QUOTES, 'UTF-8');
                $postThumb     = htmlspecialchars($rowpost['thumbnail'], ENT_QUOTES, 'UTF-8');
                $postMsg       = htmlspecialchars(implode(" ", explode(" ", $rowpost['message'], 20)), ENT_QUOTES, 'UTF-8');
                $postUrl       = "?section={$postTitle}&cid={$cid}&pid={$postId}&viewpage=1";
			?>
                        <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
                            <div class="p-5">
                                <div class="image-fit">
                                 <a href="<?php echo $postUrl; ?>" class="end rounded-md"><img alt="" class="rounded-md" src="/admin/img/<?php echo $postThumb; ?>"></a>
                                </div>
                                <a href="<?php echo $postUrl; ?>" class="block font-medium text-base mt-5"><?php echo $postTitle; ?></a>
                                <div class="text-slate-600 dark:text-slate-500 mt-2"><?php echo $postMsg; ?></div>
                            </div>
                          <div style="margin-top:0px;margin-left: 21px;"> <button onclick="location.replace('<?php echo $postUrl; ?>')" class="buttonRead buttonMore">Read More</button></div>
                        </div>	<?php
            }
        }
    }
} else if ($postCount == 1) {
    $rowpost  = $posts[0];
    $postTitle = htmlspecialchars($rowpost['title'], ENT_QUOTES, 'UTF-8');
    $postId    = htmlspecialchars($rowpost['id'], ENT_QUOTES, 'UTF-8');
    $postUrl   = "?section={$postTitle}&cid={$cid}&pid={$postId}&viewpage=1";
    ?>
    <script>window.location.replace("<?php echo $postUrl; ?>");</script>
    <?php
} else if ($postCount > 0) {
    foreach ($posts as $rowpost) {
        $postTitle    = htmlspecialchars($rowpost['title'], ENT_QUOTES, 'UTF-8');
        $postId       = htmlspecialchars($rowpost['id'], ENT_QUOTES, 'UTF-8');
        $postThumb    = htmlspecialchars($rowpost['thumbnail'], ENT_QUOTES, 'UTF-8');
        $showvid      = $rowpost['filename'];
        $showarticle  = "?section={$postTitle}&cid={$cid}&pid={$postId}&viewpage=1";
        $href         = ($showvid == 0) ? $showarticle : htmlspecialchars($showvid, ENT_QUOTES, 'UTF-8');
        $linkClass    = ($showvid == 0) ? 'end' : 'mediabox';
			?>
                        <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
                               <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-4" style="display:none;">
                                <div class="w-10 h-10 flex-none image-fit">
                                    <img alt="" class="rounded-full" src="dist/images/profile-3.jpg">
                                </div>
                                <div class="ml-3 mr-auto" style="display:none;">
                                    <a href="" class="font-medium">Pat Vinay</a>
                                    <div class="flex text-slate-500 truncate text-xs mt-0.5">Commercial Manager Recruitment</div>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class=" image-fit">
                                 <a href="<?php echo $href; ?>" class="<?php echo $linkClass; ?> rounded-md"><img alt="" class="rounded-md" src="/admin/img/<?php echo $postThumb; ?>"></a>
                                 <a href="<?php echo $href; ?>" class="<?php echo $linkClass; ?> block font-medium text-base mt-5"><?php echo $postTitle; ?></a>
                                </div>
                                <div class="text-slate-600 dark:text-slate-500 mt-2 cms-post-content"><?php echo fixCmsContentPaths($rowpost['message']); ?></div>
                            </div>
                        </div>	<?php
    }
} ?> 
                       
                        
                            
                        
                      
                       
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
