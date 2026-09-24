<?php

define('CMS_IMAGE_MAX_BYTES', 2 * 1024 * 1024);

function cmsValidateImageUpload(array $file): array
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return ['valid' => false, 'error' => 'No image uploaded.', 'extension' => null];
    }

    if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
        return ['valid' => false, 'error' => 'Image upload failed. Please try again.', 'extension' => null];
    }

    if (($file['size'] ?? 0) > CMS_IMAGE_MAX_BYTES) {
        return ['valid' => false, 'error' => 'Image must be 2 MB or smaller.', 'extension' => null];
    }

    $imageInfo = @getimagesize($file['tmp_name']);
    if ($imageInfo === false) {
        return ['valid' => false, 'error' => 'Only image files are allowed (JPEG, PNG, GIF, WEBP).', 'extension' => null];
    }

    $allowedTypes = [
        IMAGETYPE_JPEG => 'jpg',
        IMAGETYPE_PNG => 'png',
        IMAGETYPE_GIF => 'gif',
        IMAGETYPE_WEBP => 'webp',
    ];

    if (!isset($allowedTypes[$imageInfo[2]])) {
        return ['valid' => false, 'error' => 'Unsupported image type. Allowed: JPEG, PNG, GIF, WEBP.', 'extension' => null];
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = $finfo ? finfo_file($finfo, $file['tmp_name']) : '';
    if ($finfo) {
        finfo_close($finfo);
    }

    $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mime, $allowedMimes, true)) {
        return ['valid' => false, 'error' => 'Only image files are allowed (JPEG, PNG, GIF, WEBP).', 'extension' => null];
    }

    return [
        'valid' => true,
        'error' => '',
        'extension' => $allowedTypes[$imageInfo[2]],
    ];
}

function cmsGenerateImageFilename(string $prefix, string $extension): string
{
    return $prefix . date('YmdHis') . '_' . bin2hex(random_bytes(4)) . '.' . $extension;
}

define('CMS_IMAGE_JPEG_QUALITY', 82);
define('CMS_IMAGE_WEBP_QUALITY', 82);
define('CMS_IMAGE_PNG_COMPRESSION', 6);

/**
 * Re-encodes an uploaded image at its original dimensions to cut file size
 * (JPEG/WEBP quality, PNG compression level) without altering width/height.
 * Falls back to a plain move_uploaded_file if GD is unavailable or decoding fails,
 * so an upload never hard-fails because of this optimization step.
 */
function cmsSaveOptimizedImage(string $tmpPath, string $destPath, string $extension): bool
{
    if (!is_uploaded_file($tmpPath)) {
        return false;
    }

    if (!function_exists('imagecreatetruecolor')) {
        return move_uploaded_file($tmpPath, $destPath);
    }

    switch ($extension) {
        case 'jpg':
        case 'jpeg':
            $source = @imagecreatefromjpeg($tmpPath);
            break;
        case 'png':
            $source = @imagecreatefrompng($tmpPath);
            break;
        case 'gif':
            $source = @imagecreatefromgif($tmpPath);
            break;
        case 'webp':
            $source = function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($tmpPath) : false;
            break;
        default:
            $source = false;
    }

    if (!$source) {
        return move_uploaded_file($tmpPath, $destPath);
    }

    if ($extension === 'png' || $extension === 'webp') {
        // Without these, GD silently drops the alpha channel on save even though it read it fine.
        imagealphablending($source, false);
        imagesavealpha($source, true);
    }

    switch ($extension) {
        case 'jpg':
        case 'jpeg':
            $saved = imagejpeg($source, $destPath, CMS_IMAGE_JPEG_QUALITY);
            break;
        case 'png':
            $saved = imagepng($source, $destPath, CMS_IMAGE_PNG_COMPRESSION);
            break;
        case 'gif':
            $saved = imagegif($source, $destPath);
            break;
        case 'webp':
            $saved = function_exists('imagewebp') ? imagewebp($source, $destPath, CMS_IMAGE_WEBP_QUALITY) : false;
            break;
        default:
            $saved = false;
    }

    imagedestroy($source);

    if (!$saved) {
        return move_uploaded_file($tmpPath, $destPath);
    }

    return true;
}
