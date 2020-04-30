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
                <li>
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
                <li class="active">
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

            <!-- view dialog box -->
            <div class="freeze-layer"></div>
            <div class="dialog-box">
                <div class="dialog-box-header">
                    <h2>Verify task</h2>
                </div>
                <div class="dialog-box-body">
                    <img src="" alt="task" class="img img-fluid view p-3" style="max-height: 100%">
                </div>
                <div class="dialog-box-footer">
                    <button class="btn-no"><i class="fas fa-times mx-1"></i>Close</button>
                </div>
            </div>

            <!-- dashboard body -->
            <?php
                // Check if admin tries to approve or decline task
                if (isset($_GET['approve'])){
                    $task = $_GET['task'];
                    $user = $_GET['user'];
                    $con->approvetask($user, $task);
                }else if (isset($_GET['decline'])) {
                    $task = $_GET['task'];
                    $user = $_GET['user'];
                    $con->declinetask($user, $task);
                }
            ?>
            <div class="container-fluid">
                <h4 class="text-center text-muted my-4">Plan Upgrades</h4>
                <form action="" method="get" class="row ml-2 my-3">
                    <select name="admin" class="form-control m-1 col-md-2" required>
                        <option value="">Select Admin</option>
                        <option value="All">All</option>
                        <?php
                            $results = $con->allupgraders();
                            if ($results){
                                foreach ($results as $result) {
                                ?>
                                        <option value="<?php echo $result['user_name']; ?>"><?php echo $result['user_name']; ?></option>
                                <?php
                                }
                            }
                        ?>
                    </select>
                    <input type="date" name="date" class="form-control m-1 col-md-2" required>
                    <button type="submit" class="btn btn-style m-1">Filter Upgrades</button>
                </form>
                <table class="table">
                    <thead>
                        <tr class="table-striped text-muted">
                            <td>#</td>
                            <td><b>Admin name</b></td>
                            <td><b>Username</b></td>
                            <td><b>Changed From</b></td>
                            <td><b>Changed To</b></td>
                            <td><b>Amount Expected</b></td>
                            <td><b>Date</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (isset($_GET['date']) && isset($_GET['admin'])){
                                $date = $_GET['date'];
                                $admin = $_GET['admin'];
                                $results = $con->filterupgrades($admin,$date);
                                if ($results){
                                    $id = 0;
                                    ?>
                                    <p class="text-center">Showing upgrades by <?php echo $admin ?> on <?php echo date("l, jS \of F Y", strtotime($date)) ?></p>
                                    <?php
                                    foreach ($results as $result) {
                                        $id++;
                                        $details = $con->userdetails($result['user_id']);
                                        $username = $details["user_name"];
                                    ?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $result['admin_name']; ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td><?php echo $result['old_plan']; ?></td>
                                            <td><?php echo $result['new_plan']; ?></td>
                                            <td><?php echo number_format($result['amount']); ?></td>
                                            <td><?php echo $result['date']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <p class="text-center">No upgrades by <?php echo $admin ?> on <?php echo date("l, jS \of F Y", strtotime($date)) ?></p>
                                    <?php
                                }
                            }else {
                                $results = $con->displayupgrades();
                                if ($results){
                                    $id = 0;
                                    foreach ($results as $result) {
                                        $id++;
                                        $details = $con->userdetails($result['user_id']);
                                        $username = $details["user_name"];
                                    ?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $result['admin_name']; ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td><?php echo $result['old_plan']; ?></td>
                                            <td><?php echo $result['new_plan']; ?></td>
                                            <td><?php echo number_format($result['amount']); ?></td>
                                            <td><?php echo $result['date']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                        <p class="text-center">No upgrades today</p>
                                    <?php
                                }
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

        function run(name) {
            document.querySelector('.freeze-layer').style.display = 'block';
            document.querySelector('.view').src= `../../images/submit/${name}`;
            document.querySelector('.dialog-box').style.top = '50%';
            document.querySelector('.btn-no').addEventListener('click', () => {
                document.querySelector('.freeze-layer').style.display = '';
                document.querySelector('.dialog-box').style.top = '';
            });
        }
    </script>
</body>

</html>
