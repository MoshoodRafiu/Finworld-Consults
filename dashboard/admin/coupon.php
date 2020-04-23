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
                <li>
                    <a href="users.php">Manage Users <i class="fas fa-users mx-1"></i></a>
                </li>
                <li>
                    <a href="admin.php">Manage Admin <i class="fas fa-users-cog mx-1"></i></a>
                </li>
                <li class="active">
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
                <h4 class="text-center text-muted my-4">Coupon</h4>

                <!-- generate coupon -->
                <div class="my-3">
                    <h5 class="text-muted">Generate new coupon</h5>
                    <form action="" method="post" class=" form-check d-md-flex">
                        <select name="plan" class=" form-control w-75 my-2" required>
                            <option value="">Select Plan</option>
                            <option value="Tier-1">Tier-1</option>
                            <option value="Tier-2">Tier-2</option>
                            <option value="Tier-3">Tier-3</option>
                            <option value="Tier-4">Tier-4</option>
                            <option value="Tier-5">Tier-5</option>
                        </select>
                        <button type="submit" class="btn btn-style m-2">Generate New Coupon</button>
                        </table>
                    </form>
                </div>

                <!-- all available coupon -->
                <h5 class="text-muted my-3">Sell coupon</h5>
                <table class="table">
                    <thead>
                        <tr class="table-striped text-muted">
                            <td><b>Coupon</b></td>
                            <td><b>Plan</b></td>
                            <td><b>Status</b></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>DCVSDYFVKBBHS2VH45HEKUHVB</td>
                            <td>Tier-1</td>
                            <td>Available</td>
                            <td><button class="btn btn-style px-3">Sell</button></td>
                        </tr>
                        <tr>
                            <td>VGEFVK35NET677HVHHBV66SVD</td>
                            <td>Tier-2</td>
                            <td>Available</td>
                            <td><button class="btn btn-style px-3">Sell</button></td>
                        </tr>
                        <tr>
                            <td>CGCHBUGK644UFJNFW728379YH</td>
                            <td>Tier-3</td>
                            <td>Available</td>
                            <td><button class="btn btn-style px-3">Sell</button></td>
                        </tr>
                        <tr>
                            <td>JBRV34UJNJER7482823RV0UHN</td>
                            <td>Tier-4</td>
                            <td>Available</td>
                            <td><button class="btn btn-style px-3">Sell</button></td>
                        </tr>
                        <tr>
                            <td>SEQW53Y2T3DT78OFGBFTGYC72</td>
                            <td>Tier-5</td>
                            <td>Available</td>
                            <td><button class="btn btn-style px-3">Sell</button></td>
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