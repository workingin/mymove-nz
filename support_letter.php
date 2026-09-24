<?php
$coverfile="";
$timefile= $current_timestamp;

require('WriteHTML.php');
$covercontent="<h1>******** Screening Questions *********</h1><br>";
$covercontent.="Country of residence: <b>$country_residence</b><br>";

$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial');
$pdf->WriteHTML($covercontent);
//$pdf->Output();
$filecover=$timefile;
$filecover=$filecover."cover.pdf";
$filecover_name=$filecover;
$filecover="CoverLetter/".$filecover;

$pdf->Output($filecover,'F');



//	$target_dir = "./CoverLetter/";
	$target_file =$filecover;
 


 
	?>
</center>
</body>