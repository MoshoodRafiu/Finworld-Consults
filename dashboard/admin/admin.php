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
        // include action.php
        include "../action/action.php";
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

            <!-- remove admin dialog box -->
            <div class="freeze-layer"></div>
            <div class="withdrawal dialog-box">
                <div class="dialog-box-header"><h2>Confirm Your Request</h2></div>
                <div class="dialog-box-body"><p>Are you sure you want to delete this file?</p></div>
                <div class="dialog-box-footer">
                    <button class="btn-no">No</button>
                    <button class="btn-yes">Yes</button>
                </div>
            </div>

            <!-- dashboard body -->
            <div class="container-fluid">
                <button class="btn btn-style"><a href="addadmin.php"><i class="fas fa-plus mx-2"></i>Add Admin</a></button>
                <h4 class="text-center text-muted my-4">Manage Admin</h4>
                <?php
                // Check if cheif admin tries to delete an admin
                if (isset($_GET['remove'])){
                    $user = $_GET['user'];
                    $con->removeAdmin($user);
                    header("Location: admin.php");
                }
                ?>
                <table class="table">
                    <thead>
                        <tr class="table-striped text-muted">
                            <td>#</td>
                            <td><b>Username</b></td>
                            <td><b>Email</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $results = $con->displayallusers("admin");
                            if ($results){
                                $id = 0;
                                foreach ($results as $result) {
                                    $id++;
                                ?>
                                    <tr>
                                        <td><?php echo $id ?></td>
                                        <td><?php echo $result['user_name']; ?></td>
                                        <td><?php echo $result['email']; ?></td>
                                        <?php
                                            if ($_SESSION['admin'] == "Dr A.Y Tino"){
                                                if ($result['user_name'] == $_SESSION['admin']) {
                                                    ?>
                                                    <td><button class="btn btn-style" disabled>Remove Admin</button></td>
                                                    <?php
                                                }else {
                                                    ?>
                                                    <td><a class="btn btn-style text-white" onclick="run('<?php echo $result['user_id'] ?>')" hrref="admin.php?remove=1&user=">Remove Admin</a></td>
                                                    <?php
                                                }
                                            }else {
                                                ?>
                                                <td><button class="btn btn-style" disabled>Remove Admin</button></td>
                                                <?php
                                            }
                                        ?>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                    <p class="text-center">No registered admin</p>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
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
        function run(user) {
            document.querySelector('.freeze-layer').style.display = 'block';
            document.querySelector('.dialog-box').style.top = '50%';
            document.querySelector('.dialog-box-body').textContent = `Are you sure you want to remove this admin?`;
            document.querySelector('.btn-yes').addEventListener('click', () => {
                location.href = `admin.php?remove=1&user=${user}`;
            });
            document.querySelector('.btn-no').addEventListener('click', () => {
                document.querySelector('.freeze-layer').style.display = '';
                document.querySelector('.dialog-box').style.top = '';
            });
        }
    </script>
</body>

</html>