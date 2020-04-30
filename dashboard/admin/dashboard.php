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
                <li class="active">
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
                    <!-- sidebar roggler button -->
                    <button type="button" id="sidebarCollapse" class="btn btn-style">
                        <i class="fas fa-align-justify"></i>
                    </button>
                </div>
            </nav>
            <!-- dashboard body -->
            <div class="container-fluid col-md-8 col-10">
                <?php
                    if (!empty($_GET['status'])){
                        if ($_GET['status']  == "failed") {
                        ?>
                            <!-- Display error message if file is not image -->
                            <div class="alert alert-danger mx-auto text-center" role="alert">Please Select an Image File</div>
                        <?php
                        } else if ($_GET['status']  == "success") {
                        ?>
                            <!-- Display success message -->
                            <div class="alert alert-success mx-auto text-center" role="alert">Task Uploaded Successfully</div>
                        <?php
                        }
                    }else if (!empty($_GET['info'])){
                        if ($_GET['info']  == "failed") {
                        ?>
                            <!-- Display error message if file is not image -->
                            <div class="alert alert-danger mx-auto text-center" role="alert">Error Semding Information</div>
                        <?php
                        } else if ($_GET['info']  == "success") {
                        ?>
                            <!-- Display success message -->
                            <div class="alert alert-success mx-auto text-center" role="alert">Information Sent Successfully</div>
                        <?php
                        }
                    }
                ?>
                <!-- Information form -->
                <h5 class="text-center text-secondary">Upload Information</h5>
                <form action="../action/action.php" method="post" class="mb-5">
                    <textarea name="info" class="w-100 form-control my-2" placeholder="Enter Information" required></textarea>
                    <div class="text-center">
                        <button type="submit" name="uploadinfo" class="my-3 btn btn-style">Upload Information</button>
                    </div>
                </form>

                <!-- Task Form -->
                <form action="../action/action.php" method="POST" enctype="multipart/form-data">
                    <!-- plans select -->
                    <h5 class="text-center text-secondary">Select A Plan To Upload Task For</h5>
                    <select name="plan" class="form-control mb-4 mt-1" required>
                        <option value="">Select plan</option>
                        <option value="all">All</option>
                        <option value="basic">Basic</option>
                        <option value="tier-1">Tier-1</option>
                        <option value="tier-2">Tier-2</option>
                        <option value="tier-3">Tier-3</option>
                        <option value="tier-4">Tier-4</option>
                        <option value="tier-5">Tier-5</option>
                        <option value="tier-6">Tier-6</option>
                    </select>
                    <!-- first task -->
                    <h5 class="text-center text-secondary">First Task</h5>
                    <textarea name="tasktitle1" class="w-100 form-control my-2" placeholder="Task Text"></textarea>
                    <input type="text" name="inst1" class="w-100 form-control my-2" required placeholder="Task Instruction">
                    <p class="m-0 text-left small pass-msg" style="color: red; display: none;">Please Select an image file</p>
                    <input type="file" name="file1" class="w-100 form-control my-2 file1">

                    <!-- second task -->
                    <h5 class="text-center text-secondary mt-5">Second Task</h5>
                    <textarea name="tasktitle2" class="w-100 form-control my-2" placeholder="Task Text"></textarea>
                    <input type="text" name="inst2" class="w-100 form-control my-2" required placeholder="Task Instruction">
                    <p class="m-0 text-left small pass-msg" style="color: red; display: none;">Please Select an image file</p>
                    <input type="file" name="file2" class="w-100 form-control my-2 file2">

                    <!-- third task -->
                    <h5 class="text-center text-secondary mt-5">Third Task</h5>
                    <textarea name="tasktitle3" class="w-100 form-control my-2" placeholder="Task Text"></textarea>
                    <input type="text" name="inst3" class="w-100 form-control my-2" required placeholder="Task Instruction">
                    <p class="m-0 text-left small pass-msg" style="color: red; display: none;">Please Select an image file</p>
                    <input type="file" name="file3" class="w-100 form-control my-2 file3">

                    <div class="text-center">
                        <button type="submit" name="uploadtask" class="my-3 btn btn-style">Upload Tasks</button>
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
        document.querySelector('#sidebarCollapse').addEventListener('click', () => {
            console.log("pressed")
            document.querySelector('#sidebar').classList.toggle('activate');
        });
    </script>
</body>

</html>