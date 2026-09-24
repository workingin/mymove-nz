<?php

require_once __DIR__ . '/includes/cms_image_validation.php';

header('Content-Type: application/json');

$admincms = $_GET['admincms'] ?? $_POST['admincms'] ?? '';
if ($admincms !== 'cmsadmin') {
    http_response_code(403);
    echo json_encode(['data' => ['error' => 'Access denied.']]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_FILES['image']['tmp_name'])) {
    http_response_code(400);
    echo json_encode(['data' => ['error' => 'No image uploaded.']]);
    exit;
}

$validation = cmsValidateImageUpload($_FILES['image']);
if (!$validation['valid']) {
    http_response_code(400);
    echo json_encode(['data' => ['error' => $validation['error']]]);
    exit;
}

$uploadDir = __DIR__ . '/img/';
if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
    http_response_code(500);
    echo json_encode(['data' => ['error' => 'Upload directory is not available.']]);
    exit;
}

$filename = cmsGenerateImageFilename('editor_', $validation['extension']);
$targetPath = $uploadDir . $filename;

if (!cmsSaveOptimizedImage($_FILES['image']['tmp_name'], $targetPath, $validation['extension'])) {
    http_response_code(500);
    echo json_encode(['data' => ['error' => 'Could not save uploaded image.']]);
    exit;
}

$savedImageInfo = @getimagesize($targetPath);

echo json_encode([
    'data' => [
        'link' => '/admin/img/' . $filename,
        'width' => $savedImageInfo ? $savedImageInfo[0] : null,
    ],
]);
