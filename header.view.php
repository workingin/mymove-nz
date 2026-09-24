<!DOCTYPE html>
<?$userid=$session->id;

?>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        
        <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VYPMS1NP0H"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VYPMS1NP0H');
</script>


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MSF2Q2NT');</script>
<!-- End Google Tag Manager -->
        
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
   
        <title>MyMove.nz - Support Portal</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="dist/css/app.css" />
        <!-- END: CSS Assets-->
        <style>
            
.topbtns
{
    border: 2px solid;
border-radius: 0.25rem;
padding: 7px;
font-weight: 500;
color: #003e7e;
font-size: 15px;
}
.w-24 {
  width: 7rem;
}
.selectedsection
{
    background-color: #003e7e;
color: #fff;
}
.side-menu--highlight {
    background-color: #303998;
    border-radius: 4px;
    color: #fff;
    animation: side-menu-highlight-pulse 2.2s ease-in-out infinite;
}
.side-menu--highlight .side-menu__title,
.side-menu--highlight .menu__title {
    color: #fff;
}
@keyframes side-menu-highlight-pulse {
    0%, 100% {
        background-color: #303998;
        box-shadow: inset 0 0 0 0 rgba(255, 255, 255, 0);
    }
    50% {
        background-color: #3f479b;
        box-shadow: inset 0 0 16px 2px rgba(255, 255, 255, 0.4);
    }
}
@media (prefers-reduced-motion: reduce) {
    .side-menu--highlight {
        animation: none;
    }
}

   [tooltip]:before {            
    position : absolute;
    content : attr(tooltip);
    opacity : 0;
    background-color: #fff;
    color: #003e7e;
    width:150px;
    
    border:1px solid #003e7e;
    transform:translateX(-50%); //NOT IN IE 8
    padding: 22px 12px;
}

[tooltip]:hover:before {
    pointer-events: none;
    opacity : 1;
    margin-top:10px;
    margin-left:10px;
}

div:nth-child(2 of .embed-container) {
    display:none !important;
}
 
 @media only screen and (max-width: 600px) {

 .px-3 {
  padding-left: 0.75rem;
  padding-right: 0.75rem;
  display: none;
}
.font-medium
{
  /*  margin-top:49px; */
}
<?if ($_GET['cid']=="14")
{?>
/*.embed-container
{
    display:none;
}*/
.buttonMore
{
    display:none;
}
/*.intro-y
{
    display:none !important;
} */

<?}?>
}


<?$cid=$_GET['cid'];

