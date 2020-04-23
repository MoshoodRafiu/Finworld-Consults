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
            <div class="container-fluid">
                <h4 class="text-center text-muted my-4">Manage Registered Users</h4>
                <form method='get' action="" class="row ml-2 my-3">
                    <input type="search" name="search" class="form-control col-md-4 col-9" placeholder="Search username" required>
                    <button type="submit" class="mx-3 btn btn-success"><i class="fas fa-search"></i></button>
                </form>
                <table class="table">
                    <thead>
                        <tr class="table-striped text-muted">
                            <td><b>Username</b></td>
                            <td><b>Email</b></td>
                            <td><b>Active Plan</b></td>
                            <td><b>Total Earning</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>User 1</td>
                            <td>user@gmail.com</td>
                            <td>Basic</td>
                            <td>#5000</td>
                            <td><button class="btn btn-style">Restrict Account</button></td>
                            <td><button class="btn btn-success" disabled>Approve</button></td>
                        </tr>
                        <tr>
                            <td>User 2</td>
                            <td>user@gmail.com</td>
                            <td>Basic</td>
                            <td>#7000</td>
                            <td><button class="btn btn-style" disabled>Restrict Account</button></td>
                            <td><button class="btn btn-success">Approve</button></td>
                        </tr>
                        <tr>
                            <td>User 3</td>
                            <td>user@gmail.com</td>
                            <td>Premium</td>
                            <td>#35000</td>
                            <td><button class="btn btn-style">Restrict Account</button></td>
                            <td><button class="btn btn-success" disabled>Approve</button></td>
                        </tr>
                        <tr>
                            <td>User 4</td>
                            <td>user@gmail.com</td>
                            <td>Premium</td>
                            <td>#45000</td>
                            <td><button class="btn btn-style" disabled>Restrict Account</button></td>
                            <td><button class="btn btn-success">Approve</button></td>
                        </tr>
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