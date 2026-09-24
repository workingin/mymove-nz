<?php

class Csrf {

    private const SESSION_KEY = 'csrf_token';

    public static function generateToken(): string
    {
        if (empty($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = bin2hex(random_bytes(32));
        }

        return $_SESSION[self::SESSION_KEY];
    }

    public static function field(): string
    {
        $token = htmlspecialchars(self::generateToken(), ENT_QUOTES, 'UTF-8');
        return '<input type="hidden" name="csrf_token" value="' . $token . '">';
    }

    public static function validate(?string $token): bool
    {
        if (empty($_SESSION[self::SESSION_KEY]) || $token === null || $token === '') {
            return false;
        }

        return hash_equals($_SESSION[self::SESSION_KEY], $token);
    }

    public static function tokenFromRequest(): ?string
    {
        return $_POST['csrf_token'] ?? $_GET['csrf_token'] ?? null;
    }

    public static function queryParam(): string
    {
        return 'csrf_token=' . urlencode(self::generateToken());
    }

    public static function requireValid(?string $token): void
    {
        if (!self::validate($token)) {
            self::failRequest();
        }
    }

    public static function requireValidRequest(): void
    {
        self::requireValid(self::tokenFromRequest());
    }

    private static function failRequest(): void
    {
        $message = 'Your session expired or the security token was invalid. Please try again.';

        Flash::error($message);
        $_SESSION['error_array'] = ['form' => $message];

        if (!empty($_POST)) {
            $values = $_POST;
            unset(
                $values['password'],
                $values['conf_pass'],
                $values['curpass'],
                $values['newpass'],
                $values['conf_newpass'],
                $values['pass']
            );
            $_SESSION['value_array'] = $values;
        }

        header('Location: ' . self::resolveRedirectUrl());
        exit;
    }

    private static function resolveRedirectUrl(): string
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '';
        if ($referer !== '' && self::isSafeRedirectUrl($referer) && !self::isProcessorUrl($referer)) {
            return $referer;
        }

        $formSubmission = $_POST['form_submission'] ?? $_GET['form_submission'] ?? '';
        switch ($formSubmission) {
            case 'adminlogin':
                return self::buildAppUrl('/admin/login.php');
            case 'login':
            case 'register':
            case 'forgot_password':
                return self::buildAppUrl('/index.php');
            default:
                break;
        }

        if (!empty($_SESSION['url']) && self::isSafeRedirectUrl($_SESSION['url']) && !self::isProcessorUrl($_SESSION['url'])) {
            return $_SESSION['url'];
        }

        return self::buildAppUrl('/admin/login.php');
    }

    private static function buildAppUrl(string $path): string
    {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        return $scheme . '://' . $host . $path;
    }

    private static function isSafeRedirectUrl(string $url): bool
    {
        $parsed = parse_url($url);
        if ($parsed === false) {
            return false;
        }

        if (!isset($parsed['host'])) {
            $path = $parsed['path'] ?? '';
            return $path !== '' && strpos($path, '//') !== 0;
        }

        $currentHost = strtolower($_SERVER['HTTP_HOST'] ?? '');
        return strtolower($parsed['host']) === $currentHost;
    }

    private static function isProcessorUrl(string $url): bool
    {
        $path = parse_url($url, PHP_URL_PATH) ?? '';
        return (bool) preg_match('#/(includes/)?(process|adminprocess|logprocess|pwdprocess)\.php$#i', $path);
    }
}
