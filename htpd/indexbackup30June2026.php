<?php

ob_start();
#error_reporting(E_ERROR | E_PARSE); // Suppress minor warnings

	# IMPORT PDF LIBRARY 
	require 'vendor/autoload.php';

	# PDF
	$liadvisername=$_GET['liadviser'];
	$visatypeentered=$_GET['visatype'];
	$iaanum = '';
	$liaemail = '';
	$liasig ='';
	$liaphone = '+64 9 580 5431';
	if($liadvisername === NULL) {
	    $liadvisername = 'Tanvi Pande';
	    $iaanum = '201200324';
	    $liaemail = 'tanvi.pande@workingin.com';
	    $liasig ='<img height="25mm" src="image1.png"/>';
	    
	} 
	
	if($liadvisername === 'Rachel Thornton') {
	    $liadvisername = 'Rachel Thornton';
	    $iaanum = '201700153';
	    $liaemail = 'rachel.thornton@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
	    
	} 
	
	
	
	if($liadvisername === 'Sameena Jaspal') {
	    $iaanum = '201900491';
	    $liaemail = 'sameena.jaspal@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
	    
	}
	
	
	
	if($liadvisername === 'Andrey Kutyaev') {
	    $iaanum = '202000213';
	    $liaemail = 'andrey.kutyaev@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
	}
	
	/* if($liadvisername === 'Monika Warszawska') {
	    $iaanum = '201701282';
	    $liaemail = 'monika.warszawska@workingin.com';
	    $liasig ='<img height="25mm" src="sig-mon.png"/>';
	    
	} */
	
	
	if($liadvisername === 'Candy Leung') {
	    $iaanum = '201100898';
	    $liaemail = 'candy.leung@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
	}

	if($liadvisername === 'Kraig Soltwedel') {
	    $iaanum = '202602328';
	    $liaemail = 'kraig.soltwedel@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
		$liaphone = '+64 9278780';
	}
	/* if($liadvisername === 'Witthawat Chalanant') {
	    $iaanum = '201600988';
	    $liaemail = 'witthawat.chalanant@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
	} */
	
	/* if($liadvisername === 'Petra Lipoth') {
	    $iaanum = '201002540';
	    $liaemail = 'petra.lipoth@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
	} */
	
	/* if($liadvisername === 'Sana Ansari') {
	    $iaanum = '201901243';
	    $liaemail = 'sana.ansari@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
	} */
	
	/* if($liadvisername === 'Sophie Sun') {
	    $iaanum = '201700578';
	    $liaemail = 'sophie.sun@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
	} */
	
	if($liadvisername === 'Hailey Long') {
	    $iaanum = '201901237';
	    $liaemail = 'hailey.long@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
	}
	
	/* if($liadvisername === 'Aaron Chen') {
	    $iaanum = '201801080';
	    $liaemail = 'aaron.chen@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
	} */
	
	if($liadvisername === 'Don Villanueva') {
	    $iaanum = '202100620';
	    $liaemail = 'don.villanueva@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
	}
	
	if($liadvisername === 'Darrell Enright') {
	    $iaanum = '201800984';
	    $liaemail = 'darrell.enright@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
	    //$liasig ='<img height="25mm" src="sig-dar.png"/>';
	}

	if($liadvisername === 'Sarah Hewitt') {
	    $iaanum = '201600296';
	    $liaemail = 'sarah.hewitt@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
	}

	if($liadvisername === 'Mia Lim') {
	    $iaanum = '202508282';
	    $liaemail = 'mia.lim@workingin.com';
	    $liasig ='<img src="sig-none.png"/>';
	}
	
	$alexname=$_GET['cname'];
	class PDF{
		# NAME
		public $thevisatype = "EMPTY_VISATYPE";
		
		public $name = "EMPTY_NAME";
		
		public $thelia = "EMPTY_LIA";
		
		public $thelianum = "EMPTY_LIANUM";
		
		public $theliaemail = "EMPTY_LIAEMAIL";
		
		public $theliasig = "EMTPY_SIG";
		public $theliaphone = "EMPTY_LIA_PHONE";
		# DATE
		public $date = NULL;

		# PAGE CONFIG
		private $page_config = [
									'mode' => 'utf-8', 
									'margin_right' => 24, # 24 mm 
									'margin_left' => 24,
									'margin_top' => 50,
									'margin_bottom' => 50,
									'margin_header' => 12,
									'margin_footer' => 12,
									'default_font_size' => 10,
								];

		/**
		 * desc Set name in PDF
		 * param <str: $name>
		 * default "<EMPTY_NAME>"
		 * */
  		function set_name($name) {
  			if(!empty($name)){
  				$this->name = $name;
  			}
  		}
  		function set_lia($thelia) {
  			if(!empty($thelia)){
  				$this->lia = $thelia;
  			}
  		}
  		
  		function set_visatype($thevisatype) {
  			if(!empty($thevisatype)){
  				$this->visatype = $thevisatype;
  			}
  		}
  		
  		function set_lianumber($thelianum) {
  			if(!empty($thelianum)){
  				$this->lianum = $thelianum;
  			}
  		}
  		
  		function set_liaemail($theliaemail) {
  			if(!empty($theliaemail)){
  				$this->liaem = $theliaemail;
  			}
  		}
  		
  		function set_liasig($theliasig) {
  			if(!empty($theliasig)){
  				$this->liasig = $theliasig;
  			}
  		}
  		function set_liaphone($theliaphone) {
  			if(!empty($theliaphone)){
  				$this->liaphone = $theliaphone;
  			}
  		}
  		/**
  		 * desc Set date in PDF
  		 * param <str: $date>
  		 * default Realtime Date (From Date())
  		 * */
  		function set_date($date){
  			if(!empty($date)){
  				$this->date = $date;
  			}
  		}
  		/**
  		 * desc This will Generates PDF of two pages
  		 * params No parameter required
  		 * return <pdf object>
  		 * Note: Use <return object>->Output('FileName.pdf', 'I') to display PDF
  		 * */
  		function generate(){
  			# PDF Object
			$pdf = new Mpdf\Mpdf($this->page_config);

			# Document Meta Data
			$pdf->SetTitle('Letter of Support');
			$pdf->SetAuthor('');
			$pdf->SetSubject('');

			# Header and Footer
			//$html_header = '<img height="25mm" src="winlogo.png" style="float: right;">';
			$html_header = '<img height="25mm" src="b2b-workingin-logo.png" style="float: right;">';
			//$html_footer = '<img height="22mm" width="100%" src="winv1.jpg">';
			$html_footer = '<img height="22mm" width="100%" src="win1.jpg">';
			$pdf->SetHTMLHeader($html_header);
			$pdf->SetHTMLFooter($html_footer);

			# Image DPI
			$pdf->img_dpi = 96;

			# Page(s)
			$pdf->AddPage();

			# Page Contents
			$html = ''; // Initialize the variable
			$html .= '<style>body{font-family: helvetica; line-height: 1.25;} p{text-align: left;}</style>';
			$html .= '<p>Date: '.($this->date ? $this->date : Date("d-m-Y")).'</p><br>';
			$html .= '<p style="font-weight: bold; color: rgb(0, 32, 96);">VISA STATUS FOR: '.$this->name.'</p>';
			$html .= '<p style="font-weight: bold; color: rgb(0, 32, 96);">'.$this->visatype.'</p>';
			$html .= '<br>';
			$html .= '<p><strong>To whom it may concern</strong><br><br>';
			$html .= 'Thank you for considering the application of '.$this->name.'. We are one of New Zealand’s largest immigration consultancies with our head office in Auckland.</p>';
			$html .= '<p>'.$this->name.' has engaged our services to assist with the application for a '.$this->visatype.' in New Zealand.</p>';
			$html .= '<p>This letter is in support of '.$this->name.', who I can confirm is eligible to apply for a work visa for New Zealand once a suitable job offer is secured.</p>';
			$html .= '<p>This eligibility is based on the assessment of our licensed immigration advisers and the information we have been provided by '.$this->name.' to date.</p>';
			$html .= '<p>In order to submit a work visa application, the applicant must have an offer of employment from an employer who is <u>both accredited with Immigration New Zealand (INZ) and has also completed the job check specific to that occupation</u>.</p>';
			$html .= '<p>If you are interested in employing '.$this->name.' and have yet to obtain accreditation or complete a job check, we can assist you in this process to ensure you meet the requirements under the policy.</p>';
			$html .= '<p>'.$this->name.' is 100% committed to living and Working In New Zealand and has the full support of our visa and relocation services.</p>';
			$html .= '<p><strong>We can confirm that</strong></p>';
			$html .= '<ul>';
			$html .= '<li>All necessary paperwork and documents required for a visa application will be vetted by our licensed immigration advisers prior to an application being lodged.</li>';
			$html .= '<li>We will check that job offers meet immigration criteria and match the skills and experience required of '.$this->name.' to lodge a successful application.</li>';
			$html .= '</ul>';
			$html .= '<p><strong>Immigration Criteria</strong></p>';
			$html .= '<ul>';
			$html .= '<li>A job offer is necessary for a work visa application to be lodged, and once the visa application is approved, the applicant can start work as soon as they arrive in New Zealand.</li>';
			$html .= '</ul>';
			$html .= '<p><strong>To help you, the employer</strong></p>';
			$html .= '<ul>';
			$html .= '<li>We will make sure the visa application process runs as quickly and smoothly as possible.</li>';
			$html .= '<li>We can offer to advise you on all mandatory employer requirements if needed.</li>';
			$html .= '<li>We will prepare and lodge the visa application and liaise with Immigration New Zealand as and when required.</li>';
			$html .= '</ul>';
			$html .= '<p>Thank you for considering '.$this->name.' for this position and if you have any questions or concerns, please let us know by contacting us on the details below.</p>';
			$html .= '<p>If you would like to know more about how we can help you employ people from offshore please have a look at our information here:</p>';
			$html .= '<a href="https://workingin.nz/immigration-solutions-for-your-business/">Immigration assistance for NZ Employers</a><br><br>';
			$html .= '<p>Kind regards,</p>';
			$html .= $this->liasig;
			$html .= '<p>';
			$html .= '<strong style="font-size: 11pt; color: rgb(0, 32, 96);">' .$this->lia.' / Licensed Immigration Adviser</strong><br>';
			$html .= '<strong style="font-size: 9pt; color: rgb(0, 32, 96);"><em>Working International Visas Limited</em></strong><br>';
			$html .= '<span>IAA Licence #'.$this->lianum.'</span>';
			$html .= '</p>';
			$html .= '<p>';
			$html .= '<strong style="font-size: 11pt; color: rgb(0, 32, 96);">Phone</strong> <span>'.$this->liaphone.' </span>';
			$html .= '<strong style="font-size: 11pt; color: rgb(0, 32, 96);">Email</strong> <span><a href="mailto:'.$this->liaem.'">'.$this->liaem.'</a></span><br>';
			$html .= '<span>2A Fitzroy Street, Ponsonby, Auckland, New Zealand 1021 / PO Box 47578 Ponsonby 1144</span>';
			$html .= '</p>';
			//$html .= '<a href="https://workingin-visas.co.nz/" style="font-weight: bold; color: rgb(150, 194, 233); text-decoration: none;">workingin-visas.co.nz </a><br>';
			$html .= '<a href="https://workingin.nz/" style="font-weight: bold; color: rgb(150, 194, 233); text-decoration: none;">workingin.nz </a><br>';
			$pdf->WriteHTML($html);

			# return pdf object
			return $pdf;
  		}
	}

	$pdf = new PDF();
	$pdf->set_name($alexname);
	$pdf->set_visatype($visatypeentered);
	$pdf->set_lia($liadvisername);
	$pdf->set_lianumber($iaanum);
	$pdf->set_liaemail($liaemail);
	$pdf->set_liasig($liasig);
	$pdf->set_liaphone($liaphone);
	#$pdf->set_date('10-02-2023');
	$pdf = $pdf->generate();
	ob_end_clean(); // Ensure no extra output before PDF generation
	$pdf->Output("Support_Letter.pdf", "I");

 ?>