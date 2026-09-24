<?php

require_once dirname(__DIR__) . '/includes/constants.php';

class Database {

    public function getConnection() {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die("Error failed to connect to MySQL: " . $conn->connect_error);
        }
        return $conn;
    }
}