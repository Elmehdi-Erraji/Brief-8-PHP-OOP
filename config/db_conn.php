<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..'); // Adjust the path to the directory containing .env file

try {
    $dotenv->load();
} catch (\Dotenv\Exception\InvalidPathException $e) {
    die("Error loading .env file: " . $e->getMessage());
}


class DBConnection {
    protected $connection;

    public function __construct() {
        try {
            $dbHost = $_ENV['DB_HOST'];
            $dbUser = $_ENV['DB_USER'];
            $dbPassword = $_ENV['DB_PASSWORD'];
            $dbName = $_ENV['DB_NAME'];

            $this->connection = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

            if (!$this->connection) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}
