<?php
// include '../../models/users/user.model.php';
// include '../../models/users/userMethods.php'; // Assuming this file contains UserRepository class
// include '../../config/db_conn.php';

// // Establish database connection
// $dbConnection = new DBConnection();
// $connection = $dbConnection->getConnection();

// // Check if the connection is successful
// if (!$connection) {
//     echo "Database connection error.";
//     exit();
// }

// // Instantiate UserRepository
// $userRepository = new UserRepository($connection);

// // Handle deleting a user if an ID is provided in GET request
// if (isset($_GET['id'])) {
//     $userIdToDelete = $_GET['id'];
//     $deleted = $userRepository->deleteUser($userIdToDelete);

//     if ($deleted) {
//         header("Location: /Brief-8-PHP-OOP/index.php");
//         exit();
        
//     } else {
//         echo "Failed to delete user.";
//         exit();
//     }
// }

// // Handle form submissions (POST requests)
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     // Handle user update
//     if (isset($_POST['submit']) && isset($_POST['user_id'])) {
//         $userId = $_POST['user_id'];
//         $username = $_POST['username'];
//         $email = $_POST['email'];
//         $roleId = $_POST['role'];

//         // Create a User object
//         $user = new User($username, $email, '', $roleId); // Note: Password not included for update

//         // Set user ID
//         $user->setId($userId);

//         // Update user using UserRepository method
//         $updated = $userRepository->updateUser($user);

//         if ($updated) {
//             header("Location: /Brief-8-PHP-OOP/index.php");
//             exit();
//         } else {
//             echo "Failed to update user.";
//             exit();
//         }
//     } elseif (isset($_POST['signup'])) { // Handle user signup
//         $username = $_POST['username'];
//         $email = $_POST['email'];
//         $password = $_POST['password'];
//         $confirmPassword = $_POST['confirm_password'];
//         $role_id = 3; // Set the default role to 3

//         // Check if passwords match
//         if ($password !== $confirmPassword) {
//             echo "Passwords do not match.";
//             exit();
//         }

//         // Create a User object for signup
//         $newUser = new User($username, $email, $password, $role_id);

//         // Create user and link role using UserRepository methods
//         $created = $userRepository->createUser($newUser);

//         if ($created) {
//             $newUserId = mysqli_insert_id($connection);
//             $linkedRole = $userRepository->linkUserRole($role_id, $newUserId);

//             if ($linkedRole) {
//                 header("Location: /Brief-8-PHP-OOP/views/login.php");
//                 exit();
//             } else {
//                 echo "Failed to link user with role.";
//                 exit();
//             }
//         } else {
//             echo "Failed to create user.";
//             exit();
//         }
//     } elseif (isset($_POST['login'])) { // Handle user login
//         $email = $_POST['email'];
//         $password = $_POST['password'];

//         // Authenticate user using UserRepository method
//         $user = $userRepository->authenticateUser($email, $password);

//         if ($user) {
//             session_start();
//             $_SESSION['user_id'] = $user['id'];
//             $_SESSION['username'] = $user['username'];
//             $_SESSION['role_id'] = $user['role_id'];

//             // Redirect based on user role
//             if ($user['role_id'] === 1) {
//                 header("Location: ../../index.php");
//                 exit();
//             } else {
//                 header("Location: ../../user_dashboard.php");
//                 exit();
//             }
//         } else {
//             // Provide more specific error messages
//             echo "Invalid email or password";
//             exit();
//         } 
//     }else {
//             echo "Incomplete or invalid form submission.";
//             exit();
//         }
// }

// // If none of the conditions are met, it's an invalid request
// echo "Invalid request.";

include '../../models/users/user.model.php';
include '../../models/users/userMethods.php'; // Assuming this file contains UserRepository class
include '../../config/db_conn.php';

// Establish database connection
$dbConnection = new DBConnection();
$connection = $dbConnection->getConnection();

// Check if the connection is successful
if (!$connection) {
    echo "Database connection error.";
    exit();
}

// Instantiate UserRepository
$userRepository = new UserRepository($connection);

// Handle deleting a user if an ID is provided in GET request
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

// Handle form submissions (POST requests)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['submit']) && isset($_POST['user_id'])) {
        // Handle user update
        $userId = $_POST['user_id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $roleId = $_POST['role'];

        // Create a User object
        $user = new User($username, $email, '', $roleId); // Note: Password not included for update
        $user->setId($userId);

        // Update user using UserRepository method
        $updated = $userRepository->updateUser($user);

        if ($updated) {
            header("Location: /Brief-8-PHP-OOP/index.php");
            exit();
        } else {
            echo "Failed to update user.";
            exit();
        }
    }

    if (isset($_POST['signup'])) {
        // Handle user signup
        if (
            !isset($_POST['username']) ||
            !isset($_POST['email']) ||
            !isset($_POST['password']) ||
            !isset($_POST['confirm_password'])
        ) {
            echo "Incomplete form submission.";
            exit();
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $role_id = 3; // Set the default role to 3

        // Check if passwords match
        if ($password !== $confirmPassword) {
            echo "Passwords do not match.";
            exit();
        }

        // Create a User object for signup
        $newUser = new User($username, $email, $password, $role_id);

        // Create user and link role using UserRepository methods
        $created = $userRepository->createUser($newUser);

        if ($created) {
            $newUserId = mysqli_insert_id($connection);
            $linkedRole = $userRepository->linkUserRole($role_id, $newUserId);

            if ($linkedRole) {
                header("Location: /Brief-8-PHP-OOP/views/login.php");
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

    if (isset($_POST['login'])) {
        // Handle user login
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            echo "Incomplete login details.";
            exit();
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        // Authenticate user using UserRepository method
        $user = $userRepository->authenticateUser($email, $password);

        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_id'] = $user['role_id'];

            // Redirect based on user role
            if ($user['role_id'] === 1) {
                header("Location: ../../index.php");
                exit();
            } else {
                header("Location: ../../user_dashboard.php");
                exit();
            }
        } else {
            // Provide more specific error messages
            echo "Invalid email or password";
            exit();
        }
    }elseif (isset($_POST['add'])) {
        // Handle adding a new user
        if (
            !isset($_POST['username']) ||
            !isset($_POST['email']) ||
            !isset($_POST['password']) ||
            !isset($_POST['confirm_password']) ||
            !isset($_POST['role'])
        ) {
            echo "Incomplete form submission.";
            exit();
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $role_id = $_POST['role'];

        // Check if passwords match
        if ($password !== $confirmPassword) {
            echo "Passwords do not match.";
            exit();
        }

        // Create a User object for adding a new user
        $newUser = new User($username, $email, $password, $role_id);

        // Create user and link role using UserRepository methods
        $created = $userRepository->createUser($newUser);

        if ($created) {
            // Redirect to the desired location after adding the user
            header("Location: /Brief-8-PHP-OOP/index.php");
            exit();
        } else {
            echo "Failed to create user.";
            exit();
        }
    } else {
        echo "Invalid action.";
        exit();
    }

    // If none of the conditions are met, it's an incomplete or invalid form submission
    echo "Incomplete or invalid form submission.";
    exit();
}

// If none of the conditions are met, it's an invalid request
echo "Invalid request.";
