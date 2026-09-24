<?php

require_once '../app/start.php';


if (isset($_GET['f']) && !empty($_GET['f'])) {
    $user_id = normal_text($_GET['f']);
    $user = $U->get_user_by('user_id', $user_id);
    if ($user['status']) {
        $user = $user['data'];
    } else {
        $_SESSION['message'] = ['type' => 'error', 'data' => 'User not found.'];
        move('admin/index.php');
    }
} else {
    $_SESSION['message'] = ['type' => 'error', 'data' => 'Provide user id.'];
    move('admin/index.php');
}

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

require_once 'views/layout/header.view.php';
require_once 'views/view_data.view.php';
require_once 'views/layout/footer.view.php';
