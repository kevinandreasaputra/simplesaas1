<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'] ?? 'localhost';
        $this->db_name = $_ENV['DB_DATABASE'] ?? 'booking_db';
        $this->username = $_ENV['DB_USERNAME'] ?? 'root';
        $this->password = $_ENV['DB_PASSWORD'] ?? '';
        $this->connect();
    }

    public function connect()
    {
        $this->conn = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode([
                "status" => "error",
                "message" => "Database Critical Error: " . $e->getMessage(),
                "file" => $e->getFile(),
                "line" => $e->getLine(),
                "debug_env" => [
                    "DB_HOST" => $_ENV['DB_HOST'] ?? 'NOT_SET',
                    "Raw_Host" => $this->host
                ]
            ]);
            exit;
        }
        return $this->conn;
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    public function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }
}
