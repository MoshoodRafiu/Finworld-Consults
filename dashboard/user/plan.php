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
                        <li class="nav-item mx-2"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="profile.php">Profile</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="withdrawal.php">Withdrawal</a></li>
                        <li class="nav-item mx-2 active"><a class="nav-link" href="plan.php">Change Plan</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
            <!-- page description -->
            <div class="site-description-text">
                <h2>Explore amazing plans </h2>
                <p>Upgarde your current plan to boost your earning</p>
            </div>
        </div>
    </header>

    <!-- main page content -->

    <!-- upgrade  details -->

    <div class="plan-details col-10 text-center mx-auto my-5">
        <p>
            Browse your plan on this page, click subscribe and you'll be redirected to our Whatsapp page to purchase your coupon. After your Coupon has been generated, paste your coupon in the field below to activate your upgrade
        </p>
    </div>
    <!-- plan upgrade form -->
    <div class="plan-form col-md-8 mx-auto my-3">
        <h3 class="text-center mb-3">Enter you coupon to upgrade your plan</h3>
        <form action="" method="post" class="text-center mx-auto">
            <table class="text-center mx-auto w-100">
                <tr>
                    <td><input type="text" name="coupon" class="form-control" placeholder="Enter you coupon" required></td>
                    <td>
                        <select name="plan" class=" form-control" required>
                            <option value="">Select Plan</option>
                            <option value="Tier-1">Tier-1</option>
                            <option value="Tier-2">Tier-2</option>
                            <option value="Tier-3">Tier-3</option>
                            <option value="Tier-4">Tier-4</option>
                            <option value="Tier-5">Tier-5</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="text-center my-2">
                <button type="submit" class="btn btn-style text-white  ">Change plan</button>
            </div>
        </form>
    </div>
    <!-- subscription plan -->
    <div class="plan  my-5 mx-auto">
        <h3 class="text-center my-3 p-2">Change your plan</h3>
        <div class="row">
            <div class="sub-plan mx-auto text-center col-lg-3 col-10 my-3 card">
                <div class="card-header">
                    <h4>Basic</h4>
                </div>
                <div class="card-body">
                    <h5><strong>Free:</strong> Free</h5>
                    <h5><strong>Earn:</strong> #120</h5>
                    <h5><strong>Duration:</strong> 10 Days</h5>
                    <h5><strong>Requirement:</strong> 32+ Views</h5>
                </div>
                <div class="card-footer">
                    <button class="btn w-100">Subscribe</button>
                </div>
            </div>
            <div class="sub-plan mx-auto text-center col-lg-3 col-10 my-3 card">
                <div class="card-header">
                    <h4>Tier 1</h4>
                </div>
                <div class="card-body">
                    <h5><strong>Free:</strong> #4,000</h5>
                    <h5><strong>Earn:</strong> #250</h5>
                    <h5><strong>Duration:</strong> 30 Days</h5>
                    <h5><strong>Requirement:</strong> 32+ Views</h5>
                </div>
                <div class="card-footer">
                    <button class="btn w-100">Subscribe</button>
                </div>
            </div>
            <div class="sub-plan mx-auto text-center col-lg-3 col-10 my-3 card">
                <div class="card-header">
                    <h4>Tier 2</h4>
                </div>
                <div class="card-body">
                    <h5><strong>Free:</strong> #10,000</h5>
                    <h5><strong>Earn:</strong> #600</h5>
                    <h5><strong>Duration:</strong> 30 Days</h5>
                    <h5><strong>Requirement:</strong> 50+ Views</h5>
                </div>
                <div class="card-footer">
                    <button class="btn w-100">Subscribe</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="sub-plan mx-auto text-center col-lg-3 col-10 my-3 card">
                <div class="card-header">
                    <h4>Tier 3</h4>
                </div>
                <div class="card-body">
                    <h5><strong>Free:</strong> #15,000</h5>
                    <h5><strong>Earn:</strong> #950</h5>
                    <h5><strong>Duration:</strong> 30 Days</h5>
                    <h5><strong>Requirement:</strong> 50+ Views</h5>
                </div>
                <div class="card-footer">
                    <button class="btn w-100">Subscribe</button>
                </div>
            </div>
            <div class="sub-plan mx-auto text-center col-lg-3 col-10 my-3 card">
                <div class="card-header">
                    <h4>Tier 4</h4>
                </div>
                <div class="card-body">
                    <h5><strong>Free:</strong> #25,000</h5>
                    <h5><strong>Earn:</strong> #1,400</h5>
                    <h5><strong>Duration:</strong> 30 Days</h5>
                    <h5><strong>Requirement:</strong> 75+ Views</h5>
                </div>
                <div class="card-footer">
                    <button class="btn w-100">Subscribe</button>
                </div>
            </div>
            <div class="sub-plan mx-auto text-center col-lg-3 col-10 my-3 card">
                <div class="card-header">
                    <h4>Tier 5</h4>
                </div>
                <div class="card-body">
                    <h5><strong>Free:</strong> #50,000</h5>
                    <h5><strong>Earn:</strong> #3,000</h5>
                    <h5><strong>Duration:</strong> 30 Days</h5>
                    <h5><strong>Requirement:</strong> 100+ Views</h5>
                </div>
                <div class="card-footer">
                    <button class="btn w-100">Subscribe</button>
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