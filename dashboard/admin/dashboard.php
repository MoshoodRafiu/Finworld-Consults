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
                    <a href="coupon.php">Coupon <i class="fas fa-key mx-1"></i></a>
                </li>
                <li>
                    <a href="logout.php">Logout <i class="fas fa-sign-out-alt mx-1"></i></a>
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
            <div class="container-fluid col-8 w-75">
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- first task -->
                    <h5 class="text-center text-secondary">First Task</h5>
                    <textarea name="tasktitle" class="w-100 form-control my-2" placeholder="Task Text"></textarea>
                    <input type="file" name="file1" class="w-100 form-control my-2">

                    <!-- second task -->
                    <h5 class="text-center text-secondary mt-5">Second Task</h5>
                    <textarea name="tasktitle" class="w-100 form-control my-2" placeholder="Task Text"></textarea>
                    <input type="file" name="file1" class="w-100 form-control my-2">

                    <!-- third task -->
                    <h5 class="text-center text-secondary mt-5">Third Task</h5>
                    <textarea name="tasktitle" class="w-100 form-control my-2" placeholder="Task Text"></textarea>
                    <input type="file" name="file1" class="w-100 form-control my-2">

                    <div class="text-center">
                        <button type="submit" class="my-3 btn btn-style">Upload Tasks</button>
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