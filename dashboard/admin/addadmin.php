<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Finworld Consults</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="../../images/logo.jpg" type="image/x-icon">
    <!-- bootstrap stylesheet -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <!-- external stylesheet -->
    <link rel="stylesheet" href="../../css/maincss.css">

    <!-- Font awesome icons -->
    <script src="../../js/all.js"></script>

</head>
<body>
    <?php
        // start session
        session_start();
        if (!isset($_SESSION['admin'])) {
            header("Location: ../../login.php");
            exit();
        }
    ?>
    <!-- dashboard page -->
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="">

            <ul class="list-unstyled components">
                <h5 class="p-3 text-center mb-5 sidebar-header">Dashboard <i class="fas fa-tachometer-alt"></i></h5>
                <li>
                    <a href="dashboard.php">Upload Tasks <i class="fas fa-upload mx-1"></i></a>
                </li>
                <li class="">
                    <a href="approve.php">Approve Tasks <i class="fas fa-check mx-1"></i></a>
                </li>
                <li class="">
                    <a href="list.php">Withdrawal List <i class="fas fa-list mx-1"></i></a>
                </li>
                <li>
                    <a href="users.php">Manage Users <i class="fas fa-users mx-1"></i></a>
                </li>
                <li class="active">
                    <a href="admin.php">Manage Admin <i class="fas fa-users-cog mx-1"></i></a>
                </li>
                <li>
                    <a href="upgrade.php">Upgrades <i class="fas fa-caret-square-up mx-1"></i></a>
                </li>
                <li>
                    <a href="record.php">Records <i class="fas fa-scroll mx-1"></i></a>
                </li>
                <li>
                    <a href="../action/logout.php">Logout <i class="fas fa-sign-out-alt mx-1"></i></a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <!-- sidebar toggler div -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <!-- sidebar toggler button -->
                    <button type="button" id="sidebarCollapse" class="btn btn-style">
                        <i class="fas fa-align-justify"></i>
                    </button>
                </div>
            </nav>

            <!-- dashboard body -->
            <div class="container-fluid">
                <button class="btn btn-style"><a href="admin.php"><i class="fas fa-wrench mx-2"></i>Manage Admin</a></button>
                <h4 class="text-center text-muted my-4">Add Admin</h4>
                <form action="../action/action.php" method="POST" onsubmit="return check()" class="col-md-8 col-10 mx-auto">
                    <?php
                        if (!empty($_GET['add'])){
                            if ($_GET['add'] == 1) {
                            ?>
                                <!-- Display success message if admin is added -->
                                <div class="alert alert-success mx-auto text-center" role="alert">Admin Successfully Registered</div>
                            <?php
                            } else if ($_GET['add'] == 'user_error'){
                                ?>
                                <!-- Display error message if username already exists -->
                                <div class="alert alert-danger mx-auto text-center" role="alert">Username Already Exist</div>
                            <?php
                            } else if ($_GET['add'] == 'email_error') {
                                ?>
                                <!-- Display error message if email already exists -->
                                <div class="alert alert-danger mx-auto text-center" role="alert">Email Already Exist</div>
                            <?php
                            }
                        }
                    ?>
                    <input type="text" name="username" placeholder="Username" required class="form-control my-3">
                    <input type="email" name="email" placeholder="Email" required class="form-control my-3">
                    <p class="m-0 text-left small pass-msg" style="color: red; display: none;">Password too short or doesn't match</p>
                    <input type="password" name="password" placeholder="Password" required class="form-control my-3 pass-fld">
                    <p class="m-0 text-left small cpass-msg" style="color: red; display: none;">Password too short or doesn't match</p>
                    <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control my-3 cpass-fld">
                    <div class="text-center">
                        <button type="submit" name="addadmin" class="btn btn-style">Add Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jquery -->
    <script src="../../js/jquery-3.4.1.min.js"></script>

    <!-- bootstrap js -->
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        document.querySelector('#sidebarCollapse').addEventListener('click', ()=>{
            console.log("pressed")
            document.querySelector('#sidebar').classList.toggle('activate');
        });
        function check(){
            if (document.querySelector('.pass-fld').value.length > 1 && document.querySelector('.pass-fld').value == document.querySelector('.cpass-fld').value) {
                document.querySelector('.pass-msg').style.display = 'none';
                document.querySelector('.cpass-msg').style.display = 'none';
                document.querySelector('.pass-fld').style.border = 'none';
                document.querySelector('.cpass-fld').style.border = 'none';
                return true;
            } else {
                document.querySelector('.pass-fld').style.border = '2px solid red';
                document.querySelector('.pass-msg').style.display = '';
                document.querySelector('.cpass-fld').style.border = '2px solid red';
                document.querySelector('.cpass-msg').style.display = '';
                return false;
            }
        }
    </script>
</body>
</html>