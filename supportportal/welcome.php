<?php header("Location: main.php?cid=1"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome to Working In New Zealand</title>
<style>
     body {
            overflow-x: hidden;
        }



        .video-container {
            width: 80vw;
            height: 80vh;
            overflow: hidden;
            position: relative;
        }



        iframe {
            position: absolute;
            top: 0%;
            width: 86vw;
            height: 107vh;
            pointer-events: none;
        }
    
</style>
</head>

<body>
    <!DOCTYPE html>

<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
   
        <title>Support Portal</title>
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
        </style>
    </head>
    <!-- END: Head -->
    <body class="main">
    
        
        <style>.side-nav {
  width: 350px;
  font-size:16px;
  font-weight:500;
}</style>
        <!-- END: Top Bar -->
     <?
     $section=$_GET['section'];
    
     if ($section=="welcome")
                        {
                            $wellhide="none;";
                            
                        }else
                        {
                        }
                        ?>
<?$stp= $logged_user['user_form_status'];

?>


        <div class="wrapper">
            <div class="wrapper-box">
                <!-- BEGIN: Side Menu -->
                
                <!-- END: Side Menu -->
                <!-- BEGIN: Content -->
                <div class="content" style="background:#000;margin-top:-10px;min-height: 92vh;">
<div class="video-container" style="margin:auto !important;">

        
        <iframe style="display:none;"
            src="https://www.youtube.com/embed/LydU1vRAZpc?mute=1&modestbranding=0&autoplay=1&autohide=1&rel=0&showinfo=0&controls=0&disablekb=1&enablejsapi=1&iv_load_policy=3&loop=1&playsinline=1&fs=0&playlist=LydU1vRAZpc"></iframe>
    </div>              

 <div style="width:144px;background:#223e8c;margin: auto;margin-top: 6px;padding: 5px;border: 1px solid;border-radius: 5px;text-align: center;"><a href="main.php?cid=1"><span style="color:#fff;font-weight:bold;font-size:17px;">Skip Video</a></div>
</div>
  
            </div>   
            
        </div>

        
        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="dist/js/app.js"></script>
        <!-- END: JS Assets-->
    </body>
</html>
    
    
    
    
    
    
    
    
</body>

</html>