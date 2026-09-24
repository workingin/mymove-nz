<?php


$user = $U->get_user_by('user_id', $user_id);
$user = $user['data'];

$Countries = new Countries($db);

$countries = $Countries->get_countries(); 
$country_name = [];
if ($countries['status']) {
    $countries = $countries['data'];

    foreach ($countries as $country) {
        $country_name[$country['country_iso3']] = $country['country_name'];
    }

} else {
    $countries = [];
}

$countries_lived = "";
$_countries_lived = explode(',', $user['user_country_lived']);
foreach ($_countries_lived as $country_lived) {

    if (!empty($countries_lived)) {
        $countries_lived .= ", ";
    }

    $countries_lived .= array_key_exists($country_lived, $country_name) ? $country_name[$country_lived] : $country_name;
}

$user_occupations = $U->get_occupations_by_user($user['user_id'], 'S');
if ($user_occupations['status']) {
    $user_occupations = $user_occupations['data'];
} else {
    $user_occupations = [];
}

$user_educations = $U->get_educations_by_user($user['user_id'], 'S');
if ($user_educations['status']) {
    $user_educations = $user_educations['data'];
} else {
    $user_educations = [];
}

$partner_occupations = $U->get_occupations_by_user($user['user_id'], 'P');
if ($partner_occupations['status']) {
    $partner_occupations = $partner_occupations['data'];
} else {
    $partner_occupations = [];
}

$partner_educations = $U->get_educations_by_user($user['user_id'], 'P');
if ($partner_educations['status']) {
    $partner_educations = $partner_educations['data'];
} else {
    $partner_educations = [];
}

$childrens = $U->get_childrens_by_user($user['user_id']);
if ($childrens['status']) {
    $childrens = $childrens['data'];
} else {
    $childrens = [];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <style>
        .container {
            font-family: 'Calibri', sans-serif;
        }
    
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: 0.5 rem;
            font-weight: 500;
            line-height: 1.2;
        }
    
        .h6,
        h6 {
            font-size: 1rem;
        }
    
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
        }
        th {
            text-align: inherit;
            text-align: -webkit-match-parent;
        }
    
        .row {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(var(--bs-gutter-y) * -1);
        margin-right: calc(var(--bs-gutter-x) * -0.5);
        margin-left: calc(var(--bs-gutter-x) * -0.5);
        }
        .row > * {
        flex-shrink: 0;
        width: 100%;
        max-width: 100%;
        padding-right: calc(var(--bs-gutter-x) * 0.5);
        padding-left: calc(var(--bs-gutter-x) * 0.5);
        margin-top: var(--bs-gutter-y);
        }
        .col-auto {
        flex: 0 0 auto;
        width: auto;
        }
        .col {
        flex: 1 0 0%;
        }
    
        .badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
        }
        b,
        strong {
        font-weight: bolder;
        }
    
        .bg-success {
            background-color: #198754 !important;
        }
        .bg-danger {
            background-color: #dc3545 !important;
        }
        .bg-primary {
            background-color: #0d6efd!important;
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0,0,0,.125);
            border-radius: 0.25rem;
        }
        .card-header {
            padding: 0.5rem 1rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }
    
        .mb-0 {
            margin-bottom: 0 !important;
        }
    
        .card-header:first-child {
        border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
        }
        .align-items-center {
        align-items: center !important;
        }
    
        .card-body {
        flex: 1 1 auto;
        padding: 1rem 1rem;
        }
    
        .table {
        --bs-table-bg: transparent;
        --bs-table-accent-bg: transparent;
        --bs-table-striped-color: #212529;
        --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
        --bs-table-active-color: #212529;
        --bs-table-active-bg: rgba(0, 0, 0, 0.1);
        --bs-table-hover-color: #212529;
        --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        vertical-align: top;
        border-color: #dee2e6;
        }
        table {
        caption-side: bottom;
        border-collapse: collapse;
        }
    
        .table > thead {
        vertical-align: bottom;
        }
        .table > tbody {
        vertical-align: inherit;
        }
    
        .table-dark {
        --bs-table-bg: #212529;
        --bs-table-striped-bg: #2c3034;
        --bs-table-striped-color: #fff;
        --bs-table-active-bg: #373b3e;
        --bs-table-active-color: #fff;
        --bs-table-hover-bg: #323539;
        --bs-table-hover-color: #fff;
        color: #fff;
        border-color: #373b3e;
        }
        .table-bordered > :not(caption) > * {
            border-width: 1px 0;
        }
        .table > :not(caption) > * > * {
        padding: 0.5rem 0.5rem;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }
        .table-bordered > :not(caption) > * > * {
        border-width: 0 1px;
        }
        .table > :not(:last-child) > :last-child > * {
        border-bottom-color: currentColor;
        }
    
        .mt-4 {
        margin-top: 1.5rem !important;
        }
        
    </style>

