<?php
require_once 'models/user.model.php';
require_once 'config/db_conn.php';

// Establish a database connection
$dbConnection = new DBConnection();
$db = $dbConnection->getConnection();

// Create an instance of the User class
$userModel = new User($db);

// Retrieve users from the database
$users = $userModel->getUsers();

// Get the count of users
$userCount = $userModel->getUserCount();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

<!-- =============== Navigation ================ -->
    <div class="containerr" style="background-color: #30B7FF;">
        <div class="navigation" style="background-color: #30B7FF;">
            <ul>
                <li>
                    <a href="index.php">
                        <span class="title">Innovation</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="views/project.php">
                        <span class="icon">
                        <ion-icon name="receipt-outline"></ion-icon>
                        </span>
                        <span class="title">Projects</span>
                    </a>
                </li>

            </ul>
        </div>

<!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>

<!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                    <div class="numbers">
            <h2><?php echo $userCount; ?></h2>
        </div>
                        <div class="cardName">Users</div>
                    </div>

                    <div class="iconBx">
                        
                    </div>
                </div>

                <div class="card">
                    <div>
                    <div class="numbers">
                      
                       </div>
                        <div class="cardName">Projects</div>
                    </div>

                    <div class="iconBx">
                        
                    </div>
                </div>

            </div>

<!-- ================ Order Details List ================= -->

<div class="container">
   
    <a href="views/adduser.php" class="btn btn-dark mb-3">Add A New User</a>

    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td>
                        <a href='views/update.php?id=<?= $user['id'] ?>' class='link-dark'><i class='fa-solid fa-pen-to-square fs-5 me-3'></i></a>
                        <a href='controllers/user.controller.php?id=<?= $user['id'] ?>' class='link-dark'><i class='fa-solid fa-trash fs-5'></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div>


  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

            <!-- ================= New Customers ================ -->

        </div>
    </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


</body>

</html>