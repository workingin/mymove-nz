<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$settings->fetch('site_name')?></title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

    <?=css_link('material-design-iconic-font/css/material-design-iconic-font.min', true)?>
    <?=css_link('jquery-ui', true)?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <?=css_link('style', true)?>


    <?=js_link('jquery-3.3.1.min', true)?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        .logo-image {
            width: 180px;
            position: absolute;
            top: 1em;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ffffff;
            border-radius: 8px;
            padding: 0.5em 2em;
            box-sizing: border-box;
        }

        .logo-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        .steps {

    background: #;
     background-image: url(https://www.myvisapath.co.nz/wp-content/themes/myvisapath/assets/img/sec-2-bg.jpg);
    background-position: bottom center;
background-repeat: ;

}

.btn-light {
    color: #000;
    background-color: #f8f9fa;
    border-color: #f8f9fa;
    border: 1px solid;
}

.bg-success {
    background: #66CC33 !important;
    border: 1px solid #66CC33;
}
    .badge {
    display: inline-block;
    padding: 8px;
    font-size: 14px;
    font-weight: 500;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25rem;
}
    .table-dark {

    color: #fff;
    border-color: #bababa;
}
.table-dark {
    --bs-table-bg: #;
}
  .bg-primary {
    background-color: #e3e3e3 !important;
}  

.text-center {
    text-align: left !important;
    color:#003d7d !important;
}

.steps-inner {
    background: #fff;
}
.steps-header h2
{
    color:#000;
        //font-family: 'Roboto', sans-serif;
}
.steps-progress {
    
    border: 1px solid #6c3;
}
.steps-progress-bar {
    background-color: #6c3;

}
.form-group label {
 
    color: #000;
}
.form-group input, .form-group textarea {
    background-color: #fff;
      color: #000;

    border: 1px solid #97999b;
}

.form-group input[type="email"]:read-only {
 background-color: #fff;

    border: 1px solid #97999b;
    color:#000;
}
.card-header h3 {

    color: #000;
}
.card p {
    color: #000;
}
.display-4.fw-bold {
    color: #003d7d !important;
}
.lead {
    color: #003d7d;
    opacity: 0.9;
}
.form-control {
background:#fff !important;
    
}
.p-2 {
    padding: 0px !important;
}
.m-1 {
    margin: 0px !important;
}
.border {
    border: 0px !important;
}
.p-4 {
    padding: 0px !important;
}


.btn-primary {
    color: #fff;
    background-color: #003d7d;
    border-color: #003d7d;
}
.btn-success {
    color: #fff;
   background:#66CC33;border:1px solid #66CC33;
}
.bg-success
{
    background:#66CC33;border:1px solid #66CC33;
}
@media only screen and (max-width: 767px) 
{
.col-auto {
    flex: 0 0 auto;
    width: 100%;
    margin-bottom:10px;
}
.badge {
 
    width: 100%;
    margin-bottom: 10px;
}
.btn-primary {
    width: 100%;
    
}
.accordion__item__header {
    font-size: 14px !important;
}
.btn-success {
   width:100%;
   margin-bottom:10px;
}
}
.steps-inner {
   
    margin-top: 20px;
}

.form-control {
    display: block;

    color: #212529 !important;
}
#exampleTable_filter
{
    float:right;
}
a {
    color: #003d7d;
    text-decoration: none;
}
</style>
 
</head>

<?$stp= $logged_user['user_form_status'];
//echo $stp;
?>
<body><div class="headadmin" style="padding-left:16px;padding-right:16px;margin-top:10px;height:70px;"> 
<img src="https://www.myvisapath.co.nz/wp-content/themes/myvisapath/assets/img/Logo-blue.png" alt="" class="sticky-logo">
    <span style="float:right;margin-top:10px;">
           <a style="display:none;" href="https://www.myvisapath.co.nz/mvp/admin/countprice.php" onclick="javascript:void window.open('https://www.myvisapath.co.nz/mvp/admin/countprice.php','1638669608835','width=700,height=550,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" style="border: 1px solid;padding: 6px;/*! background: #000; *//*! color: #fff; */">Set Price for Website</a>
           
          <a href="?statusrp=1000" style="border: 1px solid;padding: 6px;/*! background: #000; *//*! color: #fff; */">InComplete Forms</a>
        <a href="?statusrp=100" style="border: 1px solid;padding: 6px;/*! background: #000; *//*! color: #fff; */">Completed Forms</a>
        <a href="logout.php" style="border: 1px solid;padding: 6px;/*! background: #000; *//*! color: #fff; */">Logout</a></span>
</div>
      
        </header>
        
        
