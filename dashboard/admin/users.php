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
        }
    ?>
    <!-- dashboard page -->
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="">
        <?php
            // Check if admin role is account manager and disable other links
            if ($adminrole == "account"){
            ?>
                <ul class="list-unstyled components">
                    <h5 class="p-3 text-center mb-5 sidebar-header">Dashboard <i class="fas fa-tachometer-alt"></i></h5>
                    <li>
                        <a href="dashboard.php" onclick="return false">Upload Tasks <i class="fas fa-upload mx-1"></i></a>
                    </li>
                    <li class="">
                        <a href="approve.php" onclick="return false">Approve Tasks <i class="fas fa-check mx-1"></i></a>
                    </li>
                    <li class="">
                        <a href="list.php" onclick="return false">Withdrawal List <i class="fas fa-list mx-1"></i></a>
                    </li>
                    <li class="active">
                        <a href="users.php">Manage Users <i class="fas fa-users mx-1"></i></a>
                    </li>
                    <li>
                        <a href="admin.php" onclick="return false">Manage Admin <i class="fas fa-users-cog mx-1"></i></a>
                    </li>
                    <li>
                        <a href="upgrade.php" onclick="return false">Upgrades <i class="fas fa-caret-square-up mx-1"></i></a>
                    </li>
                    <li>
                        <a href="record.php" onclick="return false">Records <i class="fas fa-scroll mx-1"></i></a>
                    </li>
                    <li>
                        <a href="../action/logout.php">Logout <i class="fas fa-sign-out-alt mx-1"></i></a>
                    </li>
                </ul>
            <?php

            }else {
            ?>
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
                <li class="active">
                    <a href="users.php">Manage Users <i class="fas fa-users mx-1"></i></a>
                </li>
                <li>
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
            <?php
            }
        ?>
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

            <!-- upgrade plan dialog box -->
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
            <?php
                // Check if admin tries to approve or restrict account
                if (isset($_GET['approve'])){
                    $user = $_GET['user'];
                    $con->approveuser($user);
                    header("Location: users.php");

                }else if (isset($_GET['restrict'])) {
                    $user = $_GET['user'];
                    $con->restrictuser($user);
                    header("Location: users.php");
                }else if (isset($_GET['upgrade'])) {
                    $user = $_GET['user'];
                    $oldplan = $_GET['oldplan'];
                    $newplan = $_GET['newplan'];
                    $result = $con->upgradeplan($user, $newplan, $oldplan);
                    header("Location: users.php");
                }
            ?>
            <div class="container-fluid">
                <h4 class="text-center text-muted my-4">Manage Registered Users</h4>
                <form method='get' action="" class="row ml-2 my-3">
                    <input type="search" name="search" class="form-control col-md-4 col-9" placeholder="Search username" required>
                    <button type="submit" class="mx-3 btn btn-success"><i class="fas fa-search"></i></button>
                </form>
                <table class="table">
                    <thead>
                        <tr class="table-striped text-muted">
                            <td>#</td>
                            <td><b>Username</b></td>
                            <td><b>Email</b></td>
                            <td><b>Available Earning</b></td>
                            <td><b>Account Status</b></td>
                            <td><b>Active Plan</b></td>
                            <td><b>Change Plan</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $results = $con->displayallusers("user");
                            if ($results){
                                $id = 0;
                                foreach ($results as $result) {
                                    $id++;
                                ?>
                                    <tr id="<?php echo $result['user_id'] ?>">
                                        <td><?php echo $id ?></td>
                                        <td><?php echo $result['user_name']; ?></td>
                                        <td><?php echo $result['email']; ?></td>
                                        <td>#<?php echo number_format($result['total_earning'] - $result['withdrawn_earning']); ?></td>
                                        <td class="text-capitalize"><?php echo $result['account_status']; ?></td>
                                        <td class="text-capitalize old-plan-<?php echo $result['user_id'] ?>"><?php echo $result['plan']; ?></td>
                                        <td><select name="plan" class="form-control new-plan-<?php echo $result['user_id'] ?>">
                                            <option value="">Select Plan</option>
                                            <option value="Tier-1">Tier-1</option>
                                            <option value="Tier-2">Tier-2</option>
                                            <option value="Tier-3">Tier-3</option>
                                            <option value="Tier-4">Tier-4</option>
                                            <option value="Tier-5">Tier-5</option>
                                            <option value="Tier-6">Tier-6</option>
                                        </select></td>
                                        <td><button class="btn btn-primary" onclick="run('<?php echo $result['user_id'] ?>')">Upgrade Account</button></td>
                                        <?php
                                            if ($result['account_status'] == "approved") {
                                            ?>
                                                <td><a class="btn btn-danger" href="users.php?restrict=1&user=<?php echo $result['user_id'] ?>">Restrict Account</a></td>
                                                <td><button class="btn btn-success" disabled>Approve Account</button></td>
                                            <?php
                                            } else if ($result['account_status'] == "restricted") {
                                            ?>
                                                <td><button class="btn btn-danger" disabled>Restrict Account</button></td>
                                                <td><a class="btn btn-success" href="users.php?approve=1&user=<?php echo $result['user_id'] ?>">Approve Account</a></td>
                                            <?php
                                            }
                                        ?>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                    <p class="text-center">No registered user</p>
                                <?php
                            }
                        ?>
                    </tbody>

                    <?php
                    // Goto searched user location
                        if (isset($_GET['search'])){
                            $user =$_GET['search'];
                            $id = $con->searchuser($user);
                            if ($id == "No result") {
                            ?>
                                <div class="alert alert-warning mx-auto text-center" role="alert">User Not Registered</div>
                            <?php
                            } else {
                            ?>
                                <script>
                                    document.querySelector(".table").rows.namedItem("<?php echo $id; ?>").classList.add("bg-warning");
                                    window.location.hash = "<?php echo $id; ?>";
                                </script>
                            <?php
                            }
                        }
                    ?>
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
            let newplan = document.querySelector('.new-plan-' + user);
            let oldplan = document.querySelector('.old-plan-' + user);
            if (newplan.value != "" && (newplan.value != oldplan.textContent)){
                newplan.style.border = "";
                document.querySelector('.freeze-layer').style.display = 'block';
                document.querySelector('.dialog-box').style.top = '50%';
                document.querySelector('.dialog-box-body').textContent = `Are you sure you want to change this user plan to from ${oldplan.textContent} to ${newplan.value}?`;
                document.querySelector('.btn-yes').addEventListener('click', () => {
                    location.href = `users.php?upgrade=1&user=${user}&newplan=${newplan.value}&oldplan=${oldplan.textContent}`;
                });
                document.querySelector('.btn-no').addEventListener('click', () => {
                    document.querySelector('.freeze-layer').style.display = '';
                    document.querySelector('.dialog-box').style.top = '';
                });
            }else {
                newplan.style.border = "2px solid red";
            }

        }
    </script>
</body>

</html>