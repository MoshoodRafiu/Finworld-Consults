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
                <li class="">
                    <a href="dashboard.php">Upload Tasks <i class="fas fa-upload mx-1"></i></a>
                </li>
                <li class="">
                    <a href="approve.php">Approve Tasks <i class="fas fa-check mx-1"></i></a>
                </li>
                <li class="active">
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
                <form action="../action/action.php" method="post"   class="d-flex justify-content-between">
                    <button type="submit" name="exportwithdrawal" class="btn btn-style text-white m-2"><i class="fas fa-download"></i> Export Approved Withdrawals</button>
                    <button type="submit" name="clearwithdrawal" class="btn btn-success m-2"><i class="fas fa-broom"></i> Clear Withdrawal List</button>
                </form>
                <?php
                // Check if admin tries to approve or decline task
                if (isset($_GET['approve'])){
                    $withdrawal = $_GET['withdrawal'];
                    $user = $_GET['user'];
                    $amount = $_GET['amount'];
                    $con->approvewithdrawal($user, $withdrawal, $amount);
                    header("location: list.php");

                }else if (isset($_GET['decline'])) {
                    $withdrawal = $_GET['withdrawal'];
                    $user = $_GET['user'];
                    $amount = $_GET['amount'];
                    $con->declinewithdrawal($user, $withdrawal, $amount);
                    header("location: list.php");
                }else if (isset($_GET['export'])){
                ?>
                    <!-- Display export message if approved is empty -->
                    <div class="alert alert-warning mx-auto text-center" role="alert">No Approved Withdrawal</div>
                <?php
                }else if (isset($_GET['clear'])){
                    ?>
                        <!-- Display export message if withdrawal is emoty -->
                        <div class="alert alert-warning mx-auto text-center" role="alert">No Pending Withdrawals</div>
                    <?php
                    }
                ?>
                <h4 class="text-center text-muted my-4">Withdrawal List</h4>
                <form action="" method="get" class="row ml-2 my-3">
                    <select name="status" class="form-control m-1 col-md-2" required>
                        <option value="">Select Status</option>
                        <option value="all">All</option>
                        <option value="approved">Approved</option>
                        <option value="declined">Declined</option>
                        <option value="pending">Pending</option>
                    </select>
                    <input type="date" name="date" class="form-control m-1 col-md-2" required>
                    <button type="submit" class="btn btn-style m-1">Filter Withdrawals</button>
                </form>
                <table class="table">
                    <thead>
                        <tr class="table-striped text-muted">
                            <td>#</td>
                            <td><b>Username</b></td>
                            <td><b>Email</b></td>
                            <td><b>Plan</b></td>
                            <td><b>Amount</b></td>
                            <td><b>Available Balance</b></td>
                            <td><b>Withdrawal Status</b></td>
                            <td><b>Payment Status</b></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Check if user tries to fiter withdrawal
                            if (isset($_GET['date']) && isset($_GET['status'])){
                                $date = $_GET['date'];
                                $status = $_GET['status'];
                                $results = $con->filterresults($date, $status, "withdrawal");
                                if ($results){
                                    $id = 0;
                                    ?>
                                    <p class="text-center">Showing <?php echo $status ?> withdrawals for <?php echo date("l, jS \of F Y", strtotime($date)) ?></p>
                                    <?php
                                    foreach ($results as $result) {
                                        $id++;
                                        $details = $con->userdetails($result['user_id']);
                                        $username = $details["user_name"];
                                        $email = $details["email"];
                                    ?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td><?php echo $email; ?></td>
                                            <td class="text-capitalize"><?php echo $details['plan']; ?></td>
                                            <td>#<?php echo number_format($result['withdrawal_amount']); ?></td>
                                            <td>#<?php echo number_format($details['total'] - $details['withdrawn']) ; ?></td>
                                            <td class="text-capitalize"><?php echo $result['withdrawal_status']; ?></td>
                                            <td class="text-capitalize"><?php echo $result['payment_status']; ?></td>
                                            <?php
                                                if ($result['payment_status'] != "cleared"){
                                                    if ($result['withdrawal_status'] == "pending"){
                                                    ?>
                                                        <td><a class="btn btn-success" href="list.php?approve=1&user=<?php echo $result['user_id']; ?>&withdrawal=<?php echo $result['withdrawal_id']; ?>&amount=<?php echo $result['withdrawal_amount']; ?>">Approve Payment</a></td>
                                                        <td><a class="btn btn-danger" href="list.php?decline=1&user=<?php echo $result['user_id']; ?>&withdrawal=<?php echo $result['withdrawal_id']; ?>&amount=<?php echo $result['withdrawal_amount']; ?>">Decline Payment</a></td>
                                                    <?php
                                                    } else if ($result['withdrawal_status'] == "approved"){
                                                    ?>
                                                        <td><button class="btn btn-success" disabled>Approve Payment</td>
                                                        <td><a class="btn btn-danger" href="list.php?decline=1&user=<?php echo $result['user_id']; ?>&withdrawal=<?php echo $result['withdrawal_id']; ?>&amount=<?php echo $result['withdrawal_amount']; ?>">Decline Payment</a></td>
                                                    <?php
                                                    } else if ($result['withdrawal_status'] == "declined"){
                                                    ?>
                                                        <td><a class="btn btn-success" href="list.php?approve=1&user=<?php echo $result['user_id']; ?>&withdrawal=<?php echo $result['withdrawal_id']; ?>&amount=<?php echo $result['withdrawal_amount']; ?>">Approve Payment</a></td>
                                                        <td><button class="btn btn-danger" disabled>Decline Payment</button></td>
                                                    <?php
                                                    }
                                                }else {
                                                ?>
                                                    <td><button class="btn btn-success" disabled>Approve Payment</td>
                                                    <td><button class="btn btn-danger" disabled>Decline Payment</button></td>
                                                <?php
                                                }

                                            ?>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                        <p class="text-center">No <?php echo $status ?> withdrawals for <?php echo date("l, jS \of F Y", strtotime($date)) ?></p>
                                    <?php
                                }
                            }else {
                                // If not just display daily withdrawal
                                $results = $con->displaywithdrawals();
                                if ($results){
                                    $id = 0;
                                    foreach ($results as $result) {
                                        $id++;
                                        $details = $con->userdetails($result['user_id']);
                                        $username = $details["user_name"];
                                        $email = $details["email"];
                                    ?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td><?php echo $email; ?></td>
                                            <td class="text-capitalize"><?php echo $details['plan']; ?></td>
                                            <td>#<?php echo number_format($result['withdrawal_amount']); ?></td>
                                            <td>#<?php echo number_format($details['total'] - $details['withdrawn']) ; ?></td>
                                            <td class="text-capitalize"><?php echo $result['withdrawal_status']; ?></td>
                                            <td class="text-capitalize"><?php echo $result['payment_status']; ?></td>
                                            <?php
                                                if ($result['withdrawal_status'] == "pending"){
                                                ?>
                                                    <td><a class="btn btn-success" href="list.php?approve=1&user=<?php echo $result['user_id']; ?>&withdrawal=<?php echo $result['withdrawal_id']; ?>&amount=<?php echo $result['withdrawal_amount']; ?>">Approve Payment</a></td>
                                                    <td><a class="btn btn-danger" href="list.php?decline=1&user=<?php echo $result['user_id']; ?>&withdrawal=<?php echo $result['withdrawal_id']; ?>&amount=<?php echo $result['withdrawal_amount']; ?>">Decline Payment</a></td>
                                                <?php
                                                } else if ($result['withdrawal_status'] == "approved"){
                                                ?>
                                                    <td><button class="btn btn-success" disabled>Approve Payment</td>
                                                    <td><a class="btn btn-danger" href="list.php?decline=1&user=<?php echo $result['user_id']; ?>&withdrawal=<?php echo $result['withdrawal_id']; ?>&amount=<?php echo $result['withdrawal_amount']; ?>">Decline Payment</a></td>
                                                <?php
                                                } else if ($result['withdrawal_status'] == "declined"){
                                                ?>
                                                    <td><a class="btn btn-success" href="list.php?approve=1&user=<?php echo $result['user_id']; ?>&withdrawal=<?php echo $result['withdrawal_id']; ?>&amount=<?php echo $result['withdrawal_amount']; ?>">Approve Payment</a></td>
                                                    <td><button class="btn btn-danger" disabled>Decline Payment</button></td>
                                                <?php
                                                }
                                            ?>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                        <p class="text-center">No available weekly withdrawal</p>
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
    </script>
</body>

</html>