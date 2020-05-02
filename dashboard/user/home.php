<?php
    // start session
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: ../../login.php");
        exit();
    }
?>
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
                        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="withdrawal.php">Withdrawal</a></li>
                        <li class="nav-item"><a class="nav-link" href="plan.php">Change Plan</a></li>
                        <li class="nav-item"><a class="nav-link" href="../action/logout.php">Logout</a></li>
                        <li class="nav-item mx-2"><a href="#" class="nav-link"><i class="fas fa-user mx-2"></i><?php echo $_SESSION['user']; ?></a></li>
                    </ul>
                </div>
            </nav>
            <!-- page description -->
            <div class="site-description-text">
                <h2>Earn by promoting our business partners services.</h2>
                <p>Finworld Consults enables members get paid by promoting 3 sponsored post on their WhatsApp timeline daily</p>
            </div>
        </div>
    </header>
    <!-- main content of page -->
    <div class="site-body">
        <div class="info my-3 row">
            <div class="mx-auto text-center col-md-5 p-3">
                <h3>What we offer?</h3>
                <p>We primarily aim to enable everyone to develop their income by completing straightforward daily tasks. These undertakings can be successfully completed seamlessly. We connect brands with huge audiences within a short timeframe via a coordinated algorithm and artificial intelligent advert scheduling which in turn   translates into desired patronage for partners. As an advertiser you can earn up to NGN 5,500 daily by ppromoting our sponsored posts.
                </p>
            </div>
            <div class="mx-auto text-center col-md-5 p-3">
                <h3>I just registered, what next?</h3>
                <p>
                Once you have registered on this site, you will be required to select your desired plan and follow the necessary instructions. After your plan has been approved, on your overview page, you will be able to view the three sponsored post you are required to share on your WhatsApp status daily. Post them and upload a screenshot of the WhatsApp post showing your status count which should be a minimum of 32 views, then wait to be confirmed for your first earning.
                </p>
            </div>
            <div class="mx-auto text-center col-md-5 p-3">
                <h3>How do i come in?</h3>
                <p>
                Do you have over 30 views on your WhatsApp status everyday? Then you are qualified to participate. You must have an active bank account to withdraw your income every Saturday which will then be credited into the bank account you registered within 48hours.
                </p>
            </div>
            <div class="mx-auto text-center col-md-5 p-3">
                <h3>Can i earn through referral links?</h3>
                <p>
                NO, the only revenue model in this brand is posting supported promotions on your WhatsApp status, Nevertheless, you are free to inform friends and family about this legitimate E-commerce channel. Kindly note this is NOT a   Ponzi nor referral paying Scheme
                </p>
            </div>
            <div class="mx-auto text-center col-md-5 p-3">
                <h3>What if I forgot to submit my task on a particular day?</h3>
                <p>
                In the case of an unavoidable situation of not being able to upload proofs of task completion on any day most likely on the grounds that your post didn't meet  up required views or any other personal reason.It only means you won't earn for that specific day, likewise your earnings can continue the following day.
                </p>
            </div>
            <div class="mx-auto text-center col-md-5 p-3">
                <h3>Do I have to upload a screenshot of my status count on the website</h3>
                <p>
                YES, you have to upload screenshots of your status count. This enables us keep record better and determine our partners CPA.
                </p>
            </div>
            <div class="mx-auto text-center col-md-5 p-3">
                <h3>Who can withdraw?</h3>
                <p>
                    Both users on free plan and paid plans are allowed to withdraw their earning from their wallet every saturday of the week.
                </p>
            </div>
            <div class="mx-auto text-center col-md-5 p-3">
                <h3>What happens if i don't complete my daily task?</h3>
                <p>
                    Incase you are not available or unable to complete your daily task, kindly note that your subscription validity period doesn't change if you are on any of our paid plans, while the validity period remains unchanged for free plan
                </p>
            </div>
        </div>

        <!-- Advert button -->
        <div class="text-center my-5 advert">
            <a href="https://wa.me/2349024432443" class="btn px-4 py-2 btn-advert"><h4>Advertise With Us</h4></a>
        </div>
        <!-- subscription  -->
        <div class="subscription mt-5">
            <h3 class="col-12  my-3 text-center ">Subscription Plans</h3>
            <div class="row">
                <div class="sub-plan mx-auto text-center col-lg-3 col-sm-10 my-3 card">
                    <div class="card-header">
                        <h4>Basic</h4>
                    </div>
                    <div class="card-body text-left mx-auto">
                        <h5><strong class="mr-1">Fee:</strong> Free</h5>
                        <h5><strong class="mr-1">Earn:</strong> NGN150 Daily</h5>
                        <h5><strong class="mr-1">Duration:</strong> 10 Days</h5>
                        <h5><strong class="mr-1">Requirement:</strong> 32+ Views</h5>
                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-sub w-100" onclick="return false"> Not Available</a>
                    </div>
                </div>
                <div class="sub-plan mx-auto text-center col-lg-3 col-sm-10 my-3 card">
                    <div class="card-header">
                        <h4>Tier 1</h4>
                    </div>
                    <div class="card-body text-left mx-auto">
                        <h5><strong class="mr-1">Fee:</strong> NGN4,000</h5>
                        <h5><strong class="mr-1">Earn:</strong> NGN250 Daily</h5>
                        <h5><strong class="mr-1">Duration:</strong> 30 Days</h5>
                        <h5><strong class="mr-1">Requirement:</strong> 32+ Views</h5>
                    </div>
                    <div class="card-footer">
                        <a href="https://wa.me/2348179271291" class="btn btn-sub w-100">Subscribe</a>
                    </div>
                </div>
                <div class="sub-plan mx-auto text-center col-lg-3 col-sm-10 my-3 card">
                    <div class="card-header">
                        <h4>Tier 2</h4>
                    </div>
                    <div class="card-body text-left mx-auto">
                        <h5><strong class="mr-1">Fee:</strong>NGN10,000</h5>
                        <h5><strong class="mr-1">Earn:</strong> NGN600 Daily</h5>
                        <h5><strong class="mr-1">Duration:</strong> 30 Days</h5>
                        <h5><strong class="mr-1">Requirement:</strong> 32+ Views</h5>
                    </div>
                    <div class="card-footer">
                        <a href="https://wa.me/2348179271291" class="btn btn-sub w-100">Subscribe</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="sub-plan mx-auto text-center col-lg-3 col-sm-10 my-3 card">
                    <div class="card-header">
                        <h4>Tier 3</h4>
                    </div>
                    <div class="card-body text-left mx-auto">
                        <h5><strong class="mr-1">Fee:</strong> NGN15,000</h5>
                        <h5><strong class="mr-1">Earn:</strong> NGN950 Daily</h5>
                        <h5><strong class="mr-1">Duration:</strong> 30 Days</h5>
                        <h5><strong class="mr-1">Requirement:</strong> 40+ Views</h5>
                    </div>
                    <div class="card-footer">
                        <a href="https://wa.me/2348179271291" class="btn btn-sub w-100">Subscribe</a>
                    </div>
                </div>
                <div class="sub-plan mx-auto text-center col-lg-3 col-sm-10 my-3 card">
                    <div class="card-header">
                        <h4>Tier 4</h4>
                    </div>
                    <div class="card-body text-left mx-auto">
                        <h5><strong class="mr-1">Fee:</strong> NGN25,000</h5>
                        <h5><strong class="mr-1">Earn:</strong> NGN1,400 Daily</h5>
                        <h5><strong class="mr-1">Duration:</strong> 30 Days</h5>
                        <h5><strong class="mr-1">Requirement:</strong> 50+ Views</h5>
                    </div>
                    <div class="card-footer">
                        <a href="https://wa.me/2348179271291" class="btn btn-sub w-100">Subscribe</a>
                    </div>
                </div>
                <div class="sub-plan mx-auto text-center col-lg-3 col-sm-10 my-3 card">
                    <div class="card-header">
                        <h4>Tier 5</h4>
                    </div>
                    <div class="card-body text-left mx-auto">
                        <h5><strong class="mr-1">Fee:</strong> NGN50,000</h5>
                        <h5><strong class="mr-1">Earn:</strong> NGN2,850 Daily</h5>
                        <h5><strong class="mr-1">Duration:</strong> 30 Days</h5>
                        <h5><strong class="mr-1">Requirement:</strong> 100+ Views</h5>
                    </div>
                    <div class="card-footer">
                        <a href="https://wa.me/2348179271291" class="btn btn-sub w-100">Subscribe</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="sub-plan mx-auto text-center col-lg-3 col-sm-10 my-3 card">
                    <div class="card-header">
                        <h4>Tier 6</h4>
                    </div>
                    <div class="card-body text-left mx-auto">
                        <h5><strong class="mr-1">Fee:</strong> NGN100,000</h5>
                        <h5><strong class="mr-1">Earn:</strong> NGN 5,500 Daily</h5>
                        <h5><strong class="mr-1">Duration:</strong> 30 Days</h5>
                        <h5><strong class="mr-1">Requirement:</strong> 150+ Views</h5>
                    </div>
                    <div class="card-footer">
                        <a href="register.php" class="btn btn-sub w-100">Subscribe</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- contact or feedback -->
    <div class="row" id="contact">
        <div class="col-md-5 col-sm-10 my-5 faq mx-auto"></div>
        <div class="contact mx-auto my-5 col-md-5 col-sm-10" id="contact">
            <h3 class="text-center">Leave us a message</h3>
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center text-white">Contact Us</h4>
                </div>
                <div class="card-body">
                    <form action="" class="mx-auto text-center" method="POST">
                        <input type="text" name="name" placeholder="Name" class="w-75 my-3"><br/>
                        <input type="email" name="email" placeholder="Email" class="w-75 my-3"><br/>
                        <textarea name="message" id="message" placeholder="Message" class="w-75 my-3"></textarea>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn w-100">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="site-footer text-center mx-auto mt-5 bg-color">
        <div class="copyright text-center p-3 text-white "> &copy; FinWorld Consults <?php echo date("Y"); ?></div>
        <div class="mx-auto d-flex justify-content-center text-center">
            <div><a href="#" class="text-white"><i class="fab fa-facebook fa-2x mx-3"></i></a></div>
            <div><a href="#" class="text-white"><i class="fab fa-twitter fa-2x mx-3"></i></a></div>
            <div><a href="https://wa.me/2349024432443" class="text-white"><i class="fab fa-whatsapp fa-2x mx-3"></i></a></div>
            <div><a href="mailto:finworldconsults@gmail.com" class="text-white"><i class="fas fa-envelope fa-2x mx-3"></i></a></div>
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