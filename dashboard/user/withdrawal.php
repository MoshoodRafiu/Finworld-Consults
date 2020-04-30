<?php
    // start session
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: ../../login.php");
        exit();
    }
?>
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
                        <li class="nav-item mx-2"><a class="nav-link" href="../action/logout.php">Logout</a></li>
                        <li class="nav-item mx-2"><a href="#" class="nav-link"><i class="fas fa-user mx-2"></i><?php echo $_SESSION['user']; ?></a></li>
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
    <?php
        // include action
        include "../action/action.php";
        $result = $con->profiledetails();
        $val = $con->updateearning();
        // Check if account has been restricted
        if ($val['status'] == 'restricted'){
        ?>
            <div class="alert alert-warning text-capitalize mx-auto text-center col-lg-7 col-md-8 mt-5 mb-0" role="alert"><h5>Your account has been restricted for some reasons, Please contact the admin for clarification</h5></div>"
        <?php
        }
    ?>
    <div class="withdrawal  my-5 py-3 mx-auto col-lg-7 col-md-8 pb-5">
        <h3 class="text-center main text-white p-2">FIll out the withdrawal slip</h3>
        <p class="status p-2">withdrawal is currently unavailable</p>
        <form action="" method="post">
            <table class="w-100">
                <tr>
                    <td class="w-25">
                        <label class="mr-4">Account Number:</label>
                    </td>
                    <td class="w-100">
                        <input type="text" name="actnum" class="w-75 form-control" value="<?php echo $result['acct']; ?>" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="w-25 my-2">
                        <label class="mr-4">Bank Name:</label>
                    </td>
                    <td class="w-100">
                        <input type="text" name="bankname" class="w-75 form-control" value="<?php echo $result['bank']; ?>" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="w-25 my-2">
                        <label class="mr-4">Amount:</label>
                    </td>
                    <td class="w-100">
                        <input type="number" name="amount" class="w-75 form-control" placeholder="Enter Amount"  required>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="w-100">
                        <input type="hidden" name="id" class="w-75 form-control" value="<?php echo $result['id']; ?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="w-100">
                        <input type="hidden" name="available" class="w-75 form-control" value="<?php echo $result['available']; ?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="w-100">
                        <input type="hidden" name="plan" class="w-75 form-control" value="<?php echo $result['plan']; ?>">
                    </td>
                </tr>
            </table>
            <div class="submit mx-auto text-center mt-3">
                <?php
                    if ($val['status'] == 'restricted'){
                    ?>
                        <button type="submit" name = "withdraw" class="btn w-50 text-white" disabled>Request Withdrawal</button>
                    <?php
                    }else {
                    ?>
                        <button type="submit" name = "withdraw" class="btn withdraw w-50 text-white">Request Withdrawal</button>
                    <?php
                    }
                ?>
            </div>
        </form>
    </div>



    <!-- footer -->
    <div class="site-footer text-center mx-auto mt-5 bg-color">
        <div class="copyright text-center p-3 text-white "> &copy; FinWorld Consult <?php echo date("Y"); ?></div>
        <div class="mx-auto d-flex justify-content-center text-center">
            <div><a href="#" class="text-white"><i class="fab fa-facebook fa-2x mx-3"></i></a></div>
            <div><a href="#" class="text-white"><i class="fab fa-twitter fa-2x mx-3"></i></a></div>
            <div><a href="https://wa.me/2349024432443" class="text-white"><i class="fab fa-whatsapp fa-2x mx-3"></i></a></div>
            <div><a href="#" class="text-white"><i class="fas fa-envelope fa-2x mx-3"></i></a></div>
        </div><hr class="bg-white"/>
        <div class="text-center py-3 d-flex justify-content-center mx-auto">
            <p class="mx-2 small"><a href="home.php" class="text-white" style="text-decoration: none">Home</a></p>
            <p class="mx-2 small"><a href="dashboard.php" class="text-white" style="text-decoration: none">Dashboard</a></p>
            <p class="mx-2 small"><a href="plan.php" class="text-white" style="text-decoration: none">Plan</a></p>
            <p class="mx-2 small"><a href="profile.php" class="text-white" style="text-decoration: none">Profile</a></p>
            <p class="mx-2 small"><a href="withdrawal.php" class="text-white" style="text-decoration: none">Withdrawal</a></p>
        </div>
    </div>

    <!-- jquery -->
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script>
        function checkWithdrawal(){
            let today = new Date();
            if (today.getDay() == 2) { //6
                document.querySelector('.status').textContent = "withdrawal is available"
                document.querySelector('.status').classList.add("bg-success");
                if (document.querySelector('.withdraw')){
                    document.querySelector('.withdraw').disabled = false;
                }
            }else {
                document.querySelector('.status').textContent = "withdrawal is currently unavailable"
                document.querySelector('.status').classList.remove("bg-success");
                if (document.querySelector('.withdraw')){
                    document.querySelector('.withdraw').disabled = true;
                }
            }
        }
        window.onload = checkWithdrawal();
    </script>
</body>

</html>