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
                    <a href="home.v"><img src="../../images/logo.jpg" alt="logo"></a>
                </div>
                <!-- navbar toggler button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify icon"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- links -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item mx-2"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="profile.php">Profile</a></li>
                        <li class="nav-item mx-2 active"><a class="nav-link" href="withdrawal.php">Withdrawal</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="plan.php">Change Plan</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
            <!-- page description -->
            <div class="site-description-text">
                <h2>Withdraw your earnings</h2>
                <p>Request Withdrawal from your earnings</p>
            </div>
        </div>
    </header>

    <!-- main page content -->

    <!-- withdrawal form -->
    <div class="withdrawal  my-5 py-3 mx-auto col-lg-7 col-md-8" style="height: 70vh;">
        <h3 class="text-center main text-white p-2">FIll out the withdrawal slip</h3>
        <p class="status p-2">withdrawal is currently unavailable</p>
        <form action="" method="post">
            <table class="w-100">
                <tr>
                    <td class="w-25">
                        <label for="bankname" class="mr-4">Account Name:</label>
                    </td>
                    <td class="w-100">
                        <input type="text" name="acctname" class="w-75 form-control" value="USER FIRST" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="w-25">
                        <label class="mr-4">Account Number:</label>
                    </td>
                    <td class="w-100">
                        <input type="text" name="actnum" class="w-75 form-control" value="01236546855" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="w-25 my-2">
                        <label class="mr-4">Bank Name:</label>
                    </td>
                    <td class="w-100">
                        <input type="text" name="bankname" class="w-75 form-control" value="ACCESS BANK PLC" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="w-25 my-2">
                        <label class="mr-4">Amount:</label>
                    </td>
                    <td class="w-100">
                        <input type="number" name="amount" class="w-75 form-control" placeholder="Enter Amount">
                    </td>
                </tr>
            </table>
            <div class="submit mx-auto text-center mt-3">
                <button type="submit" class="btn w-50 text-white">Request Withdrawal</button>
            </div>
        </form>
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