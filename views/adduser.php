
<?php
include '../models/users/userMethods.php';
include '../config/db_conn.php';

// Establish a database connection
$dbConnection = new DBConnection();
$db = $dbConnection->getConnection();

// Create an instance of the User class
$userModel = new UserRepository($db);

// Retrieve users from the database
$users = $userModel->getUsers();

// Get the count of users
$userCount = $userModel->getUserCount();

// Fetch roles from the database
$roles = $userModel->getAllRoles();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <Style>
        .button-container {
            text-align: center;
        }
    </Style>
    <title>ADD new User</title>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #30B7FF;">
        User
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Add New User</h3>
            <p class="text-muted">Complete the form below to add a new User</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="../controllers/users/user.controller.php" method="post" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password confirmation:</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Select Role:</label><br>
                    <select id="role" class="form-control" name="role" required>
            <option value="">Select a Role</option>
            <?php
            // Loop through each role to create the options
            foreach ($roles as $role) {
                echo "<option value='" . $role['id'] . "'>" . $role['role_name'] . "</option>";
            }
            ?>
        </select>
                </div>

                <div class="button-container">
                    <button type="submit" class="btn btn-success" name="add" style="background-color: #30B7FF; border: 2px solid black">Save</button>
                    <a href="../../index.php" class="btn btn-danger" style="background-color: #30B7FF; border: 2px solid black">Cancel</a>
                </div>
                <br>
                <br>
            </form>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
