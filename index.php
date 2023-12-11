<?php

require_once 'config/db_conn.php';

// Create an instance of DBConnection
$dbConnection = new DBConnection();

// Get the database connection
$db = $dbConnection->getConnection();

// Check if the connection is successful
if ($db) {
    echo "Connected to the database successfully!";
} else {
    echo "Connection failed.";
}