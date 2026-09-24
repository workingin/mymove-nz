<?php

ob_start();
#error_reporting(E_ERROR | E_PARSE); // Suppress minor warnings

require_once __DIR__ . '/../admin/includes/controller.php';

if (!$session->logged_in) {
	http_response_code(403);
	exit('Access denied.');
}

$supportLetterRepo = new SupportLetterAccessRepository($db);
$supportLetterAccess = $supportLetterRepo->getAccessType((int) $session->id);
$visatypeentered = trim($_GET['visatype'] ?? '');

if ($visatypeentered === '' || !$supportLetterRepo->canAccessVisaType($supportLetterAccess, $visatypeentered)) {
	http_response_code(403);
	exit('You do not have access to this support letter.');
}

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
									'margin_top' => 40,
									'margin_bottom' => 40,
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
			$html .= '<style>body{font-family: helvetica; line-height: 1.25;} p{text-align: left;} ul.dash-list{list-style-type: none; padding-left: 2em; margin: 0.25em 0;} .sign-off{margin:0; padding:0;} .sign-off p{margin:0;} .sign-off img{margin:0; display:block;}</style>';
			$html .= '<p>Date: '.($this->date ? $this->date : Date("d-m-Y")).'</p>';
			$html .= '<p><strong>Applicant:</strong> '.$this->name.'<br>';
			$html .= '<strong>Visa Pathway:</strong> '.$this->visatype.'</p>';
			$html .= '<br>';
			$html .= '<p><strong>To whom it may concern,</strong></p>';

			if ($this->visatype === 'Straight to Residence Visa') {
				$html .= '<p>Thank you for considering the application of '.$this->name.' who has engaged our services to assist with their migration to New Zealand.</p>';
				$html .= '<p>Working International Visas Limited (Working In) is one of New Zealand\'s largest immigration consultancies, with a team of Licensed Immigration Advisers based in Auckland.</p>';
				$html .= '<p>Following a full assessment of '.$this->name.'\'s provided information, they appear eligible for New Zealand\'s Straight to Residence pathway, subject to securing a role that meets Immigration New Zealand\'s requirements.</p>';
				$html .= '<p>This pathway grants eligible highly skilled individuals direct residency rather than requiring work visas, and is designed to solve skill shortages in New Zealand.</p>';
				$html .= '<p>'.$this->name.' is seeking a long-term career and permanent future in New Zealand. Their intention is to establish themselves, contribute to their profession, and become a long-term member of the local community.</p>';
				$html .= '<p>We can confirm that '.$this->name.'\'s qualifications, employment background and supporting documentation have been assessed by our Licensed Immigration Advisers and that they are actively preparing for relocation to New Zealand.</p>';
				$html .= '<p>Should you wish to employ '.$this->name.', our team can:</p>';
				$html .= '<ul>';
				$html .= '<li>Assess whether the role meets the Straight to Residence requirements;</li>';
				$html .= '<li>Advise on any employer obligations;</li>';
				$html .= '<li>Prepare and lodge the residence application;</li>';
				$html .= '<li>Liaise directly with Immigration New Zealand; and</li>';
				$html .= '<li>Support both the applicant and employer throughout the immigration process.</li>';
				$html .= '</ul>';
				$html .= '<p>For employers, the Straight to Residence pathway can provide an opportunity to recruit a highly skilled worker who is seeking a long-term future in New Zealand and intends to remain and contribute to the sector for many years to come.</p>';
				$html .= '<p>Thank you for considering '.$this->name.' for employment. Should you require any information regarding the immigration process or employer obligations, please do not hesitate to contact us.</p>';
			} else {
				// Accredited Employer Work Visa (AEWV)
				$html .= '<p>Thank you for considering the application of '.$this->name.' who has engaged our services to assist with their migration to New Zealand.</p>';
				$html .= '<p>Working International Visas Limited (Working In) is one of New Zealand\'s largest immigration consultancies, with a team of Licensed Immigration Advisers based in Auckland.</p>';
				$html .= '<p>Following a full assessment of '.$this->name.'\'s provided information, they appear eligible to apply for an Accredited Employer Work Visa once a suitable job offer is secured.</p>';
				$html .= '<p>'.$this->name.' is committed to relocating to New Zealand and establishing their New Zealand career long-term. They are actively preparing for their move and their qualifications, employment background and supporting documentation have been assessed by our Licensed Immigration Advisers.</p>';
				$html .= '<p>Should you choose to employ '.$this->name.', our team can support both the applicant and employer through the immigration process. This includes:</p>';
				$html .= '<ul class="dash-list">';
				$html .= '<li>- assessing the role against Immigration New Zealand requirements.</li>';
				$html .= '<li>- confirming visa eligibility.</li>';
				$html .= '<li>- assisting with employer accreditation and Job Check requirements where necessary.</li>';
				$html .= '<li>- preparing and lodging the visa application.</li>';
				$html .= '</ul>';
				$html .= '<p>Employing a candidate through the Accredited Employer Work Visa pathway can provide access to skilled international talent while ensuring a supported and compliant immigration process.</p>';
				$html .= '<p>Thank you for considering '.$this->name.' for employment. Should you require any information regarding the immigration process or employer obligations, please do not hesitate to contact us.</p>';
			}

			$html .= '<div class="sign-off">';
			$html .= '<p>Kind regards,</p>';
			$html .= $this->liasig;
			$html .= '<p>';
			$html .= '<strong style="font-size: 11pt; color: rgb(0, 32, 96);">' .$this->lia.' / Licensed Immigration Adviser</strong><br>';
			$html .= '<strong style="font-size: 9pt; color: rgb(0, 32, 96);"><em>Working International Visas Limited</em></strong><br>';
			$html .= '<span>IAA Licence #'.$this->lianum.'</span>';
			$html .= '</p>';
			$html .= '<p>';
			$html .= '<strong style="font-size: 11pt; color: rgb(0, 32, 96);">Phone</strong> <span>'.$this->liaphone.' </span><br>';
			$html .= '<strong style="font-size: 11pt; color: rgb(0, 32, 96);">Email</strong> <span><a href="mailto:'.$this->liaem.'">'.$this->liaem.'</a></span><br>';
			$html .= '</p>';
			$html .= '</div>';
			//$html .= '<a href="https://workingin-visas.co.nz/" style="font-weight: bold; color: rgb(150, 194, 233); text-decoration: none;">workingin-visas.co.nz </a><br>';
			$html .= '<p>2A Fitzroy Street, Ponsonby, Auckland, New Zealand 1021 / PO Box 47578 Ponsonby 1144</p>';
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