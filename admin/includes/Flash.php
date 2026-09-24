<?php

class Flash
{
    private const SESSION_KEY = 'flash_messages';

    public static function success(string $message): void
    {
        self::add('success', $message);
    }

    public static function error(string $message): void
    {
        self::add('error', $message);
    }

    public static function warning(string $message): void
    {
        self::add('warning', $message);
    }

    public static function message(string $message): void
    {
        self::add('message', $message);
    }

    public static function redirect(string $url, string $type, string $message): void
    {
        self::add($type, $message);
        header('Location: ' . $url);
        exit;
    }

    public static function consume(): array
    {
        $messages = $_SESSION[self::SESSION_KEY] ?? [];

        if (!empty($_SESSION['flash_error'])) {
            $messages[] = ['type' => 'error', 'message' => (string) $_SESSION['flash_error']];
            unset($_SESSION['flash_error']);
        }

        if (!empty($_SESSION['cms_flash_success'])) {
            $messages[] = ['type' => 'success', 'message' => (string) $_SESSION['cms_flash_success']];
            unset($_SESSION['cms_flash_success']);
        }

        unset($_SESSION[self::SESSION_KEY]);

        return $messages;
    }

    private static function add(string $type, string $message): void
    {
        if ($message === '') {
            return;
        }

        if (!isset($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = [];
        }

        $_SESSION[self::SESSION_KEY][] = [
            'type' => $type,
            'message' => $message,
        ];
    }
}