if ($_GET['cid']=="14")
{?>
.intro-y
{
    display:none;
}

<?}?>
 
 
        </style>
    </head>
   <?
   $directoryURI =basename($_SERVER['SCRIPT_NAME']);

 
   ?>
    <!-- END: Head -->
    <body class="main">
        <span id="currentuser" style="display:none;"><?php echo $session->username; ?></span>
        <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MSF2Q2NT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
        <!-- BEGIN: Mobile Menu -->
        <div class="mobile-menu md:hidden">
            <div class="mobile-menu-bar">
                <a href="/" class="flex mr-auto">
                    <img style="width:100%;padding:10px;" class="w-6" src="/img/logo.png">
                </a>
                <a href="javascript:;" id="mobile-menu-toggler"> <!--<i data-lucide="list" class="w-8 h-8 text-blue transform "></i>-->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="list" data-lucide="list" class="lucide lucide-list w-8 h-8 text-blue transform">
                    <line x1="8" y1="6" x2="21" y2="6"></line>
                    <line x1="8" y1="12" x2="21" y2="12"></line>
                    <line x1="8" y1="18" x2="21" y2="18"></line>
                    <line x1="3" y1="6" x2="3.01" y2="6"></line>
                    <line x1="3" y1="12" x2="3.01" y2="12"></line>
                    <line x1="3" y1="18" x2="3.01" y2="18"></line>
                    </svg>
                </a>
            </div>
            <ul style="background-color: #191E3C;" class="border-t border-white/[0.08] py-5 hidden">
           <!-- PORTAL SWITCHER MOBILE START -->
            <div id="portalswitchersmob" style="border-bottom: 1px solid rgb(255 255 255 / 0.08);padding-bottom: 1.25rem;font-size:12px;padding-left: 20px;">
                <!-- visas portal switcher disabled
                    <a id="visaslinkmob" href="#" style="padding-right: 5px; pointer-events: none; cursor: default;">
                        <button id="visaswitchmob" style="background-color: lightgray; padding: 6px 16px; border-radius: 10px; color: gray;">Visas</button>
                    </a> -->
                    <a id="teachlnkmob" href="/teacher.php?section=Welcome&amp;cid=39&amp;viewpage=1&amp;pid=127" style="padding-right: 5px;">
                        <button id="teachswchmob" style="background-color: lightgray; padding: 6px 16px; border-radius: 50px; font-weight: bold;">Teacher</button>
                    </a>
                    <a id="setlnkmob" href="/settlement.php?section=Welcome&amp;cid=14&amp;viewpage=1&amp;pid=44" style="padding-right: 5px;">
                        <button id="setswchmob" style="background-color: lightgray; padding: 6px 16px; border-radius: 50px; font-weight: bold;">Settlement</button>
                    </a>
                    <a id="employmentlinkmob" href="/main.php?section=welcome&amp;cid=1">
                        <button id="employmentswitchmob" style="background-color: lightgray; padding: 6px 16px; border-radius: 50px; font-weight: bold;">Employment</button>
                    </a>
                </div>
                <script type="text/javascript">
                    if (window.location.href.indexOf('teacher') > -1) {
                      document.getElementById('teachswchmob').style.color = "white";
                      document.getElementById('teachswchmob').style.backgroundColor = "rgb(48, 57, 152)";
                      document.getElementById('teachlnkmob').style.pointerEvents = "none";
                      document.getElementById('teachlnkmob').style.cursor = "default";
                    }
                    if (window.location.href.indexOf('settlement') > -1) {
                      document.getElementById('setswchmob').style.color = "white";
                      document.getElementById('setswchmob').style.backgroundColor = "rgb(48, 57, 152)";
                      document.getElementById('setlnkmob').style.pointerEvents = "none";
                      document.getElementById('setlnkmob').style.cursor = "default";
                    }
                    if (window.location.href.indexOf('main') > -1) {
                      document.getElementById('employmentswitchmob').style.color = "white";
                      document.getElementById('employmentswitchmob').style.backgroundColor = "rgb(48, 57, 152)";
                      document.getElementById('employmentlinkmob').style.pointerEvents = "none";
                      document.getElementById('employmentlinkmob').style.cursor = "default";
                    }
                    if (window.location.href.indexOf('visas') > -1) {
                      document.getElementById('visaswitchmob').style.color = "white";
                      document.getElementById('visaswitchmob').style.backgroundColor = "rgb(48, 57, 152)";
                      document.getElementById('visaslinkmob').style.pointerEvents = "none";
                      document.getElementById('visaslinkmob').style.cursor = "default";
                    }
                </script>
                <!-- PORTAL SWITCHER MOBILE END -->
           <?if ($directoryURI=="main.php")
           {
           ?>
                <li>
                    <a href="main.php?section=Welcome&cid=1" class="menu <?php echo ($cid == "1" ? "side-menu--active" : "");?>">
                        <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="home" data-lucide="home" class="lucide lucide-home"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        </div>
                        <div class="menu__title">Welcome</div>
                    </a>
                   
                </li>
                <li>
                    <a href="/main.php?section=Find%20a%20Job%20in%20NZ&cid=26" class="menu <?php echo ($cid == "26" ? "side-menu--active" : "");?>">
                        <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="briefcase-search" data-lucide="briefcase-search" class="lucide lucide-briefcase-search"><path d="M10 2h4"></path><path d="M20 13V7a2 2 0 0 0-2-2h-3.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 11.93 2H8a2 2 0 0 0-2 2v11"></path><circle cx="18" cy="18" r="3"></circle><path d="M18 16.5V21"></path><path d="m21.6 21.6-2.1-2.1"></path><path d="M6 13a2 2 0 0 0 2 2h3"></path></svg>
                        </div>
                        <div class="menu__title">Find a Job in NZ</div>
                    </a>
                
                </li>
                <li>
                    <a href="/main.php?section=Your%20Application&cid=27" class="menu <?php echo ($cid == "27" ? "side-menu--active" : "");?>">
                        <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="clipboard-list" data-lucide="clipboard-list" class="lucide lucide-clipboard-list"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><path d="M12 11h4"></path><path d="M12 16h4"></path><path d="M8 11h.01"></path><path d="M8 16h.01"></path></svg>
                        </div>
                        <div class="menu__title">Your Application</div>
                    </a>
                </li>
                <li>
                    <a href="/main.php?section=The%20Interview&cid=28" class="menu <?php echo ($cid == "28" ? "side-menu--active" : "");?>">
                        <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="mic" data-lucide="mic" class="lucide lucide-mic"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"></path><path d="M19 10v2a7 7 0 0 1-14 0v-2"></path><line x1="12" x2="12" y1="19" y2="22"></line></svg>
                        </div>
                        <div class="menu__title">The Interview</div>
                    </a>
                </li>
                <li>
                    <a href="/main.php?section=Testimonials&cid=47" class="menu <?php echo ($cid == "47" ? "side-menu--active" : "");?>">
                        <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-pen" data-lucide="file-pen" class="lucide lucide-file-pen"><path d="M12.5 22H18a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v9.5"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M13.378 15.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"></path></svg>
                        </div>
                        <div class="menu__title">CV and Cover Letter Support</div>
                    </a>
                </li>
                <li>
                    <a href="?section=Industry Hubs&cid=49" class="menu <?php echo ($cid == "49" ? "side-menu--active" : "");?>">
                        <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="building-2" data-lucide="building-2" class="lucide lucide-building-2"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>
                        </div>
                        <div class="menu__title">Industry Hub</div>
                    </a>
                </li>
                <li>
                    <a href="/main.php?section=Testimonials&cid=30" class="menu <?php echo ($cid == "30" ? "side-menu--active" : "");?>">
                        <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="quote" data-lucide="quote" class="lucide lucide-quote"><path d="M16 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"></path><path d="M5 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"></path></svg>
                        </div>
                        <div class="menu__title">Testimonials</div>
                    </a>
                </li>
                <li>
                    <a href="/main.php?section=Forms%20/%20Contact%20Us&cid=33" class="menu <?php echo ($cid == "33" ? "side-menu--active" : "");?>">
                        <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="mail" data-lucide="mail" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                        </div>
                        <div class="menu__title">Forms / Contact Us</div>
                    </a>
                </li>
                <!--<li>
                    <a href="https://jobsadmin.workingin.com/htpd/?cname=Jobs%20User" target="_blank"  class="menu">
                        <div class="menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="menu__title">Download Support Letter</div>
                    </a>
                </li>-->
                <li>
                            <a href="?section=Download%20Support%20Letter&cid=36" class="menu <?php echo ($cid == "36" ? "side-menu--active" : "");?>">
                                <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-down" data-lucide="file-down" class="lucide lucide-file-down"><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M4 5a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h6"></path><path d="M12 18v-6"></path><path d="m9 15 3 3 3-3"></path></svg>
                                </div>
                                <div class="menu__title">
                                 Download Support Letter
                                
                                </div>
                            </a>
                         
                        </li>
                        
                        <li>
                            <a href="https://portal.mymove.nz/downloads/NZ-Job-Application-Tracker.xlsx" target="_blank" class="menu">
                                <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="table-2" data-lucide="table-2" class="lucide lucide-table-2"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18"></path></svg>
                                </div>
                                <div class="menu__title">
                                 Job application tracking sheet template
                                
                                </div>
                            </a>
                         
                        </li>
                        
                        <li>
                            <a href="https://portal.mymove.nz/downloads/WINZ-Visiting-NZ-Strategy.pdf" target="_blank" class="menu">
                                <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="map" data-lucide="map" class="lucide lucide-map"><path d="M14.106 5.553a2 2 0 0 0 1.788 0l3.659-1.83A1 1 0 0 1 21 4.619v12.764a1 1 0 0 1-.553.894l-4.553 2.277a2 2 0 0 1-1.788 0l-4.212-2.106a2 2 0 0 0-1.788 0l-3.659 1.83A1 1 0 0 1 3 19.381V6.618a1 1 0 0 1 .553-.894l4.553-2.277a2 2 0 0 1 1.788 0z"></path><path d="M15 5.764v15"></path><path d="M9 3.236v15"></path></svg>
                                </div>
                                <div class="menu__title">
                                 Guide for visiting NZ to look for work
                                
                                </div>
                            </a>
                         
                        </li>
                        
                        <li>
                            <a href="?section=Frequently Asked Questions&cid=38" class="menu <?php echo ($cid == "38" ? "side-menu--active" : "");?>">
                                <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="circle-help" data-lucide="circle-help" class="lucide lucide-circle-help"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><path d="M12 17h.01"></path></svg>
                                </div>
                                <div class="menu__title">
                                 Frequently Asked Questions
                                
                                </div>
                            </a>
                         
                        </li>
                
                <li class="menu__devider my-6"></li>
                
                <?
                    
                } elseif ($directoryURI=="jobsupport.php")
                {
                ?>
                
                <li>
                    <a href="jobsupport.php?section=Welcome&cid=1"  class="menu">
                        <div class="menu__icon"> <i data-lucide="calendar"></i> </div>
                        <div class="menu__title"> Welcome</div>
                    </a>
                </li>
                <li>
                    <a href="jobsupport.php?section=Find%20a%20Job%20in%20NZ&cid=26"  class="menu">
                        <div class="menu__icon"> <i data-lucide="calendar"></i> </div>
                        <div class="menu__title"> Find a Job in NZ</div>
                    </a>
                </li>
                <li>
                    <a href="jobsupport.php?section=Your%20Application&cid=27"  class="menu">
                        <div class="menu__icon"> <i data-lucide="calendar"></i> </div>
                        <div class="menu__title"> Your Application</div>
                    </a>
                </li>
                <li>
                    <a href="jobsupport.php?section=The%20Interview&cid=28"  class="menu">
                        <div class="menu__icon"> <i data-lucide="calendar"></i> </div>
                        <div class="menu__title"> The Interview</div>
                    </a>
                </li>
                <li>
                    <a href="jobsupport.php?section=Testimonials&cid=30"  class="menu">
                        <div class="menu__icon"> <i data-lucide="calendar"></i> </div>
                        <div class="menu__title"> Testimonials</div>
                    </a>
                </li>
                <li>
                    <a href="jobsupport.php?section=Forms / Contact Us&cid=33"  class="menu">
                        <div class="menu__icon"> <i data-lucide="calendar"></i> </div>
                        <div class="menu__title"> Forms / Contact Us</div>
                    </a>
                </li>
                <!-- <li>
                    <a href="jobsupport.php?section=Upcoming%20Webinars&cid=9"  class="menu">
                        <div class="menu__icon"> <i data-lucide="calendar"></i> </div>
                        <div class="menu__title"> Upcoming Webinars</div>
                    </a>
                </li> -->
                
                <?}
                elseif ($directoryURI=="settlement.php")  {
                    ?>
                      <li>
                    <a href="/settlement.php?section=Welcome&cid=14&viewpage=1&pid=44" class="menu <?php echo ($cid == "14" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="star"></i> </div>
                        <div class="menu__title">Welcome</div>
                    </a>
                   
                </li>
                <li>
                    <a href="/settlement.php?section=Relocation%20Support%20Partners&cid=37"  class="menu side-menu--highlight <?php echo ($cid == "37" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                </svg> </div>
                        <div class="menu__title">Relocation Support Partners</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=Accommodation&cid=10"  class="menu <?php echo ($cid == "10" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="home"></i> </div>
                        <div class="menu__title">Accommodation </div>
                    </a>
                
                </li>
                <li>
                    <a href="/settlement.php?section=Banking%20and%20Finance%20&cid=12" class="menu <?php echo ($cid == "12" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="landmark"></i> </div>
                        <div class="menu__title">Banking & Finance</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=Tax%20Rates&cid=15" class="menu <?php echo ($cid == "15" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="percent"></i> </div>
                        <div class="menu__title">Tax Rates</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=Transportation&cid=11" class="menu <?php echo ($cid == "11" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="car"></i> </div>
                        <div class="menu__title">Transportation</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=Living%20Cost%20in%20NZ&cid=17" class="menu <?php echo ($cid == "17" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="coins"></i> </div>
                        <div class="menu__title">Living Cost in NZ</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=Healthcare%20and%20Emergency%20Services&cid=18"  class="menu <?php echo ($cid == "18" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="cross"></i> </div>
                        <div class="menu__title">Healthcare & Emergency Services</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=Community%20Groups&cid=19"  class="menu <?php echo ($cid == "19" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="users"></i> </div>
                        <div class="menu__title">Community Groups</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=NZ%20Culture%20and%20Custom&cid=20"  class="menu <?php echo ($cid == "20" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="palette"></i> </div>
                        <div class="menu__title">NZ Culture and Custom</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=NZ%20Working%20Culture&cid=21"  class="menu <?php echo ($cid == "21" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="briefcase"></i> </div>
                        <div class="menu__title">NZ Working Culture</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=New%20Zealand%20Climate&cid=22"  class="menu <?php echo ($cid == "22" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="cloud-sun"></i> </div>
                        <div class="menu__title">New Zealand Climate</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=Religion%20in%20New%20Zealand&cid=23"  class="menu <?php echo ($cid == "23" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="book"></i> </div>
                        <div class="menu__title">Religion in New Zealand</div>
                    </a>
                </li>
                
                <!--<li>
                    <a href="/settlement.php?section=Refugee%20Support&cid=24"  class="menu">
                        <div class="menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                        <div class="menu__title">Refugee Support</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=%20Upcoming%20Webinars&cid=9"  class="menu">
                        <div class="menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                        <div class="menu__title">Upcoming Webinars</div>
                    </a>
                </li> -->
                <!--<li>
                    <a href="/settlement.php?section=Relocation Support&cid=35"  class="menu">
                        <div class="menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                        <div class="menu__title">Relocation Support</div>
                    </a>
                </li> -->
                <?php if($_SESSION['has_company_documents'] == 1): ?>
                <li>
                    <a href="/settlement.php?section=company_docs&cid=25"  class="menu <?php echo ($cid == "25" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="file"></i> </div>
                        <div class="menu__title">Company Documents</div>
                    </a>
                </li>
                <?php endif; ?>
                <li class="menu__devider my-6"></li>

                <?
                    
                } elseif ($directoryURI=="teacher.php")  {
                    ?>
                      <li>
                    <a href="/teacher.php?section=Welcome&cid=39" class="menu <?php echo ($cid == "39" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <!--<i data-lucide="package-plus"></i>-->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="package-plus" data-lucide="package-plus" class="lucide lucide-package-plus"><path d="M16 16h6"></path><path d="M19 13v6"></path><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"></path><path d="M16.5 9.4 7.55 4.24"></path><path d="M3.29 7 12 12m0 0 8.71-5M12 12v10"></path></svg>
                        </div>
                        <div class="menu__title">Introduction to the Teachers Pack</div>
                    </a>
                   
                </li>
                <li>
                    <a href="/teacher.php?section=Documents&cid=40"  class="menu <?php echo ($cid == "40" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-text" data-lucide="file-text" class="lucide lucide-file-text"><path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><line x1="10" y1="9" x2="8" y2="9"></line></svg> </div>
                        <div class="menu__title">Documents and Registration</div>
                    </a>
                
                </li>
                <li>
                    <a href="/teacher.php?section=Benefits&cid=41" class="menu <?php echo ($cid == "41" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="cross" data-lucide="cross" class="lucide lucide-cross"><path d="M11 2a2 2 0 00-2 2v5H4a2 2 0 00-2 2v2c0 1.1.9 2 2 2h5v5c0 1.1.9 2 2 2h2a2 2 0 002-2v-5h5a2 2 0 002-2v-2a2 2 0 00-2-2h-5V4a2 2 0 00-2-2h-2z"></path></svg> </div>
                        <div class="menu__title">Benefits</div>
                    </a>
                </li>
                <li>
                    <a href="/teacher.php?section=The%20NZ%20Education%20System&cid=42" class="menu <?php echo ($cid == "42" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="graduation-cap" data-lucide="graduation-cap" class="lucide lucide-graduation-cap"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg> </div>
                        <div class="menu__title">The NZ Education System</div>
                    </a>
                </li>
                <li>
                    <a href="/teacher.php?section=Job%20Search&cid=43" class="menu <?php echo ($cid == "43" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="briefcase" data-lucide="briefcase" class="lucide lucide-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"></path></svg> </div>
                        <div class="menu__title">The Job Search</div>
                    </a>
                </li>
                <li>
                    <a href="/teacher.php?section=Maori%20Classroom%20Culture&cid=44" class="menu <?php echo ($cid == "44" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="palette" data-lucide="palette" class="lucide lucide-palette"><circle cx="13.5" cy="6.5" r=".5"></circle><circle cx="17.5" cy="10.5" r=".5"></circle><circle cx="8.5" cy="7.5" r=".5"></circle><circle cx="6.5" cy="12.5" r=".5"></circle><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 011.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"></path></svg> </div>
                        <div class="menu__title">Māori Culture in the Classroom</div>
                    </a>
                </li>
                <li>
                    <a href="/teacher.php?section=Maori%20Classroom%20Culture&cid=45" class="menu <?php echo ($cid == "45" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="book" data-lucide="book" class="lucide lucide-book"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"></path></svg>
                                 </div>
                        <div class="menu__title">Māori Integration into the NZ Curriculum</div>
                    </a>
                </li>
                <li>
                    <a href="/teacher.php?section=Curriculum%201%20to%2013&cid=46" class="menu <?php echo ($cid == "46" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="book-open" data-lucide="book-open" class="lucide lucide-book-open"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"></path><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"></path></svg> </div>
                        <div class="menu__title">NZ Curriculum – Primary & Senior School Years (1 – 13)</div>
                    </a>
                </li>
                <li>
                    <a href="https://www2.nzqa.govt.nz/ncea/subjects/past-exams-and-exemplars/" target="_blank" class="menu">
                            <div class="menu__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="landmark" data-lucide="landmark" class="lucide lucide-landmark"><line x1="3" y1="22" x2="21" y2="22"></line><line x1="6" y1="18" x2="6" y2="11"></line><line x1="10" y1="18" x2="10" y2="11"></line><line x1="14" y1="18" x2="14" y2="11"></line><line x1="18" y1="18" x2="18" y2="11"></line><polygon points="12 2 20 7 4 7"></polygon></svg>
                            </div>
                        <div class="menu__title">NCEA Exemplars, past examination papers and assessment resource</div>
                    </a>
                </li>
                <!--<li>
                    <a href="/settlement.php?section=Healthcare%20and%20Emergency%20Services&cid=18"  class="menu <?php echo ($cid == "18" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="cross"></i> </div>
                        <div class="menu__title">Healthcare & Emergency Services</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=Community%20Groups&cid=19"  class="menu <?php echo ($cid == "19" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="users"></i> </div>
                        <div class="menu__title">Community Groups</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=NZ%20Culture%20and%20Custom&cid=20"  class="menu <?php echo ($cid == "20" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="palette"></i> </div>
                        <div class="menu__title">NZ Culture and Custom</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=NZ%20Working%20Culture&cid=21"  class="menu <?php echo ($cid == "21" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="briefcase"></i> </div>
                        <div class="menu__title">NZ Working Culture</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=New%20Zealand%20Climate&cid=22"  class="menu <?php echo ($cid == "22" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="cloud-sun"></i> </div>
                        <div class="menu__title">New Zealand Climate</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=Religion%20in%20New%20Zealand&cid=23"  class="menu <?php echo ($cid == "23" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="book"></i> </div>
                        <div class="menu__title">Religion in New Zealand</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=Relocation%20Support%20Partners&cid=37"  class="menu side-menu--highlight <?php echo ($cid == "37" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                </svg> </div>
                        <div class="menu__title">Relocation Support Partners</div>
                    </a>
                </li><li>
                    <a href="/settlement.php?section=Refugee%20Support&cid=24"  class="menu">
                        <div class="menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                        <div class="menu__title">Refugee Support</div>
                    </a>
                </li>
                <li>
                    <a href="/settlement.php?section=%20Upcoming%20Webinars&cid=9"  class="menu">
                        <div class="menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                        <div class="menu__title">Upcoming Webinars</div>
                    </a>
                </li> -->
                <!--<li>
                    <a href="/settlement.php?section=Relocation Support&cid=35"  class="menu">
                        <div class="menu__icon"> <i data-lucide="check-circle-2"></i> </div>
                        <div class="menu__title">Relocation Support</div>
                    </a>
                </li>
                <?php if($_SESSION['has_company_documents'] == 1): ?>
                <li>
                    <a href="/settlement.php?section=company_docs&cid=25"  class="menu <?php echo ($cid == "25" ? "side-menu--active" : "");?>">
                        <div class="menu__icon"> <i data-lucide="file"></i> </div>
                        <div class="menu__title">Company Documents</div>
                    </a>
                </li>
                <?php endif; ?>
                 -->
                <li class="menu__devider my-6"></li>

                <?
                    
                }
                ?>
                ?>
                
                 <li>
                     
                    <a href="userinfo.php?user=<?php echo $session->username; ?>"  class="menu">
                        <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="user" data-lucide="user" class="lucide lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </div>
                        <div class="menu__title">Profile</div>
                    </a>
                </li>
                  <li>
                    <a href="/admin/logout.php?path=referrer"  class="menu">
                        <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="log-out" data-lucide="log-out" class="lucide lucide-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        </div>
                        <div class="menu__title">Logout</div>
                    </a>
                </li>
               
            </ul>
        </div>
        <!-- END: Mobile Menu -->
        
        <!-- BEGIN: Top Bar -->
        
        <style>.side-nav {
  width: 350px;
  font-size:14px;
  font-weight:500;
}</style>
        <!-- END: Top Bar -->
     <?
   //  $section=$_GET['section'];
    
  //   if ($section=="welcome")
      //                  {
     //                       $wellhide="none;";
                            
      //                  }else
      //                  {
      //                  }
                        ?>
<?//$stp= $logged_user['user_form_status'];

?>
<div style="background:#fff;" class="top-bar-boxed h-[70px] z-[51] relative border-b border-white/[0.08] -mt-7 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 md:pt-0 mb-12">
            <div class="h-full flex items-center">
                <!-- BEGIN: Logo -->
                <a href="" class="-intro-x hidden md:flex">
                    <img   style="width:300px; height:28px" src="/img/logo.png">
                    <!--<span class="text-white text-lg ml-3"> Support Portal </span> -->
                </a>
                <!-- END: Logo -->
                <!-- BEGIN: Breadcrumb -->
                <nav aria-label="breadcrumb" class="-intro-x h-full mr-auto" style="color:#000">
                    <ol class="breadcrumb breadcrumb-light">
                        <li class="breadcrumb-item"><a href="#"></a></li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </nav>
                
                <!--START PORTAL SWITCHER-->
                <div id="portalswitchers">
                    <!--Visas Portal switcher disabled
                    <a id="visaslink" href="#" style="padding-right: 5px; pointer-events: none; cursor: default;">
                        <button id="visaswitch" style="background-color: lightgray; padding: 5px; border-radius: 10px; color: gray;">Visas Portal</button>
                    </a>-->
                    
                             <?
                  $sql = "SELECT * FROM users WHERE id='$userid' ";
                                                        
                                                            $result = $db->prepare($sql);
                                                            $result->execute();
                                                            while ($row = $result->fetch()) {
                                                               $jportal=$row['jportal'];
                                                               $sportal=$row['sportal'];
                                                               $tportal=$row['tportal'];                                                                                  
                                                              }
                                                         
                                                              
                                                              
?>
<?if ($tportal=='1') 
{
 
?>
                    <a id="teacherlink" href="/teacher.php?section=Welcome&amp;cid=39&amp;viewpage=1&amp;pid=127" style="padding-right: 5px;">
                        <button id="teacherswitch" style="background-color: lightgray; padding: 6px 16px; border-radius: 50px; font-family: helveticanow-bold, helveticanow, Roboto;">Teacher Portal</button>
                    </a>
<?}?>
<?if ($sportal=='1') 
{
 
?>
                    <a id="settlementlink" href="/settlement.php?section=Welcome&amp;cid=14&amp;viewpage=1&amp;pid=44" style="padding-right: 5px;">
                        <button id="settlementswitch" style="background-color: lightgray; padding: 6px 16px; border-radius: 50px; font-family: helveticanow-bold, helveticanow, Roboto;">Settlement Portal</button>
                    </a>
<?}?>                    
 <?if ($jportal=='1') 
{
    
?>                   <a id="employmentlink" href="/main.php?section=welcome&amp;cid=1" style="">
                        <button id="employmentswitch" style="background-color: lightgray; padding: 6px 16px; border-radius: 50px; font-family: helveticanow-bold, helveticanow, Roboto;">Employment Portal</button>
                    </a>
    <?}?>                
         
                    <div class="intro-x dropdown w-8 h-8" style="display: inline; float: right; padding-right:55px;">
                    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                        <img alt="" src="dist/images/profile-5.jpg">
                    </div>
                    <div class="dropdown-menu w-56" id="_odnw6s9w3" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(2px, 34px);" data-popper-placement="bottom-end">
                        <ul class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                          
                         
                       
                            <li style="display:none;">
                                <a href="" class="dropdown-item hover:bg-white/5"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="lock" data-lucide="lock" class="lucide lucide-lock w-4 h-4 mr-2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0110 0v4"></path></svg> Reset Password </a>
                            </li>
                          
                             <li>
                                <a href="userinfo.php?user=<?php echo $session->username; ?>" class="dropdown-item hover:bg-white/5"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="user" data-lucide="user" class="lucide lucide-user w-4 h-4 mr-2"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Profile </a>
                            </li>
                            <li>
                                <a href="/admin/logout.php?path=referrer" class="dropdown-item hover:bg-white/5"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="log-out" data-lucide="log-out" class="lucide lucide-log-out w-4 h-4 mr-2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Logout </a>
                            </li>
                        </ul>
                    </div>
                </div>
                </div>
                <script type="text/javascript">
                    if (window.location.href.indexOf('teacher') > -1) {
                      document.getElementById('teacherswitch').style.color = "white";
                      document.getElementById('teacherswitch').style.backgroundColor = "#303998";
                      document.getElementById('teacherlink').style.pointerEvents = "none";
                      document.getElementById('teacherlink').style.cursor = "default";
                    }
                    if (window.location.href.indexOf('settlement') > -1) {
                      document.getElementById('settlementswitch').style.color = "white";
                      document.getElementById('settlementswitch').style.backgroundColor = "#303998";
                      document.getElementById('settlementlink').style.pointerEvents = "none";
                      document.getElementById('settlementlink').style.cursor = "default";
                    }
                    if (window.location.href.indexOf('main') > -1) {
                      document.getElementById('employmentswitch').style.color = "white";
                      document.getElementById('employmentswitch').style.backgroundColor = "#303998";
                      document.getElementById('employmentlink').style.pointerEvents = "none";
                      document.getElementById('employmentlink').style.cursor = "default";
                    }
                    if (window.location.href.indexOf('visas') > -1) {
                      document.getElementById('visaswitch').style.color = "white";
                      document.getElementById('visaswitch').style.backgroundColor = "#303998";
                      document.getElementById('visaslink').style.pointerEvents = "none";
                      document.getElementById('visaslink').style.cursor = "default";
                    }
                </script>
                <!--END PORTAL SWITCHER-->
                <!-- END: Breadcrumb -->
               
                <div class="mobile-menu md:hidden">  
              
                   </div>
               <div>  
                <button style="display:none;" class="btn btn-outline-primary w-24 inline-block mr-1 mb-2 selectedsection">EMPLOYMENT</button> 
                <button style="display:none;"  disabled class="btn btn-outline-primary w-24 inline-block mr-1 mb-2"style="width:60px;" tooltip="Coming Soon">VISA</button> 
                <button style="display:none;"  disabled class="btn btn-outline-primary w-24 inline-block mr-1 mb-2" tooltip="Coming Soon">RELOCATION</button> 
        
                 
                 
                   </div>
         
         
            </div>
        </div>
