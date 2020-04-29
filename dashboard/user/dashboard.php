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
                        <li class="nav-item mx-2"><a href="#" class="nav-link"><i class="fas fa-user mx-2"></i><?php echo $_SESSION['user']; ?></a></li>
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

    <!-- Information board -->
    <?php $info = $con->getinfo() ?>
    <div class="mt-5 col-md-10 mx-5 mx-auto text-center">
        <h3>Information Board</h3>
        <p class="task-instruction col-md-10 mx-auto py-3 px-2 my-1 bg-color text-left"><?php echo $info; ?></p>
    </div>
    <!--daily task -->
    <div class="mt-5 col-md-10 mx-auto text-center">
        <h3>Today's task</h3>
        <?php
            $result = $con->updateearning();
            if (($result['plan'] == "basic") && ($result['basic_expiry'] < date("Y-m-d"))){
            ?>
                <div class="alert alert-warning mx-auto text-center col-lg-12 mt-5" role="alert"><h5>You Have Exhausted Your Free Trial, Please Upgrade Your Plan To Continue Earning</h5></div>"
            <?php
            }else if ($result['plan'] != "basic" && $result['other_expiry'] == 30){
            ?>
                <div class="alert alert-warning mx-auto text-center col-md-12 mt-5" role="alert"><h5>Your <b class="mx-1"><?php echo $result['plan']; ?></b> Plan Has Expired, Please Subscribe To Another Plan To Continue Earning</h5></div>"
            <?php
            }
            else if ($result['status'] == 'restricted'){
            ?>
                <div class="alert alert-warning text-capitalize mx-auto text-center col-md-12 mt-2" role="alert"><h5>Your account has been restricted for some reasons, Please contact the admin for clarification</h5></div>"
            <?php
            }
        ?>
        <h5 class="text-left bg-success col-md-10 mx-auto text-white py-4 px-5">Please Complete the task, long press the image to save and copy the text</h5>
        <?php
            $val = $con->getuserid();
            $result = $con->userdetails($val);
            $plan = $result['plan'];
            $task = $con->displaytask($plan);
                ?>
                <!-- All Task -->
                <div class="">
                    <!-- First Task -->
                    <?php
                        if ($task['first_task'] != "" || $task['first_task_url'] != "" || $task['first_task_inst'] != ""){
                        ?>
                            <h4 class="mt-5">First Task</h4>
                            <div class="col-md-8 mx-auto bg-color task px-3 py-1 mb-5">
                                <?php if ($task['first_task_url'] != ""){
                                ?>
                                    <div class="task-image">
                                        <img src="../../images/tasks/<?php echo $task['first_task_url'] ?>" class="img img-fluid" alt="">
                                    </div>
                                <?php
                                }
                                ?>
                                <p class="task-caption py-2"><?php echo $task['first_task'] ?></p>
                                <p class="task-instruction py-2 px-1 my-1 bg-style small text-left"><span style="font-weight: bold; font-size:15px; margin-right: 5px;">Instruction: </span><?php echo $task['first_task_inst'] ?></p>
                            </div>
                        <?php
                        }else {
                        ?>
                            <div class="col-md-8 mx-auto bg-color task px-3 py-4 my-5">
                                <p>No Task Currently Available For Today, Check Back Later</p>
                            </div>
                        <?php
                        }
                    ?>

                    <!-- Second Task -->
                    <?php
                        if ($task['second_task'] != "" || $task['second_task_url'] != "" || $task['second_task_inst'] != ""){
                        ?>
                            <h4>Second Task</h4>
                            <div class="col-md-8 mx-auto bg-color task px-3 py-1 mb-5">
                                <?php if ($task['second_task_url'] != ""){
                                ?>
                                    <div class="task-image">
                                        <img src="../../images/tasks/<?php echo $task['second_task_url'] ?>" class="img img-fluid" alt="">
                                    </div>
                                <?php
                                }
                                ?>
                                <p class="task-caption py-2"><?php echo $task['second_task'] ?></p>
                                <p class="task-instruction py-2 px-1 bg-style small text-left"><span style="font-weight: bold; font-size:15px; margin-right: 5px;">Instruction: </span><?php echo $task['second_task_inst'] ?></p>
                            </div>
                        <?php
                        }else {
                        ?>
                            <div class="col-md-8 mx-auto bg-color task px-3 py-4 mb-5">
                                <p>No Task Currently Available For Today, Check Back Later</p>
                            </div>
                        <?php
                        }
                    ?>

                    <!-- Third Task -->
                    <?php
                        if ($task['third_task'] != "" || $task['third_task_url'] != "" || $task['third_task_inst'] != ""){
                        ?>
                            <h4>Third Task</h4>
                            <div class="col-md-8 mx-auto bg-color task p-3 mb-5">
                                <?php if ($task['third_task_url'] != ""){
                                ?>
                                    <div class="task-image">
                                        <img src="../../images/tasks/<?php echo $task['third_task_url'] ?>" class="img img-fluid" alt="">
                                    </div>
                                <?php
                                }
                                ?>
                                <p class="task-caption py-2"><?php echo $task['third_task'] ?></p>
                                <p class="task-instruction py-2 px-1 small bg-style text-left"><span style="font-weight: bold; font-size:15px; margin-right: 5px;">Instruction: </span><?php echo $task['third_task_inst'] ?></p>
                            </div>
                        <?php
                        }else {
                        ?>
                            <div class="col-md-8 mx-auto bg-color task px-3 py-4 mb-5">
                                <p>No Task Currently Available For Today, Check Back Later</p>
                            </div>
                        <?php
                        }
                    ?>

                </div>
            <?php
        ?>
    </div>

    <!-- task submission -->
    <h3 class="text-center mt-5">Submit task</h3>
    <?php
        $result = $con->updateearning();
        if (($result['plan'] == "basic") && ($result['basic_expiry'] < date("Y-m-d"))){
        ?>
            <div class="alert alert-warning mx-auto text-center col-md-8 mt-2" role="alert"><h5>You Have Exhausted Your Free Trial, Please Upgrade Your Plan To Continue Earning</h5></div>"
        <?php
        }else if ($result['plan'] != "basic" && $result['other_expiry'] == 30){
        ?>
            <div class="alert alert-warning mx-auto text-center col-md-8 mt-2" role="alert"><h5>Your <b class="mx-1"><?php echo $result['plan']; ?></b> Plan Has Expired, Please Subscribe To Another Plan To Continue Earning</h5></div>"
        <?php
        }else if ($result['status'] == 'restricted'){
        ?>
            <div class="alert alert-warning text-capitalize mx-auto text-center col-md-8 mt-2" role="alert"><h5>Your account has been restricted for some reasons, Please contact the admin for clarification</h5></div>"
        <?php
        }
    ?>
    <p class="text-center mx-3">You are required to upload a screenshot of your completed tasks</p>
    <form action="" method="post" class="col-md-8 mx-auto" enctype="multipart/form-data">
        <h5>first task</h5>
        <input type="file" name="task1" class="form-control mb-3" required>
        <h5>Second task</h5>
        <input type="file" name="task2" class="form-control mb-3" required>
        <h5>Third task</h5>
        <input type="file" name="task3" class="form-control mb-3" required>
        <div class="text-center">
            <?php
                if (($result['plan'] == "basic" && ($result['basic_expiry'] < date("Y-m-d"))) || ($result['plan'] != "basic" && $result['other_expiry'] == 30) || $result['status'] == 'restricted' ){
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
        <thead class="table-color">
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
            <thead class="table-color">
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
    <div class="dashboard mt-3">
        <div class="row">
            <div class="card col-md-3 bg-color col-10 m-5 mx-auto">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-user-shield icon fa-3x"></i>
                    </div>
                    <div class="text-center text-white text mt-3">
                        <h4 class="text-capitalize"><b>Current Plan: </b><?php echo $result["plan"]; ?></h4>
                        <?php
                            if (($result['plan'] == "basic" && ($result['basic_expiry'] < date("Y-m-d"))) || ($result['plan'] != "basic" && $result['other_expiry'] == 30)){
                                ?>
                                    <p class="small">Expired</p>
                                <?php
                            }else{
                                if ($result["plan"] == "basic"){
                                ?>
                                    <p class="small">Expires on <?php echo date("jS \of F Y", strtotime($result['basic_expiry'])) ?></p>
                                <?php
                                }else {
                                ?>
                                    <p class="small"><?php echo $result['other_expiry'] ?> days used, <?php echo 30-$result['other_expiry'] ?> days till plan expiry</p>
                                <?php
                                }
                            }
                        ?>
                        <a href="plan.php" class="btn btn-style" style="text-decoration: none;">Upgrade</a>
                    </div>
                </div>
            </div>
            <div class="card col-md-3 col-10 bg-color m-5 mx-auto">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-money-bill-wave icon fa-3x"></i>
                    </div>
                    <div class="text-center text-white text mt-3">
                        <h4><b>Daily Earning: </b>#<?php echo number_format($result["daily_earning"]); ?></h4>
                        <a href="plan.php" class="btn btn-style" style="text-decoration: none;">Upgrade</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card col-md-3 col-10 bg-color my-5 mx-auto">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-money-bill icon fa-3x"></i>
                    </div>
                    <div class="text-center text-white text mt-3">
                        <h4><b>Total Earning: </b>#<?php echo number_format($result["total_earning"]); ?></h4>
                        <a href="withdrawal.php" class="btn btn-style" style="text-decoration: none;">Withdraw</a>
                    </div>
                </div>
            </div>
            <div class="card col-md-3 col-10 bg-color my-5 mx-auto">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-university icon fa-3x"></i>
                    </div>
                    <div class="text-center text-white  text mt-3">
                        <h4><b>Total Withdrawn: </b>#<?php echo number_format($result["withdrawn"]); ?></h4>
                        <a href="withdrawal.php" class="btn btn-style" style="text-decoration: none;">Withdraw</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card col-md-3 col-10 bg-color my-5 mx-auto">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-university icon fa-3x"></i>
                    </div>
                    <div class="text-center text-white text mt-3">
                        <h4><b>Available: </b>#<?php echo number_format($result["total_earning"] - $result["withdrawn"]); ?></h4>
                        <a href="withdrawal.php" class="btn btn-style" style="text-decoration: none;">Withdraw</a>
                    </div>
                </div>
            </div>
            <div class="card col-md-3 col-10 bg-color my-5 mx-auto">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-sign-out-alt icon fa-3x"></i>
                    </div>
                    <div class="text-center text-white text mt-3">
                        <h4><b>Logout</h4>
                        <a href="withdrawal.php" class="btn btn-style" style="text-decoration: none;">Logout</a>
                    </div>
                </div>
            </div>
        </div>

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
</body>

</html>