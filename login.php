<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Finworld Consults</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">
    <!-- bootstrap stylesheet -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- external stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <!-- googlr fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Kanit:ital@1&display=swap" rel="stylesheet">
    <!-- font awesome icon -->
    <script src="js/all.js"></script>

    <!-- internal style -->
    <style>
        body {
            background: url("images/login-bg.jpg")center/cover no-repeat;
            height: 100vh;
        }
    </style>
</head>

<body>
    <!-- login form -->
    <div class="row">
        <div class="col-10 col-md-6 col-lg-4 mt-5 login mx-auto text-center">
            <div class="card my-5">

                <!-- title -->
                <div class="bg card-title">
                    <h2 class="py-3">Sign in</h2>
                </div>

                <!-- main login form -->
                <form action="dashboard/action/action.php" class="mx-3 my-3" method="post">
                    <!-- Check if user has clicked login -->
                    <?php
                        if (!empty($_GET['valid'])){
                            if ($_GET['valid'] == "userlogin"){
                            ?>
                                <!-- Display success message if valid and redirect to dashboard -->
                                <div class="alert alert-success mx-auto text-center" role="alert">Login Successful, Redirecting..</div>
                            <?php
                                session_start();
                                header("refresh: 1; url=dashboard/user/dashboard.php");
                            } else if ($_GET['valid'] == "adminlogin") {
                            ?>
                                <!-- Display error message if login not valid -->
                                <div class="alert alert-success mx-auto text-center" role="alert">Login Successful, Redirecting..</div>
                            <?php
                                session_start();
                                header("refresh: 2; url=dashboard/admin/dashboard.php");
                            } else if ($_GET['valid'] == "failed") {
                            ?>
                                <!-- Display error message if login not valid -->
                                <div class="alert alert-danger mx-auto text-center" role="alert">Invalid Login Details</div>
                            <?php
                            }
                        }
                    ?>
                    <input type="text" class="form-control mt-3" required="required" name="useremail" placeholder="Email or Username">
                    <input type="password" class="form-control mt-3" required="required" name="password" placeholder="Password">
                    <button type="submit" name="login" class="form-control text-white mx-auto my-3 w-75 bg">Login</button>
                </form>

                <!--  alt links -->
                <div class="card-footer bg">
                    <a href="register.php" class="text-white mx-3">Register</a>
                    <a href="reset.php" class="text-white">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>