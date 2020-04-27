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
    <?php
        // start session
        session_start();

        if (!isset($_SESSION['user'])) {
            header("Location: ../../login.php");
            exit();
        }
    ?>
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
                        <li class="nav-item mx-2 active"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="profile.php">Profile</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="withdrawal.php">Withdrawal</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="plan.php">Change Plan</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="../action/logout.php">Logout</a></li>
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

    <!-- show error or success message -->
    <?php
        // include action.php
        include "../action/action.php";
    ?>
    <!-- User Details -->
    <div class="mx-auto col-md-10 text-center mt-5 mb-4">
        <h5>Logged in: <i class="fas fa-user mx-2"></i><?php echo $_SESSION['user']; ?></h5>
    </div>

    <!--daily task -->
    <div class="mt-2 col-md-10 mx-auto text-center">
        <h3>Today's task</h3>
        <?php
            $result = $con->updateearning();
            if (($result['plan'] == "basic") && ($result['basic_expiry'] < date("Y-m-d"))){
            ?>
                <div class="alert alert-warning mx-auto text-center col-lg-12 mt-5" role="alert"><h5>You Have Exhausted Your Free Trial, Please Upgrade Your Plan To Continue Earning</h5></div>"
            <?php
            }else if ($result['plan'] != "basic" && $result['other_expiry'] > 30){
            ?>
                <div class="alert alert-warning mx-auto text-center col-md-12 mt-5" role="alert"><h5>Your <b class="mx-1"><?php echo $result['plan']; ?></b> Plan Has Expired, Please Subscribe To Another Plan To Continue Earning</h5></div>"
            <?php
            }
        ?>
        <p class="text-left bg-success text-white py-4 px-5">Please Complete the task, long press the image to save and copy the text</p>
        <?php
            $task = $con->displaytask();
                ?>
                <!-- All Task -->
                <div class="">
                    <!-- First Task -->
                    <h4 class="mt-5">First Task</h4>
                    <div class="col-md-8 mx-auto bg-info task p-3 mb-5">
                        <?php if ($task['first_task_url'] != ""){
                        ?>
                            <div class="task-image">
                                <img src="../../images/tasks/<?php echo $task['first_task_url'] ?>" class="img img-fluid" alt="">
                            </div>
                        <?php
                        }
                        ?>
                        <h5 class="task-caption py-2"><?php echo $task['first_task'] ?></h5>
                        <p class="task-instruction py-2 px-1 bg-warning text-left"><span style="font-weight: bold; font-size:18px; margin-right: 5px;">Instruction: </span><?php echo $task['first_task_inst'] ?></p>
                    </div>

                    <!-- Second Task -->
                    <h4>Second Task</h4>
                    <div class="col-md-8 mx-auto bg-info task p-3 mb-5">
                        <?php if ($task['second_task_url'] != ""){
                        ?>
                            <div class="task-image">
                                <img src="../../images/tasks/<?php echo $task['second_task_url'] ?>" class="img img-fluid" alt="">
                            </div>
                        <?php
                        }
                        ?>
                        <h5 class="task-caption py-2"><?php echo $task['second_task'] ?></h5>
                        <p class="task-instruction py-2 px-1 bg-warning text-left"><span style="font-weight: bold; font-size:18px; margin-right: 5px;">Instruction: </span><?php echo $task['second_task_inst'] ?></p>
                    </div>

                    <!-- Third Task -->
                    <h4>Third Task</h4>
                    <div class="col-md-8 mx-auto bg-info task p-3 mb-5">
                        <?php if ($task['third_task_url'] != ""){
                        ?>
                            <div class="task-image">
                                <img src="../../images/tasks/<?php echo $task['third_task_url'] ?>" class="img img-fluid" alt="">
                            </div>
                        <?php
                        }
                        ?>
                        <h5 class="task-caption py-2"><?php echo $task['third_task'] ?></h5>
                        <p class="task-instruction py-2 px-1 bg-warning text-left"><span style="font-weight: bold; font-size:18px; margin-right: 5px;">Instruction: </span><?php echo $task['third_task_inst'] ?></p>
                    </div>
                </div>
            <?php
        ?>
    </div>

    <!-- task submission -->
    <h3 class="text-center mt-5">Submit task</h3>
    <?php
        if (($result['plan'] == "basic") && ($result['basic_expiry'] < date("Y-m-d"))){
        ?>
            <div class="alert alert-warning mx-auto text-center col-md-8 mt-2" role="alert"><h5>You Have Exhausted Your Free Trial, Please Upgrade Your Plan To Continue Earning</h5></div>"
        <?php
        }else if ($result['plan'] != "basic" && $result['other_expiry'] > 30){
        ?>
            <div class="alert alert-warning mx-auto text-center col-md-8 mt-2" role="alert"><h5>Your <b class="mx-1"><?php echo $result['plan']; ?></b> Plan Has Expired, Please Subscribe To Another Plan To Continue Earning</h5></div>"
        <?php
        }
    ?>
    <p class="text-center mx-3">You are required to upload a screenshot of your completed tasks</p>
    <form action="" method="post" class="col-md-8 mx-auto" enctype="multipart/form-data">
        <h5>first task</h5>
        <input type="file" name="task1" class="form-control mb-3" required>
        <h5>Second task</h5>
        <input type="file" name="task2" class="form-control mb-3" required>
        <h5>Second task</h5>
        <input type="file" name="task3" class="form-control mb-3" required>
        <div class="text-center">
            <?php
                if (($result['plan'] == "basic" && ($result['basic_expiry'] < date("Y-m-d"))) || ($result['plan'] != "basic" && $result['other_expiry'] > 30)){
                ?>
                    <button type="submit" name="submittask" class="btn text-light" disabled>Submit Tasks</button>
                <?php
                }else {
                ?>
                    <button type="submit" name="submittask" class="btn text-light">Submit Tasks</button>
                <?php
                }
            ?>
        </div>
    </form>

    <!-- Task History -->
    <div class="mx-auto text-center col-md-8 my-5">
        <h3>Task History</h3>
        <table class="table">
        <thead class="table-warning">
            <tr>
                <td>#</td>
                <td>Status</td>
                <td>Date Submitted</td>
            </tr>
            </thead>
            <tbody>
            <?php
                    $results = $con->taskhistory();
                    if ($results){
                        $id = 0;
                        foreach ($results as $results) {
                            $id++;
                        ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <?php
                                // check if withdrawal is pending
                                if ($results['approval_status'] == 'pending'){
                                ?>
                                    <td><span class="bg-warning text-capitalize text-white p-2"><?php echo $results['approval_status']; ?></span></td>
                                <?php
                                // check if withdrawal has been approved
                                }else if ($results['approval_status'] == 'approved'){
                                ?>
                                    <td><span class="bg-success text-capitalize text-white p-2"><?php echo $results['approval_status']; ?></span></td>
                                <?php
                                // check if withdrawal has been declined
                                }else if ($results['approval_status'] == 'declined'){
                                ?>
                                    <td><span class="bg-danger text-capitalize text-white p-2"><?php echo $results['approval_status']; ?></span></td>
                                <?php
                                }
                                ?>
                                <td><?php echo $results['date']; ?></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                            <p class="text-center">No Withdrawals Yet</p>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Withdrawal History -->
    <?php $con->withdrawalhistory() ?>
    <div class="mx-auto text-center col-md-8 my-5">
        <h3>Withdrawal History</h3>
        <table class="table">
            <thead class="table-warning">
                <tr>
                    <td>#</td>
                    <td>Amount</td>
                    <td>Status</td>
                    <td>Date Paid</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $results = $con->withdrawalhistory();
                    if ($results){
                        $id = 0;
                        foreach ($results as $results) {
                            $id++;
                        ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td>#<?php echo $results['withdrawal_amount']; ?></td>
                                <?php
                                // check if withdrawal is pending
                                if ($results['withdrawal_status'] == 'pending'){
                                ?>
                                    <td><span class="bg-warning text-capitalize text-white p-2"><?php echo $results['withdrawal_status']; ?></span></td>
                                <?php
                                // Check if user was paid
                                }else if ($results['withdrawal_status'] == 'approved' && $results['payment_status'] == 'cleared'){
                                    ?>
                                        <td><span class="bg-success text-capitalize text-white p-2 px-4">Paid</span></td>
                                    <?php
                                // check if withdrawal has been approved
                                }else if ($results['withdrawal_status'] == 'approved'){
                                ?>
                                    <td><span class="bg-success text-capitalize text-white p-2"><?php echo $results['withdrawal_status']; ?></span></td>
                                <?php
                                // check if withdrawal has been declined
                                }else if ($results['withdrawal_status'] == 'declined'){
                                ?>
                                    <td><span class="bg-danger text-capitalize text-white p-2"><?php echo $results['withdrawal_status']; ?></span></td>
                                <?php
                                }
                                ?>
                                <td><?php echo $results['date']; ?></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                            <p class="text-center">No Withdrawals Yet</p>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- dashboard -->
    <div class="header mt-5 text-center">
        <h3>Account Information</h3>
    </div>
    <div class="dashboard mt-3 row">
        <div class="card col-md-5 bg-warning col-10 my-5 mx-auto">
            <div class="card-body">
                <div class="text-center">
                    <i class="fas fa-user-shield icon fa-3x"></i>
                </div>
                <div class="text-center text mt-3">
                    <h4 class="text-capitalize"><b>Current Plan: </b><?php echo $result["plan"]; ?></h4>
                    <button class="btn my-1"><a href="plan.php" class="text-white" style="text-decoration: none;">Upgrade</a></button>
                </div>
            </div>
        </div>
        <div class="card col-md-5 col-10 bg-warning my-5 mx-auto">
            <div class="card-body">
                <div class="text-center">
                    <i class="fas fa-money-bill-wave icon fa-3x"></i>
                </div>
                <div class="text-center text mt-3">
                    <h4><b>Daily Earning: </b>#<?php echo $result["daily_earning"]; ?></h4>
                    <button class="btn my-1"><a href="plan.php" class="text-white" style="text-decoration: none;">Upgrade</a></button>
                </div>
            </div>
        </div>
        <div class="card col-md-5 col-10 bg-warning my-5 mx-auto">
            <div class="card-body">
                <div class="text-center">
                    <i class="fas fa-yen-sign icon fa-3x"></i>
                </div>
                <div class="text-center text mt-3">
                    <h4><b>Total Earning: </b>#<?php echo $result["total_earning"]; ?></h4>
                    <button class="btn my-1"><a href="withdrawal.php" class="text-white" style="text-decoration: none;">Withdraw</a></button>
                </div>
            </div>
        </div>
        <div class="card col-md-5 col-10 bg-warning my-5 mx-auto">
            <div class="card-body">
                <div class="text-center">
                    <i class="fas fa-university icon fa-3x"></i>
                </div>
                <div class="text-center text mt-3">
                    <h4><b>Total Withdrawn: </b>#<?php echo $result["withdrawn"]; ?></h4>
                    <button class="btn my-1"><a href="withdrawal.php" class="text-white" style="text-decoration: none;">Withdraw</a></button>
                </div>
            </div>
        </div>
        <div class="card col-md-5 col-10 bg-warning my-5 mx-auto">
            <div class="card-body">
                <div class="text-center">
                    <i class="fas fa-university icon fa-3x"></i>
                </div>
                <div class="text-center text mt-3">
                    <h4><b>Available Balance: </b>#<?php echo $result["total_earning"] - $result["withdrawn"]; ?></h4>
                    <button class="btn my-1"><a href="withdrawal.php" class="text-white" style="text-decoration: none;">Withdraw</a></button>
                </div>
            </div>
        </div>
        <div class="card col-md-5 col-10 bg-warning my-5 mx-auto">
            <div class="card-body">
                <div class="text-center">
                    <i class="fas fa-sign-out-alt icon fa-3x"></i>
                </div>
                <div class="text-center text mt-3">
                    <h4><b>Logout</h4>
                    <button class="btn my-1"><a href="../action/logout.php" class="text-white" style="text-decoration: none;">Logout</a></button>
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