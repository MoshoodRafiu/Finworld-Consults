<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Finworld Consults</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="../../images/logo.jpg" type="image/x-icon">
    <!-- bootstrap stylesheet -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <!-- external stylesheet -->
    <link rel="stylesheet" href="../../css/style.css">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Kanit:ital@1&display=swap" rel="stylesheet">
    <!-- font awesome icons -->
    <script src="../../js/all.js"></script>

    <!-- internal style -->
    <style>
        header {
            background: url("../../images/dashboard-bg.jpg")center/cover no-repeat;
        }
    </style>
</head>

<body>
    <!-- page header -->
    <header>
        <div class="header-body">
            <!-- navbar -->
            <nav class="navbar navbar-expand-lg">
                <div class="navbar-brand header-logo">
                    <a href="home.php"><img src="../../images/logo.jpg" alt="logo"></a>
                </div>
                <!-- navbar toggler button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify icon"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- links -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item mx-2 active"><a class="nav-link" href="dashboard.html">Dashboard</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="profile.php">Profile</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="withdrawal.php">Withdrawal</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="plan.php">Change Plan</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
            <!-- page description -->
            <div class="site-description-text">
                <h2>Browse your dashboard</h2>
                <p>Change your plan, check balance and request Withdrawal from your dashboard</p>
            </div>
        </div>
    </header>

    <!-- main page content -->

    <!-- User Details -->
    <div class="mx-auto col-md-10 text-left mt-5 mb-3">
        <h5>Logged in: <i class="fas fa-user"></i> UserName</h5>
    </div>

    <!--daily task -->
    <div class="mt-2 col-md-10 mx-auto text-center">
        <h3>Today's task</h3>
        <p class="text-left bg-success text-white py-4 px-5">Please Complete the task, long press the image to save and copy the text</p>

        <!-- All Task -->
        <div class="">
            <!-- First Task -->
            <h4 class="mt-5">First Task</h4>
            <div class="col-md-8 mx-auto bg-info task p-3 mb-5">
                <!-- <div class="task-image">
                    <img src="../../images/dashboard-bg.jpg" class="img img-fluid" alt="">
                </div> -->
                <p class="task-caption py-2">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut amet quia sequi quod! Atque fugiat eum architecto reiciendis ipsam excepturi aperiam animi, nulla delectus! Recusandae asperiores maxime fuga magni ullam repudiandae perferendis suscipit cupiditate
                    voluptatem aliquam qui, sit rerum exercitationem debitis minus corporis similique placeat alias laboriosam minima quia adipisci. Perspiciatis architecto earum quaerat quam suscipit delectus autem inventore aliquid, impedit facere doloribus
                    eius deleniti explicabo iure possimus, optio ut provident. Neque, nam ducimus. Provident earum facere accusamus ad ducimus eum sunt nesciunt, dicta odio inventore enim aut porro. Neque enim eligendi saepe deleniti quisquam eaque quis
                    nam
                </p>
            </div>

            <!-- Second Task -->
            <h4>Second Task</h4>
            <div class="col-md-8 mx-auto bg-info task p-3 mb-5">
                <div class="task-image">
                    <img src="../../images/dashboard-bg.jpg" class="img img-fluid" alt="">
                </div>
                <p class="task-caption py-2">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut amet quia sequi quod! Atque fugiat eum a
                </p>
            </div>

            <!-- Third Task -->
            <h4>Third Task</h4>
            <div class="col-md-8 mx-auto bg-info task p-3 mb-5">
                <div class="task-image">
                    <img src="../../images/header-bg.jpg" class="img img-fluid" alt="">
                </div>
                <p class="task-caption py-2">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut amet quia sequi quod! Atque fugiat eum a
                </p>
            </div>
        </div>

    </div>

    <!-- task submission -->
    <h3 class="text-center mt-5">Submit task</h3>
    <p class="text-center mx-3">You are required to upload a screenshot of your completed tasks</p>
    <form action="" method="post" class="col-md-8 mx-auto">
        <h5>first task</h5>
        <input type="file" name="task-1" class="form-control mb-3">
        <h5>Second task</h5>
        <input type="file" name="task-1" class="form-control mb-3">
        <h5>Second task</h5>
        <input type="file" name="task-1" class="form-control mb-3">
        <div class="text-center">
            <button type="submit" class="btn text-light">Submit Tasks</button>
        </div>
    </form>

    <!-- dashboard -->
    <div class="dashboard mt-5 row">
        <div class="card col-md-5 bg-warning col-10 my-5 mx-auto">
            <div class="card-body">
                <div class="text-center">
                    <i class="fas fa-user-shield icon fa-3x"></i>
                </div>
                <div class="text-center text mt-3">
                    <h4><b>Current Plan: </b>Free</h4>
                    <button class="btn my-1">Upgrade</button>
                </div>
            </div>
        </div>
        <div class="card col-md-5 col-10 bg-warning my-5 mx-auto">
            <div class="card-body">
                <div class="text-center">
                    <i class="fas fa-money-bill-wave icon fa-3x"></i>
                </div>
                <div class="text-center text mt-3">
                    <h4><b>Daily Earning: </b>#140</h4>
                    <button class="btn my-1">Upgrade</button>
                </div>
            </div>
        </div>
        <div class="card col-md-5 col-10 bg-warning my-5 mx-auto">
            <div class="card-body">
                <div class="text-center">
                    <i class="fas fa-yen-sign icon fa-3x"></i>
                </div>
                <div class="text-center text mt-3">
                    <h4><b>Total Earning: </b>#1400</h4>
                    <button class="btn my-1">Widthdraw</button>
                </div>
            </div>
        </div>
        <div class="card col-md-5 col-10 bg-warning my-5 mx-auto">
            <div class="card-body">
                <div class="text-center">
                    <i class="fas fa-university icon fa-3x"></i>
                </div>
                <div class="text-center text mt-3">
                    <h4><b>Total Withdrawn: </b>#0</h4>
                    <button class="btn my-1">Widthdraw</button>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="site-footer mt-5 bg-dark">
        <div class="copyright text-center p-3 text-white "> &copy; FinWorld Consult 2020</div>
    </div>

    <!-- jquery -->
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="../../js/bootstrap.bundle.min.js"></script>
</body>

</html>