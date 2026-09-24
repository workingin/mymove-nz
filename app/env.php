<?php

/**
 * Load key/value pairs from the project .env file and expose env().
 * Included by app/start.php and admin/includes/constants.php.
 */

if (!function_exists('env')) {
    function env(string $key, $default = null)
    {
        $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
        if ($value === false || $value === null || $value === '') {
            return $default;
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return null;
        }

        if (is_string($value) && strlen($value) > 1 && $value[0] === '"' && substr($value, -1) === '"') {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (!function_exists('loadEnvFile')) {
    function loadEnvFile(string $path): void
    {
        if (!is_readable($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || $line[0] === '#') {
                continue;
            }

            if (strpos($line, '=') === false) {
                continue;
            }

            [$name, $value] = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if ($name === '') {
                continue;
            }

            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
            putenv($name . '=' . $value);
        }
    }
}

if (!function_exists('defineDatabaseConstants')) {
    function defineDatabaseConstants(): void
    {
        if (defined('DB_HOST')) {
            return;
        }

        define('DB_TYPE', env('DB_TYPE', 'mysql'));
        define('DB_HOST', env('DB_HOST', 'localhost'));
        define('DB_USER', env('DB_USER', 'root'));
        define('DB_PASS', env('DB_PASS', ''));
        define('DB_NAME', env('DB_NAME', ''));
    }
}

$projectRoot = dirname(__DIR__);
loadEnvFile($projectRoot . '/.env');
