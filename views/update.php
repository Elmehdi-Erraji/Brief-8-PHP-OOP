
<?php
require_once '../models/userMethods.php';
require_once '../config/db_conn.php';

$dbConnection = new DBConnection();
$connection = $dbConnection->getConnection();

$userModel = new UserRepository($connection);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $userIdToUpdate = $_GET['id'];

    // Get user data by ID
    $userData = $userModel->getUserById($userIdToUpdate);

    // Fetch roles
    $roles = $userModel->getAllRoles();

    if (!$userData) {
        echo "User not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
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
        <form action="../controllers/user.controller.php" method="post">
                    <input type="hidden" name="user_id" value="<?= $userData['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?= $userData['username'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="name@example.com" value="<?= $userData['email'] ?>" required>
                    </div>


                    <div class="mb-3">
                        <label for="role" class="form-label">Select Role</label>
                        <select id="role" class="form-control" name="role" required>
                            <option value="">Select a Role</option>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['id'] ?>" <?= ($role['id'] == $userData['role_id']) ? 'selected' : '' ?>>
                                    <?= $role['role_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                <div class="button-container">
                    <button type="submit" class="btn btn-success" name="submit" style="background-color: #30B7FF; border: 2px solid black">Save</button>
                    <a href="../index.php" class="btn btn-danger" style="background-color: #30B7FF; border: 2px solid black">Cancel</a>
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
