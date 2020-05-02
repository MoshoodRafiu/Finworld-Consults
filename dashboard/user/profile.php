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
                    <a href="home.php"><img src="../../images/logo.jpg" alt="logo"></a>
                </div>
                <!-- navbar toggler button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify icon"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- links -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item mx-2"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                        <li class="nav-item mx-2 active"><a class="nav-link" href="profile.php">Profile</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="withdrawal.php">Withdrawal</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="plan.php">Change Plan</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="../action/logout.php">Logout</a></li>
                        <li class="nav-item mx-2"><a href="#" class="nav-link"><i class="fas fa-user mx-2"></i><?php echo $_SESSION['user']; ?></a></li>
                    </ul>
                </div>
            </nav>
            <!-- page description -->
            <div class="site-description-text">
                <h2>Keep your profile upto date</h2>
                <p>Edit names, change password, correct payment details</p>
            </div>
        </div>
    </header>

    <!-- main page content -->

    <!-- profile update form -->
    <?php
        // include action
        include "../action/action.php";
        $result = $con->profiledetails();
    ?>
    <div class="profile  my-5 mx-auto col-lg-7 py-3 col-md-8">
        <h3 class="text-center my-3 main text-white p-2">Update your profile</h3>

        <!-- personal infomation table -->
        <h5>Personal Information</h5>
        <form action="" method="post" onsubmit="return check()">
            <table class="w-100">
                <tr>
                    <td class="w-25">
                        <label class="mr-4">First Name:</label>
                    </td>
                    <td class="w-100">
                        <input type="text" name="fname" class="w-75 form-control" value="<?php echo $result['fname']; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="w-25">
                        <label class="mr-4">Last Name:</label>
                    </td>
                    <td class="w-100">
                        <input type="text" name="lname" class="w-75 form-control" value="<?php echo $result['lname']; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="w-25 my-2">
                        <label class="mr-4">Username:</label>
                    </td>
                    <td class="w-100">
                        <input type="text" name="bankname" class="w-75 form-control" value="<?php echo $result['uname']; ?>" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="w-25 my-2">
                        <label class="mr-4">Email:</label>
                    </td>
                    <td class="w-100">
                        <input type="email" name="bankname" class="w-75 form-control" value="<?php echo $result['email']; ?>" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="w-25 my-2">
                        <label class="mr-4">Phone:</label>
                    </td>
                    <td class="w-100">
                        <input type="tel" name="phone" class="w-75 form-control" value="<?php echo $result['phone']; ?>" disabled>
                    </td>
                </tr>
            </table>

            <!-- Account information table -->
            <h5 class="mt-5">Account Information</h5>
            <table class="w-100">
                <tr>
                    <td class="w-25">
                        <label class="mr-4">Account Number:</label>
                    </td>
                    <td class="w-100">
                        <input type="text" name="acctnum" class="w-75 form-control" value="<?php echo $result['acct']; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="w-25 my-2">
                        <label class="mr-4">Bank Name:</label>
                    </td>
                    <td class="w-100">
                        <input type="text" name="bankname" class="w-75 form-control" value="<?php echo $result['bank']; ?>">
                    </td>
                </tr>
                <tr>
            </table>

            <!-- Password update table -->
            <h5 class="mt-5">Change password</h5>
            <table class="w-100">
                <tr>
                    <td class="w-25">
                        <label class="mr-4">Old Password:</label>
                    </td>
                    <td class="w-100">
                        <p class="m-0 text-left small opass-msg" style="color: red; display: none;">Enter old password</p>
                        <input type="password" name="pass" class="w-75 form-control opass-fld">
                    </td>
                </tr>
                <tr>
                    <td class="w-25">
                        <label class="mr-4">New Password:</label>
                    </td>
                    <td class="w-100">
                        <p class="m-0 text-left small pass-msg" style="color: red; display: none;">Password too short or doesn't match</p>
                        <input type="password" name="npass" class="w-75 form-control pass-fld">
                    </td>
                </tr>
                <tr>
                    <td class="w-25">
                        <label class="mr-4">Confirm New Password:</label>
                    </td>
                    <td class="w-100">
                        <p class="m-0 text-left small cpass-msg" style="color: red; display: none;">Password too short or doesn't match</p>
                        <input type="password" name="cnpass" class="w-75 form-control cpass-fld">
                    </td>
                </tr>
            </table>
            <div class="submit mx-auto text-center mt-3">
                <button type="submit" name="updateprofile" class="btn w-50 text-white">Update Profile</button>
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
            <div><a href="mailto:finworldconsults@gmail.com" class="text-white"><i class="fas fa-envelope fa-2x mx-3"></i></a></div>
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
        function check(){
            if (document.querySelector('.pass-fld').value != "" || document.querySelector('.cpass-fld').value != ""){
                if (document.querySelector('.opass-fld').value != "") {
                    if (document.querySelector('.pass-fld').value.length > 7 && document.querySelector('.pass-fld').value == document.querySelector('.cpass-fld').value) {
                        document.querySelector('.pass-msg').style.display = 'none';
                        document.querySelector('.cpass-msg').style.display = 'none';
                        document.querySelector('.pass-fld').style.border = 'none';
                        document.querySelector('.cpass-fld').style.border = 'none';
                        document.querySelector('.opass-fld').style.border = 'none';
                        document.querySelector('.opass-msg').style.display = 'none';
                        return true;
                    } else {
                        document.querySelector('.pass-fld').style.border = '2px solid red';
                        document.querySelector('.pass-msg').style.display = '';
                        document.querySelector('.cpass-fld').style.border = '2px solid red';
                        document.querySelector('.cpass-msg').style.display = '';
                        document.querySelector('.opass-fld').style.border = 'none';
                        document.querySelector('.opass-msg').style.display = 'none';
                        return false;
                    }
                } else {
                    document.querySelector('.opass-fld').style.border = '2px solid red';
                    document.querySelector('.opass-msg').style.display = '';
                    return false;
                }

            }else {
                return true;
            }
        }
    </script>
</body>

</html>