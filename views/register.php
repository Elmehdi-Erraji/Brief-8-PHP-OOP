<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="../assets/assets/js/config.js"></script>

    <!-- App css -->
    <link href="../assets/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="../assets/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg">

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-lg-10">
                    <div class="card overflow-hidden bg-opacity-25">
                        <div class="row g-0">
                            <div class="col-lg-6 d-none d-lg-block p-2">
                                <img src="../assets/assets/images/auth-img.jpg" alt="" class="img-fluid rounded h-100">
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex flex-column h-100">

                                    <div class="p-4 my-auto">
                                        <h4 class="fs-20">Free Sign Up</h4>
                                        <p class="text-muted mb-3">Enter your email address and password to access
                                            account.</p>

                                        <!-- form -->
                                        <form action="#">
                                            <div class="mb-3">
                                                <label for="fullname" class="form-label">Username</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="Enter your name" required="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Email address</label>
                                                <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control" type="password" required="" id="password" placeholder="Enter your password">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password Confirmation</label>
                                                <input class="form-control" type="password" required="" id="password" placeholder="Enter your password">
                                            </div>

                                            <div class="mb-0 d-grid text-center">
                                                <button class="btn btn-primary fw-semibold" type="submit">Sign Up</button>          
                                            </div>

                                            <div class="text-center mt-4">
                                                <p class="text-muted fs-16">Sign in with</p>
                                                <div class="d-flex gap-2 justify-content-center mt-3">
                                                    <a href="#" class="btn btn-soft-primary"><i class="ri-facebook-circle-fill"></i></a>

                                                    <a href="#" class="btn btn-soft-danger"><i class="ri-google-fill"></i></a>

                                                    <a href="#" class="btn btn-soft-info"><i class="ri-twitter-fill"></i></a>

                                                    <a href="#" class="btn btn-soft-dark"><i class="ri-github-fill"></i></a>

                                                </div>
                                            </div>
                                        </form>
                                        <!-- end form-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-dark-emphasis">Already have account? <a href="login.php" class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Log In</b></a>
                    </p>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark-emphasis">
            <script>
                document.write(new Date().getFullYear())
            </script> © Mehdi
        </span>
    </footer>

    <!-- Vendor js -->
    <script src="../assets/assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="../assets/assets/js/app.min.js"></script>

</body>

</html>