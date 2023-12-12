<?php
include '../models/userMethods.php';
include '../config/db_conn.php';

$dbConnection = new DBConnection();
$connection = $dbConnection->getConnection();

if (!$connection) {
    echo "Database connection error.";
    exit();
}

$userRepository = new UserRepository($connection);

if (isset($_GET['id'])) {
    $userIdToDelete = $_GET['id'];
    $deleted = $userRepository->deleteUser($userIdToDelete);

    if ($deleted) {
        header("Location: /Brief-8-PHP-OOP/index.php");
        exit();
    } else {
        echo "Failed to delete user.";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    if (isset($_POST['user_id'])) {
        $userId = $_POST['user_id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $roleId = $_POST['role'];

        $updated = $userRepository->updateUser($userId, $username, $email, $roleId);

        if ($updated) {
            header("Location: /Brief-8-PHP-OOP/index.php");
            exit();
        } else {
            echo "Failed to update user.";
            exit();
        }
    } else { // If the user ID is not provided, create a new user
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $role_id = $_POST['role'];

        if ($password !== $confirmPassword) {
            echo "Passwords do not match.";
            exit();
        }

        $created = $userRepository->createUser($username, $email, $password);

        if ($created) {
            $newUserId = mysqli_insert_id($connection);
            $linkedRole = $userRepository->linkUserRole($role_id, $newUserId);

            if ($linkedRole) {
                header("Location: /Brief-8-PHP-OOP/index.php");
                exit();
            } else {
                echo "Failed to link user with role.";
                exit();
            }
        } else {
            echo "Failed to create user.";
            exit();
        }
    }
}

echo "Invalid request.";
?>
