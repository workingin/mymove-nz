<?
$coverfile="";
$timefile= $current_timestamp;

require('WriteHTML.php');
$covercontent="<h1>******** Screening Questions *********</h1><br>";
$covercontent.="Country of residence: <b>$country_residence</b><br>";
$covercontent="<h1>******** Screening Questions *********</h1><br>";
$covercontent.="Country of residence: <b>$country_residence</b><br>";

if ($ppp=="1" || $healthppp=="1")
{
   
}

else if ($applicationtype=="nonhealth")
{

$covercontent.="Nationality: <b>$additional8</b><br>";
$covercontent.="Current Position held: <b>$currentposition</b><br>"; 
$covercontent.="Ideal Position: <b>$idealposition</b><br>"; 
$covercontent.="Current Salary: <b>$currentsalary</b><br>"; 
$covercontent.="Highest Qualification: <b>$qualifications</b><br>"; 
$covercontent.="When are you looking to move to NZ? <b>$additional5</b><br>"; 
$covercontent.="Why are you wanting to move to NZ? <b>$whymoving</b><br>"; 
$covercontent.="Have you been to NZ before? <b>$beforenz</b><br>"; 
$covercontent.="Preferred locations in NZ? <b>$preferlocation</b><br>"; 
$covercontent.="Are you bringing family to NZ <b>$family</b><br>"; 
$covercontent.="Have you applied for other jobs in NZ? <b>$otherjobs</b><br>"; 
$covercontent.="Years of experience in your field:<b>$yearsexp</b><br>"; 
$covercontent.="Your Age:<b>$agegroup</b><br>"; 

}

else
{

$covercontent.="Nationality: <b>$additional8</b><br>";
$covercontent.="What country did you obtain your qualification?: <b>$location</b><br>";
$covercontent.="Do you have a minimum of two years experience?: <b>$additional2</b><br>";
$covercontent.="What is the status of your NZ professional registration?: <b>$additional3</b><br>";
$covercontent.="Do you have a current full clean drivers license?: <b>$additional4</b><br>";
}
if ($applicationtype=="nonhealth")
{
}
else
{
$covercontent.="When are you planning to move to New Zealand?: <b>$additional5</b><br>";
$covercontent.="Current Role: <b>$additional6</b><br>"; 
$covercontent.="<b>$ready</b><br>"; 
}

$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial');
$pdf->WriteHTML($covercontent);
//$pdf->Output();
$filecover=$timefile;
$filecover=$filecover."cover.pdf";
$filecover_name=$filecover;
$filecover="profiles/".$filecover;

$pdf->Output($filecover,'F');

?>