</head>
<body>
    <div class="container mt-4">
    <div class="row">

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h4 class="mb-0">Application</h4>
                        </div>
                        <div class="col">
                            <span class="badge bg-danger">Created <strong><?=$user['user_created']?></strong></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Step 1</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
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
                    
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="mb-0">Step 2</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="bg-primary text-center" colspan="3 "><small>NEW ZEALAND / AUSTRALIAN JOB OFFER</small></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="width: 25%;">Field</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th colspan="2">Have a job offer in New Zealand or Australia</th>
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

                            <table class="table table-bordered">
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
                            
                            <table class="table table-bordered">
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

                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="mb-0">Step 3</h6>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered">
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

                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="bg-primary text-center" colspan="3 "><small>PARTNER’S NEW ZEALAND / AUSTRALIAN JOB OFFER</small></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="width: 25%;">Field</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th colspan="2">Does your partner have a job offer in New Zealand or Australia</th>
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

                            <table class="table table-bordered">
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


                            <table class="table table-bordered">
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


                            <table class="table table-bordered">
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


                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="mb-0">Step 4</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="bg-primary text-center" colspan="3 "><small>MISCELLANEOUS</small></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="width: 25%;">Field</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th colspan="2">Have any applicants changed their name (except by marriage)?</th>
                                        <td><?=$user['user_name_change']?></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="bg-primary text-center" colspan="3 "><small>PERSONAL</small></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="width: 25%;">Field</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th colspan="2">Have you or any included family members currently under investigation or been convicted of a criminal offence at any time?</th>
                                        <td><?=$user['user_investigation']?></td>
                                    </tr>

                                    <tr>
                                        <th rowspan="2">Have any persons part of this assessment suffered any past or ongoing health or mental problems?</th>
                                        <th></th>
                                        <td><?=$user['user_mental_health']?></td>
                                    </tr>
                                    <tr>
                                        <th>Details</th>
                                        <td><?=$user['user_mental_health_details']?></td>
                                    </tr>

                                    <tr>
                                        <th rowspan="2">Have you or any included family members had a visa declined, been deported, or breached any immigration laws?</th>
                                        <th></th>
                                        <td><?=$user['user_deported']?></td>
                                    </tr>
                                    <tr>
                                        <th>Details</th>
                                        <td><?=$user['user_deported_details']?></td>
                                    </tr>
                                    
                                    <tr>
                                        <th rowspan="2">Are you or your partner pregnant?</th>
                                        <th></th>
                                        <td><?=$user['user_pregnant']?></td>
                                    </tr>
                                    <tr>
                                        <th>Details</th>
                                        <td><?=$user['user_pregnant_details']?></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="bg-primary text-center" colspan="3"><small>ENGLISH</small></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="width: 25%;">Field</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th colspan="2">Is English your first language?</th>
                                        <td><?=$user['user_english_language']?></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="bg-primary text-center" colspan="3 "><small>MOTIVATION</small></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="width: 25%;">Field</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th colspan="2">What is your level of interest in emigrating</th>
                                        <td><?=$user['user_motivation_interest']?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">What is your preferred date to emigrate</th>
                                        <td><?=$user['user_preferred_date']?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">In what area would you prefer to settle</th>
                                        <td><?=$user['user_motivation_settle']?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Which country would you like to move to</th>
                                        <td><?=$user['user_motivation_country']?></td>
                                    </tr>
                                
                                    <tr>
                                        <th rowspan="2">Is there anything specific that could delay your emigration</th>
                                        <th></th>
                                        <td><?=$user['user_motivation_delay']?></td>
                                    </tr>
                                    <tr>
                                        <th>Details</th>
                                        <td><?=$user['user_delay_details']?></td>
                                    </tr>
                                    
                                    <tr>
                                        <th rowspan="2">Have you ever visited New Zealand?</th>
                                        <th></th>
                                        <td><?=$user['user_visited_new_zealand']?></td>
                                    </tr>
                                    <tr>
                                        <th>How long visit</th>
                                        <td><?=$user['user_visited_new_zealand_long']?></td>
                                    </tr>

                                    <tr>
                                        <th rowspan="2">Have you ever visited Australia?</th>
                                        <th></th>
                                        <td><?=$user['user_visited_australia']?></td>
                                    </tr>
                                    <tr>
                                        <th>How long visit</th>
                                        <td><?=$user['user_visited_australia_long']?></td>
                                    </tr>

                                    
                                    <tr>
                                        <th colspan="2">Supply any other details here that may be relevant to your emigration plans</th>
                                        <td><?=$user['user_emigration_detail']?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>
