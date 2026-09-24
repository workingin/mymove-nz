<?php

class UploadValidator {

    private const MAX_BYTES = 52428800; // 50 MB

    private const ALLOWED = [
        'jpg'  => ['image/jpeg'],
        'jpeg' => ['image/jpeg'],
        'png'  => ['image/png'],
        'gif'  => ['image/gif'],
        'pdf'  => ['application/pdf'],
        'doc'  => ['application/msword'],
        'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
        'ppt'  => ['application/vnd.ms-powerpoint'],
        'pptx' => ['application/vnd.openxmlformats-officedocument.presentationml.presentation'],
        'odt'  => ['application/vnd.oasis.opendocument.text'],
        'avi'  => ['video/x-msvideo', 'video/avi', 'application/vnd.avi'],
        'ogg'  => ['application/ogg', 'audio/ogg', 'video/ogg'],
        'm4a'  => ['audio/mp4', 'audio/x-m4a'],
        'mov'  => ['video/quicktime'],
        'mp3'  => ['audio/mpeg', 'audio/mp3'],
        'mp4'  => ['video/mp4'],
        'mpg'  => ['video/mpeg'],
        'wav'  => ['audio/wav', 'audio/x-wav'],
        'wmv'  => ['video/x-ms-wmv'],
    ];

    private const BLOCKED_EXTENSIONS = [
        'php', 'php3', 'php4', 'php5', 'php7', 'php8', 'phtml', 'phar', 'cgi', 'pl', 'asp', 'aspx', 'jsp', 'htaccess',
    ];

    public static function getAllowedExtensions(): array
    {
        return array_keys(self::ALLOWED);
    }

    public static function getAcceptAttribute(): string
    {
        return '.' . implode(',.', self::getAllowedExtensions());
    }

    public static function getUploadDirectory(): string
    {
        $dir = dirname(__DIR__) . '/upload/uploads/';

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        return $dir;
    }

    public static function generateStoredFilename(string $extension): string
    {
        return 'file_' . date('YmdHis') . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
    }

    public function validate(array $file): array
    {
        if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
            return ['ok' => false, 'error' => 'Upload failed. Please try again.', 'extension' => ''];
        }

        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return ['ok' => false, 'error' => 'Invalid upload.', 'extension' => ''];
        }

        if ($file['size'] > self::MAX_BYTES) {
            return ['ok' => false, 'error' => 'File exceeds the maximum allowed size of 50 MB.', 'extension' => ''];
        }

        $originalName = $file['name'] ?? '';
        if ($originalName === '' || strpos($originalName, "\0") !== false) {
            return ['ok' => false, 'error' => 'Invalid file name.', 'extension' => ''];
        }

        if (!$this->isSafeFilename($originalName)) {
            return ['ok' => false, 'error' => 'File type is not allowed.', 'extension' => ''];
        }

        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        if ($extension === '' || !isset(self::ALLOWED[$extension])) {
            return ['ok' => false, 'error' => 'File type is not allowed.', 'extension' => ''];
        }

        $mime = $this->detectMime($file['tmp_name']);
        if (!$this->isAllowedMime($extension, $mime)) {
            return ['ok' => false, 'error' => 'File content does not match the allowed type.', 'extension' => ''];
        }

        return ['ok' => true, 'error' => '', 'extension' => $extension];
    }

    private function isSafeFilename(string $filename): bool
    {
        $lower = strtolower(basename($filename));

        if (preg_match('/\.(php\d*|phtml|phar)(\.|$)/i', $lower)) {
            return false;
        }

        $parts = explode('.', $lower);
        if (count($parts) > 2) {
            foreach (array_slice($parts, 0, -1) as $part) {
                if (in_array($part, self::BLOCKED_EXTENSIONS, true)) {
                    return false;
                }
            }
        }

        return true;
    }

    private function detectMime(string $path): string
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path);
        finfo_close($finfo);

        return $mime ?: 'application/octet-stream';
    }

    private function isAllowedMime(string $extension, string $mime): bool
    {
        $allowed = self::ALLOWED[$extension];

        if (in_array($mime, $allowed, true)) {
            return true;
        }

        // Some Windows uploads report generic octet-stream for office/media files.
        if ($mime === 'application/octet-stream') {
            return true;
        }

        return false;
    }
}
