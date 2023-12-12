<?php
require_once '../models/user.model.php'; 
include '../config/db_conn.php';



$dbConnection = new DBConnection();
$connection = $dbConnection->getConnection();
// Delete a user
if (isset($_GET['id'])) {
    if ($connection) {
        $userModel = new User($connection);

        $userIdToDelete = $_GET['id'];

        $deleted = $userModel->deleteUser($userIdToDelete);

        if ($deleted) {
            header("Location: /Brief-8-PHP-OOP/index.php");
            exit();
        } else {
            echo "Failed to delete user.";
        }
    } else {
        echo "Database connection error.";
    }
} else {
    echo "User ID not provided.";
}

//add user 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if ($connection) {
        $userModel = new User($connection);

        // Get form data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $role_id = $_POST['role']; // Assuming this comes from the form

        // Check if passwords match
        if ($password !== $confirmPassword) {
            echo "Passwords do not match.";
            exit(); // Stop execution if passwords don't match
        }

        // Create the user
        $created = $userModel->createUser($username, $email, $password);

        if ($created) {
            // Retrieve the newly created user's ID
            $newUserId = mysqli_insert_id($connection);

            // Link the user with a role
            $linkedRole = $userModel->linkUserRole($role_id, $newUserId);

            if ($linkedRole) {
                // Redirect to a success page or handle success message
                header("Location: /Brief-8-PHP-OOP/index.php");
                exit();
            } else {
                echo "Failed to link user with role.";
            }
        } else {
            echo "Failed to create user.";
        }
    } else {
        echo "Database connection error.";
    }
} else {
    echo "Invalid request.";
}