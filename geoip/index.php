<?php
require_once 'lib/Request.php';
$requestModel = new Request();
$ip = $requestModel->getIpAddress();
$isValidIpAddress = $requestModel->isValidIpAddress($ip);
?>
<?php
if ($isValidIpAddress == "") {
    echo "<div class='error'>Invalid IP address $ip</div>";
} else {
    $geoLocationData = $requestModel->getLocation($ip);
    $countryprice= $geoLocationData['country_code'];
    if ($countryprice=="GB")
    {
        echo "£9.99";
    }
    elseif ($countryprice=="NZ")
    {
        echo "$299";
    }
 
 elseif ($countryprice=="ZA")
    {
        echo "R2020";
    }
 
    
    }?>
