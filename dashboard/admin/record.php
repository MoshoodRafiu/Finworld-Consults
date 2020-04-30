<?php
    // start session
    session_start();
    if (!isset($_SESSION['admin'])) {
        header("Location: ../../login.php");
        exit();
    }
?>
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
        // include action.php
        include "../action/action.php";
        $adminrole = $con->getrole();
        if ($adminrole == "withdrawal"){
            header("Location: list.php");
        }else if ($adminrole == "task"){
            header("Location: approve.php");
        }else if ($adminrole == "account"){
            header("Location: users.php");
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
                <li>
                    <a href="admin.php">Manage Admin <i class="fas fa-users-cog mx-1"></i></a>
                </li>
                <li>
                    <a href="upgrade.php">Upgrades <i class="fas fa-caret-square-up mx-1"></i></a>
                </li>
                <li class="active">
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
                    <!-- sidebar roggler button -->
                    <button type="button" id="sidebarCollapse" class="btn btn-style">
                        <i class="fas fa-align-justify"></i>
                    </button>
                </div>
            </nav>

            <!-- dashboard body -->
            <div class="container-fluid">
                <h3 class="text-center text-muted mt-5">All Records</h3>
                <?php $result = $con->showrecords(); ?>
                <!-- Site History -->
                <div class="history">
                    <div class="row">
                        <!-- Registered Users -->
                        <div class="card col-md-2 col-8 my-3 mx-auto ">
                            <div class="card-body">
                                <div class="icon"><i class="fas fa-user fa-3x"></i></div>
                                <div><p class="text-white text-center small">Registered Users</p></div>
                                <div class="card-footer text-center bg-light">
                                    <p class="text-dark font-weight-bold"><?php echo number_format($result['reg_users']) ?> Users</p>
                                </div>
                            </div>
                        </div>
                        <!-- Registered Admin -->
                        <div class="card col-md-2 col-8 my-3 mx-auto">
                            <div class="card-body">
                                <div class="icon"><i class="fas fa-user-cog fa-3x"></i></div>
                                <div><p class="text-white text-center small">Registered Admins</p></div>
                                <div class="card-footer text-center bg-light">
                                    <p class="text-dark font-weight-bold"><?php echo number_format($result['reg_admins']) ?> Admins</p>
                                </div>
                            </div>
                        </div>
                        <!-- Uploaded Tasks -->
                        <div class="card col-md-2 col-8 my-3 mx-auto">
                            <div class="card-body">
                                <div class="icon"><i class="fas fa-tasks fa-3x"></i></div>
                                <div><p class="text-white text-center small">Uploaded Tasks</p></div>
                                <div class="card-footer text-center bg-light">
                                    <p class="text-dark font-weight-bold"><?php echo number_format($result['tasks']) ?> Tasks</p>
                                </div>
                            </div>
                        </div>
                        <!-- Total Upgrades -->
                        <div class="card col-md-2 col-8 my-3 mx-auto">
                            <div class="card-body">
                                <div class="icon"><i class="fas fa-caret-square-up fa-3x"></i></div>
                                <div><p class="text-white text-center small">Total Plan Upgrade</p></div>
                                <div class="card-footer text-center bg-light">
                                    <p class="text-dark font-weight-bold"><?php echo number_format($result['upgrades']) ?> Upgrades</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Total Withdrawn Earning -->
                        <div class="card col-md-2 col-8 my-3 mx-auto">
                            <div class="card-body">
                                <div class="icon"><i class="fas fa-hand-holding-usd fa-3x"></i></div>
                                <div><p class="text-white text-center small">Total Withdrawn Earning</p></div>
                                <div class="card-footer text-center bg-light">
                                    <p class="text-dark font-weight-bold">#<?php echo number_format($result['withdrawn']) ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Total Available Earning -->
                        <div class="card col-md-2 col-8 my-3 mx-auto">
                            <div class="card-body">
                                <div class="icon"><i class="fas fa-university fa-3x"></i></div>
                                <div><p class="text-white text-center small">Total Available Earning</p></div>
                                <div class="card-footer text-center bg-light">
                                    <p class="text-dark font-weight-bold">#<?php echo number_format($result['available'])  ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Total Users Earning -->
                        <div class="card col-md-2 col-8 my-3 mx-auto">
                            <div class="card-body">
                                <div class="icon"><i class="fas fa-money-check-alt fa-3x"></i></div>
                                <div><p class="text-white text-center small">Total Users Earning</p></div>
                                <div class="card-footer text-center bg-light">
                                    <p class="text-dark font-weight-bold">#<?php echo number_format($result['total']) ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Total Upgrade Earning -->
                        <div class="card col-md-2 col-8 my-3 mx-auto">
                            <div class="card-body">
                                <div class="icon"><i class="fas fa-money-bill fa-3x"></i></div>
                                <div><p class="text-white text-center small">Total Earning From Plan Upgrade</p></div>
                                <div class="card-footer text-center bg-light">
                                    <p class="text-dark font-weight-bold">#<?php echo number_format($result['totalupgrade']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jquery -->
    <script src="../../js/jquery-3.4.1.min.js"></script>

    <!-- bootstrap js -->
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        document.querySelector('#sidebarCollapse').addEventListener('click', () => {
            console.log("pressed")
            document.querySelector('#sidebar').classList.toggle('activate');
        });
    </script>
</body>

</html>