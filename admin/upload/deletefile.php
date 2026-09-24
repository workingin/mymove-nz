<?php

require_once dirname(__DIR__) . '/includes/upload_auth.php';

requireUploadAdmin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed.');
}

Csrf::requireValid($_POST['csrf_token'] ?? null);

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$filename = trim($_POST['filename'] ?? '');

if ($id <= 0 || $filename === '') {
    http_response_code(400);
    exit('Invalid delete request.');
}

if (basename($filename) !== $filename || preg_match('/[^a-zA-Z0-9._-]/', $filename)) {
    http_response_code(400);
    exit('Invalid file name.');
}

$repo = new UploadedFilesRepository($db);
$fileRow = $repo->findById($id);

if ($fileRow === null) {
    http_response_code(404);
    exit('File not found.');
}

if ($fileRow['filename'] !== $filename) {
    http_response_code(400);
    exit('File details do not match.');
}

if (!userCanAccessUploadedFile($db, $session, $fileRow)) {
    http_response_code(403);
    exit('You are not allowed to delete this file.');
}

$uploadDir = UploadValidator::getUploadDirectory();
$filePath = $uploadDir . $fileRow['filename'];

if (!$repo->deleteById($id)) {
    http_response_code(500);
    exit('Failed to delete file record.');
}

if (is_file($filePath)) {
    @unlink($filePath);
}
Flash::success('File deleted successfully.');
header('Location: ' . adminFilesReportUrl($configs));
exit;
