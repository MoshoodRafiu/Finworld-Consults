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
                    <h3 class="py-3">Reset Password</h3>
                </div>

                <!-- main login form -->
                <form action="login.php" class="mx-3 my-3" method="post">
                    <input type="email" class="form-control mt-3" name="email" placeholder="Enter email">
                    <button type="submit" name="submit" class="form-control text-white mx-auto my-3 w-75 bg">Reset</button>
                </form>

                <!--  alt links -->
                <div class="card-footer bg">
                    <a href="register.php" class="text-white mx-3">Register</a>
                    <a href="login.php" class="text-white">login</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>