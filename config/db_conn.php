<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');

$dotenv->load();

class DBConnection {
    protected $connection;

    public function __construct() {
        $dbHost = $_ENV['DB_HOST'];
        $dbUser = $_ENV['DB_USER'];
        $dbPassword = $_ENV['DB_PASSWORD'];
        $dbName = $_ENV['DB_NAME'];

        $this->connection = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}

// Usage
// $dbConnection = new DBConnection();
// $connection = $dbConnection->getConnection();

// if(!$dbConnection){
//     echo "Db is not connected";
// }

// Use $connection for database operations
