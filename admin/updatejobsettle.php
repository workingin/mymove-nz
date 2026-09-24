<?php

require_once __DIR__ . '/includes/upload_auth.php';

requireUploadAdmin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed.');
}

Csrf::requireValidRequest();

$emailaddress = trim($_POST['emailaddress'] ?? '');
$sportal = isset($_POST['sportal']) ? (int) $_POST['sportal'] : 0;
$jportal = isset($_POST['jportal']) ? (int) $_POST['jportal'] : 0;
$tportal = isset($_POST['tportal']) ? (int) $_POST['tportal'] : 0;
$supportLetterAccess = null;
if (isset($_POST['support_letter_access']) && in_array($_POST['support_letter_access'], array('both', 'aewv', 'SRV'), true)) {
    $supportLetterAccess = $_POST['support_letter_access'];
}

if ($emailaddress === '') {
    http_response_code(400);
    exit('Email address is required.');
}

$stmt = $db->prepare(
    'UPDATE users SET jportal = :jportal, sportal = :sportal, tportal = :tportal, support_letter_access = :support_letter_access WHERE email = :email'
);
$stmt->execute([
    ':jportal'               => $jportal,
    ':sportal'               => $sportal,
    ':tportal'               => $tportal,
    ':support_letter_access' => $supportLetterAccess,
    ':email'                 => $emailaddress,
]);

$redirect = rtrim($configs->getConfig('WEB_ROOT'), '/')
    . '/adminuseredit.php?usertoedit=' . urlencode($emailaddress);

header('Location: ' . $redirect);
exit;
