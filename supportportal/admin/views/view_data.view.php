<?
if ($user['cvfile']!==NULL)
{
    
if ($_GET["cvview"]=="1")
{
?>
 <html xmlns="http://www.w3.org/1999/xhtml">    
  <head>      
    
    <meta http-equiv="refresh" content="0;URL='/mvp/cvresumes/<?echo $user['cvfile'];?>'" />    
  </head>  
    <?

                          }
                          else
                          {
                              
                          }
                          
                         }
                          else
                          {
                              
                          }
?>


 <style>
                    .container{max-width:100%;margin:auto}.title{text-align:center;font-family:Arial;margin-top:50px;margin-bottom:50px}.accordion__item{margin-bottom:10px}.accordion__item__header{background-color:#003349;padding:15px;cursor:pointer;position:relative;color:#fff;font-family:Arial;font-weight:400;font-size:20px}.accordion__item__header::before{height:15px;width:15px;content:"";position:absolute;right:15px;top:15px;transition:.5s all;transform:rotate(45deg);border-right:2px solid #fff;border-bottom:2px solid #fff}.accordion__item__header.active{background-color:#33a0ff;color:#fff;transition:.4s}.accordion__item__header.active::before{transform:rotate(-135deg);top:23px}.accordion__item__content{overflow-y:hidden;padding:0;display:none}
.steps-inner {
    width: 90%;
    max-width: 100%;

}
.table-bordered > :not(caption) > * {
    border-width: 1px 0;
    color: #000;
}
.bg-primary {
    background-color: #003d7c !important;
    color: #fff !important;
}
.headadmin
{
    display:none;
}
.accordion__item__header
{
    font-size: 1.2em;
text-transform: uppercase;
margin-bottom: 11px;

color: #fff;
font-weight: 500;
font-family: 'Poppins', sans-serif;
}
.bg-primary {
    background-color: #003d7c !important;
}
              .badge {
    display: inline-block;
    padding: 8px;
    font-size: .75em;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25rem;
    margin-left: 8px;
    margin-top: 14px;
}  </style>
                
            
<div class="container mt-4">
    <div class="row">

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto col-sm-12">
                            <h4 class="mb-0">&nbsp;MVP Form of : <?=$user['user_first_name']?> <?=$user['user_last_name']?></h4>
                        </div>
                        <div class="col">
                            <span class="badge bg-success"><strong><?=$user['user_form_status']?></strong> complete</span>
                            <span class="badge bg-danger">Created <strong><?=$user['user_created']?></strong></span>
                        </div>
                        
                        
                        <?
                        
                         if ($user['cvfile']!==NULL)
                         
                         {
                ?>
                           <div class="col-auto"> <a href="../cvresumes/<? echo $user['cvfile']?>" target="_blank" id="" class="btn btn-sm btn-primary" style="background:#84c529;">Download CV/Resume</a></div>
                            <?}
                            else
                            {
                                ?>
                                <div class="col-auto"> <span style="border:1px solid #000;padding:4px;color:##5d1803;">CV/Resume not uploaded yet</span></div>
                                
                                
                                
                                <?
                            }
                            ?>
                            
                    
                        <div class="col-auto">
                            <a href="<?=href('admin/view_data.php?f='.$user['user_id'], false)?>" class="btn btn-sm btn-primary">Refresh</a>
                            
                        </div>
                    </div>
                </div>
       <div class="container">
        <div class="accordion">
	
      <div class="accordion__item">
        <div class="accordion__item__header">
         <b>STEP 1:</b> BASIC INFORMATION ABOUT YOU
        </div>
    
        <div class="accordion__item__content">
                        
                                <table class="table table-bordered" style="min-width: 500px">
                                    <thead class="table-dark">
                                        <th colspan="2" style="width: 25%;">Field</th>
                                        <th>Value</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">Name</th>
                                            <th>First Name</th>
                                            <td><?=$user['user_first_name']?></td>
                                        </tr>
                                        <tr>
                                            <th>Last Name</th>
                                            <td><?=$user['user_last_name']?></td>
                                        </tr>

                                        <tr>
                                            <th colspan="2">Email</th>
                                            <td><?=$user['user_email']?></td>
                                        </tr>
                                        
                                        <tr>
                                            <th colspan="2">Phone</th>
                                            <td><?=$user['user_phone']?></td>
                                        </tr>

                                        <tr>
                                            <th rowspan="2">Address</th>
                                            <th>Line 1</th>
                                            <td><?=$user['user_address']?></td>
                                        </tr>
                                        <tr>
                                            <th>Line 2</th>
                                            <td><?=$user['user_address2']?></td>
                                        </tr>

                                        
                                        <tr>
                                            <th colspan="2">City</th>
                                            <td><?=$user['user_city']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Country Citizenship</th>
                                            <td><?=!empty($user['user_country']) ? (array_key_exists($user['user_country'], $country_name) ? $country_name[$user['user_country']] : $user['user_country']) :''?></td>
                                        </tr>

                                        
                                        <tr>
                                            <th colspan="2">Date of Birth</th>
                                            <td><?=normal_date($user['user_dob'], 'M d, Y')?></td>
                                        </tr>
                                        
                                        <tr>
                                            <th colspan="2">Country lived for 5 years or more</th>
                                            <td><?=!empty($user['user_country_lived'])?$countries_lived:''?></td>
                                        </tr>
                                    </tbody>
                                </table>
                       </div>
      </div>
                    
     <div class="accordion__item">
        <div class="accordion__item__header">
         <b>STEP 2:</b> ABOUT YOUR WORK HISTORY AND YOUR EDUCATION
        </div>
    
        <div class="accordion__item__content"> <div class="table-responsive">
                                <table class="table table-bordered" style="min-width: 500px">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="bg-primary text-center" colspan="3 "><small>AUSTRALIAN JOB OFFER</small></th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="width: 25%;">Field</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="2">Do you have a job offer in Australia?</th>
                                            <td><?=$user['user_job_offer']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Job title</th>
                                            <td><?=$user['user_job_title']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Is the job offer relevant to your work experience?</th>
                                            <td><?=$user['user_job_experience']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Is the job offer relevant to your qualification?</th>
                                            <td><?=$user['user_job_qualification']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Is the job offer a permanent position?</th>
                                            <td><?=$user['user_job_permanent']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            
                            <div class="table-responsive">
                                <table class="table table-bordered" style="min-width: 500px">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="bg-primary text-center" colspan="3 "><small>EMPLOYMENT HISTORY</small></th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="width: 25%;">Field</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="6">Current Occupation</th>
                                            <th>Company</th>
                                            <td><?=$user['user_current_company']?></td>
                                        </tr>
                                        <tr>
                                            <th>Position</th>
                                            <td><?=$user['user_current_position']?></td>
                                        </tr>
                                        <tr>
                                            <th>Start Date</th>
                                            <td><?=$user['user_current_start']?></td>
                                        </tr>
                                        <tr>
                                            <th>End Date</th>
                                            <td><?=$user['user_current_end']?></td>
                                        </tr>
                                        <tr>
                                            <th>Type</th>
                                            <td><?=$user['user_current_type']?></td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td><?=$user['user_current_description']?></td>
                                        </tr>

                                        <?php foreach ($user_occupations as $i => $occupation): ?>
                                                <tr>
                                                    <th rowspan="6"><span class="badge bg-primary"><?=($i+1)?></span> Previous Occupation</th>
                                                    <th>Company</th>
                                                    <td><?=$occupation['user_job_company']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Position</th>
                                                    <td><?=$occupation['user_job_position']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Start Date</th>
                                                    <td><?=$occupation['user_job_start']?></td>
                                                </tr>
                                                <tr>
                                                    <th>End Date</th>
                                                    <td><?=$occupation['user_job_end']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Type</th>
                                                    <td><?=$occupation['user_job_type']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Description</th>
                                                    <td><?=$occupation['user_job_description']?></td>
                                                </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            
                            <div class="table-responsive">
                                <table class="table table-bordered" style="min-width: 500px">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="bg-primary text-center" colspan="3 "><small>EDUCATION</small></th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="width: 25%;">Field</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="2">Highest qualification</th>
                                            <td><?=$user['user_education_highest']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Other qualification</th>
                                            <td><?=$user['user_education_other']?></td>
                                        </tr>

                                        <?php foreach ($user_educations as $i => $education): ?>
                                                <tr>
                                                    <th rowspan="6"><span class="badge bg-primary"><?=($i+1)?></span> Education</th>
                                                    <th>Title of Qualification</th>
                                                    <td><?=$education['user_education_title']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Subject/major</th>
                                                    <td><?=$education['user_education_major']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Institute/University</th>
                                                    <td><?=$education['user_education_institute']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Study type</th>
                                                    <td><?=$education['user_education_qualification']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Certificate Available</th>
                                                    <td><?=$education['user_education_certificate']?></td>
                                                </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                      </div>
                    </div>

                      <div class="accordion__item">
        <div class="accordion__item__header">
         <b>STEP 3:</b> ABOUT YOUR PARTNER & CHILDREN
        </div>
    
        <div class="accordion__item__content">
<div class="table-responsive">
                                <table class="table table-bordered" style="min-width: 500px">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="bg-primary text-center" colspan="3 "><small>PARTNER</small></th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="width: 25%;">Field</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">Partner Name</th>
                                            <th>First Name</th>
                                            <td><?=$user['user_partner_first_name']?></td>
                                        </tr>
                                        <tr>
                                            <th>Last Name</th>
                                            <td><?=$user['user_partner_last_name']?></td>
                                        </tr>

                                        <tr>
                                            <th colspan="2">Partner's date of birth</th>
                                            <td><?=$user['user_partner_dob']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Partner Country of citizenship</th>
                                            <td><?=$user['user_partner_country']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Partner's marital status</th>
                                            <td><?=$user['user_partner_marital']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Date of marriage</th>
                                            <td><?=$user['user_partner_marriage_date']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Relationship start date</th>
                                            <td><?=$user['user_relationship_start']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">How long lived together</th>
                                            <td><?=$user['user_partner_lived']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Relationship Evidence</th>
                                            <td><?=$user['user_partner_evidence']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Married before</th>
                                            <td><?=$user['user_partner_married_before']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Previously married is divorce final and legal</th>
                                            <td><?=$user['user_divorce_final']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Child custody issues been resolved</th>
                                            <td><?=$user['user_divorce_child_custody']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Who has custody of children</th>
                                            <td><?=$user['user_child_custody']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Estimated total value of assets</th>
                                            <td><?=$user['user_asset_value']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            
                            <div class="table-responsive">
                                <table class="table table-bordered" style="min-width: 500px">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="bg-primary text-center" colspan="3 "><small>PARTNER’S AUSTRALIA JOB OFFER</small></th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="width: 25%;">Field</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="2">Does your partner have a job offer in Australia </th>
                                            <td><?=$user['user_partner_job_in']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">What position have you been offered</th>
                                            <td><?=$user['user_partner_job_position']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Is the job offer relevant to your qualification</th>
                                            <td><?=$user['user_partner_job_qualification']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Is the job offer relevant to work experience</th>
                                            <td><?=$user['user_partner_job_experience']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Is the job offer a permanent position</th>
                                            <td><?=$user['user_partner_job_permanent']?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
 <div class="table-responsive">
                                <table class="table table-bordered" style="min-width: 500px">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="bg-primary text-center" colspan="3 "><small>PARTNER’S CV/RESUME</small></th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="width: 25%;">CV/REUME</th>
                                            <th>CV/RESUME FILE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="2"></th>
                                           <td><a href="/mvp/cvresumes/<?=$user['partner_cv']?>" target="_blank"><b><?=$user['partner_cv']?></b></a></td>
                                        </tr>
                               

                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered" style="min-width: 500px">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="bg-primary text-center" colspan="3 "><small>PARTNER’S EMPLOYMENT HISTORY</small></th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="width: 25%;">Field</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="6">Current Occupation</th>
                                            <th>Company</th>
                                            <td><?=$user['user_partner_current_company']?></td>
                                        </tr>
                                        <tr>
                                            <th>Position</th>
                                            <td><?=$user['user_partner_current_position']?></td>
                                        </tr>
                                        <tr>
                                            <th>Start Date</th>
                                            <td><?=$user['user_partner_current_start']?></td>
                                        </tr>
                                        <tr>
                                            <th>End Date</th>
                                            <td><?=$user['user_partner_current_end']?></td>
                                        </tr>
                                        <tr>
                                            <th>Type</th>
                                            <td><?=$user['user_partner_current_type']?></td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td><?=$user['user_partner_current_description']?></td>
                                        </tr>

                                        <?php foreach ($partner_occupations as $i => $occupation): ?>
                                                <tr>
                                                    <th rowspan="6"><span class="badge bg-primary"><?=($i+1)?></span> Previous Occupation</th>
                                                    <th>Company</th>
                                                    <td><?=$occupation['user_job_company']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Position</th>
                                                    <td><?=$occupation['user_job_position']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Start Date</th>
                                                    <td><?=$occupation['user_job_start']?></td>
                                                </tr>
                                                <tr>
                                                    <th>End Date</th>
                                                    <td><?=$occupation['user_job_end']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Type</th>
                                                    <td><?=$occupation['user_job_type']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Description</th>
                                                    <td><?=$occupation['user_job_description']?></td>
                                                </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            
                            <div class="table-responsive">
                                <table class="table table-bordered" style="min-width: 500px">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="bg-primary text-center" colspan="3 "><small>PARTNER’S EDUCATION</small></th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="width: 25%;">Field</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="2">Highest qualification</th>
                                            <td><?=$user['user_partner_education_highest']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Other qualification</th>
                                            <td><?=$user['user_partner_education_other']?></td>
                                        </tr>

                                        <?php foreach ($partner_educations as $i => $education): ?>
                                                <tr>
                                                    <th rowspan="6"><span class="badge bg-primary"><?=($i+1)?></span> Education</th>
                                                    <th>Title of Qualification</th>
                                                    <td><?=$education['user_education_title']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Subject/major</th>
                                                    <td><?=$education['user_education_major']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Institute/University</th>
                                                    <td><?=$education['user_education_institute']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Study type</th>
                                                    <td><?=$education['user_education_qualification']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Certificate Available</th>
                                                    <td><?=$education['user_education_certificate']?></td>
                                                </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>


                            <div class="table-responsive">
                                <table class="table table-bordered" style="min-width: 500px">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="bg-primary text-center" colspan="3 "><small>CHILDREN</small></th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="width: 25%;">Field</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="2">How many of these children are emigrating with you</th>
                                            <td><?=$user['user_children_emigrating']?></td>
                                        </tr>

                                        <?php foreach ($childrens as $i => $child): ?>
                                        <tr>
                                            <th rowspan="3"><span class="badge bg-primary"><?=($i+1)?></span> Child</th>
                                            <th>Name</th>
                                            <td><?=$child['user_children_name']?></td>
                                        </tr>
                                        <tr>
                                            <th>Date of Birth</th>
                                            <td><?=$child['user_children_dob']?></td>
                                        </tr>
                                        <tr>
                                            <th>Country of citizenship</th>
                                            <td><?=array_key_exists($child['user_children_country'], $country_name) ? $country_name[$child['user_children_country']] : $child['user_children_country']?></td>
                                        </tr>
                                        <?php endforeach; ?>

                                        <tr>
                                            <th colspan="2">Are there any children from previous relationships, whether emigrating or not?</th>
                                            <td><?=$user['user_children_previous']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Are there any children that are not your biological child</th>
                                            <td><?=$user['user_children_biological']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Are there any children that are not single</th>
                                            <td><?=$user['user_children_single']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Are there any children that have a child of their own</th>
                                            <td><?=$user['user_children_child']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Are there any children that are financially supporting themselves</th>
                                            <td><?=$user['user_children_self_support']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Are there any children intending to undertake tertiary studies</th>
                                            <td><?=$user['user_children_tertiary']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                       </div>
                    </div>


                      <div class="accordion__item">
        <div class="accordion__item__header">
         <b>STEP 4:</b> About your health and background and when you would like to move
        </div>
    
        <div class="accordion__item__content"><div class="table-responsive">
                               <table class="table table-dark table-bordered">
                            
                                <tbody>
                                    <tr>
                                        <th >Is English your first language?</th>
                                        <td><?=$user['user_english_language']?></td>
                                    </tr>
                                    <tr>
                                        <th >Have you ever visited Australia?</th>
                                        
                                        <td><?=$user['user_visited_new_zealand']?></td>
                                    </tr>
                                    <tr>
                                        <th>How long visit</th>
                                        <td><?=$user['user_visited_new_zealand_long']?></td>
                                    </tr>
                                    
                                         <tr>
                                        <th >Supply any other details here that may be relevant to your emigration plans</th>
                                        <td><?=$user['user_emigration_detail']?></td>
                                    </tr>
                                    
                                             <tr>
                                        <th >Do you own your own home?</th>
                                        <td><?=$user['ownhome']?></td>
                                    </tr>
      <tr>
                                        <th >Property equity:</th>
                                        <td><?=$user['equity']?></td>
                                    </tr>
                                          <tr>
                                        <th >Assets:</th>
                                        <td><?=$user['assets']?></td>
                                    </tr>
                                          <tr>
                                        <th >Value of vehicles:</th>
                                        <td><?=$user['value_vehicles']?></td>
                                    </tr>
                                          <tr>
                                        <th >Valuables:</th>
                                        <td><?=$user['valuables']?></td>
                                    </tr>      <tr>
                                        <th >Savings/cash:</th>
                                        <td><?=$user['savingcash']?></td>
                                    </tr>      <tr>
                                        <th >Value of shares/stocks/investments</th>
                                        <td><?=$user['sharestocks']?></td>
                                    </tr>
                                          <tr>
                                        <th >Other Finance</th>
                                        <td><?=$user['otherfinance']?></td>
                                    </tr>      <tr>
                                        <th >Do you own a business?</th>
                                        <td><?=$user['ownbusiness']?></td>
                                    </tr>
                                    
                                          <tr>
                                        <th >Senior executive?</th>
                                        <td><?=$user['seniorex']?></td>
                                    </tr>
                                    
                                          <tr>
                                        <th >Number of employees:</th>
                                        <td><?=$user['employees']?></td>
                                    </tr>
                                          <tr>
                                        <th >Annual turnover:</th>
                                        <td><?=$user['turnover']?></td>
                                    </tr>
                                          <tr>
                                        <th >Share of ownership:</th>
                                        <td><?=$user['ownership']?></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <table class="table table-dark table-bordered">
                                <thead class="table-dark">
                                                            </thead>
                                <tbody>
                                    <tr>
                                        <th >Are you planning to open a business or invest in Australia?</th>
                                        <td><?=$user['openbusiness']?></td>
                                    </tr>
                                    <tr>
                                        <th >Please state the type of business or investment that interests you below:</th>
                                        <td><?=$user['typebusiness']?></td>
                                    </tr>
                                    
                                    
                                    
                                  

                                    
                               
                                </tbody>

                            </table> <br> Have you or any of those accompanying you ever:</b>
<table class="table table-dark table-bordered">
                            
                                <tbody>
                                    <tr>
                                        <th >Been refused a visa to any country? If Yes, Provide details:</th>
                                        <td><?=$user['refused']?></td>
                                    </tr>
                                    <tr>
                                        <th >Applied for a residence visa to your destination country and been refused?If Yes, Provide Details:</th>
                                        
                                        <td><?=$user['residencevisa']?></td>
                                    </tr>
                                    <tr>
                                        <th>Been charged with an offence of any kind, convicted, and/or sentenced to detention?If Yes, Provide Details:</th>
                                        <td><?=$user['sentenced']?></td>
                                    </tr>
                                    
                                         <tr>
                                        <th >Been deported from a country?If Yes, Provide Details:</th>
                                        <td><?=$user['deported']?></td>
                                    </tr>
                                    
                                             <tr>
                                        <th >Committed a criminal offence or acts against humanity?If Yes, Provide Details:</th>
                                        <td><?=$user['humanity']?></td>
                                    </tr>
      <tr>
                                        <th >Been under investigation by a law enforcement agency or civil legal proceedings in any country?if Yes, Provide Details:</th>
                                        <td><?=$user['enforcement']?></td>
                                    </tr>
                                          <tr>
                                        <th >Suffered from any previous or ongoing health or mental health problems?If Yes, Provide Details:</th>
                                        <td><?=$user['mental']?></td>
                                    </tr>
                                          <tr>
                                        <th >Required to take any regular medication?If Yes, Provide Details:</th>
                                        <td><?=$user['medication']?></td>
                                    </tr>
                                 
                                    
                                </tbody>
                            </table>
                         </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> </div></div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="../js/accordion.js"></script>
