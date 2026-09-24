<?php

require_once dirname(__DIR__) . '/includes/upload_auth.php';

requireUploadAdmin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed.');
}

Csrf::requireValid($_POST['csrf_token'] ?? null);

$userId = isset($_POST['user_id']) ? (int) $_POST['user_id'] : 0;
$filecategory = trim($_POST['filecategory'] ?? '');
$filetitle = trim($_POST['filetitle'] ?? '');

assertUserOwnsGroup($db, $session, $userId);

if ($filetitle === '') {
    http_response_code(400);
    exit('File title is required.');
}

if (!isset($_FILES['fileToUpload'])) {
    http_response_code(400);
    exit('No file was uploaded.');
}

$validator = new UploadValidator();
$validation = $validator->validate($_FILES['fileToUpload']);

if (!$validation['ok']) {
    http_response_code(400);
    exit($validation['error']);
}

$uploadDir = UploadValidator::getUploadDirectory();
$storedFilename = UploadValidator::generateStoredFilename($validation['extension']);
$targetPath = $uploadDir . $storedFilename;

if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetPath)) {
    http_response_code(500);
    exit('Failed to save the uploaded file.');
}

$repo = new UploadedFilesRepository($db);

if (!$repo->insert($storedFilename, $userId, $filecategory, $filetitle)) {
    @unlink($targetPath);
    http_response_code(500);
    exit('Failed to record the uploaded file.');
}

header('Location: ' . adminFilesReportUrl($configs));
exit;
