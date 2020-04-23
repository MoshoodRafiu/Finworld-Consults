<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Finworld Consults</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">
    <!-- bootstrap stylesheet -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- external stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <!-- googlr fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Kanit:ital@1&display=swap" rel="stylesheet">
    <!-- font awesome icon -->
    <script src="js/all.js"></script>

    <!-- internal style -->
    <style>
        body {
            background: url("images/login-bg.jpg")center/cover no-repeat;
        }
    </style>
</head>

<body>
    <!-- register form -->
    <div class="row">
        <div class="col-10 col-md-6 login col-lg-4 mx-auto text-center">
            <div class="card mb-5">

                <!-- title -->
                <div class="bg card-title">
                    <h2 class="py-3">Sign up</h2>
                </div>

                <!-- main register form -->
                <form action="register.php" class="mx-3 my-3" method="post">
                    <input type="text" class="form-control mt-3" required="required" name="fname" placeholder="First Name*">
                    <input type="text" class="form-control mt-3" required="required" name="lname" placeholder="Last Name*">
                    <input type="text" class="form-control mt-3" name="uname" placeholder="Username">
                    <input type="email" class="form-control mt-3" required="required" name="email" placeholder="Email*">
                    <input type="tel" class="form-control mt-3" required="required" name="phone" placeholder="Phone*">
                    <input type="password" class="form-control mt-3" required="required" name="password" placeholder="Password*">
                    <input type="password" class="form-control mt-3 mb-1" required="required" name="cpassword" placeholder=" Confirm Password*">
                    <input type="text" class="form-control my-3" name="acctname" placeholder="Account Number*">
                    <select type="text" class="form-control " required>
                        <option selected>Select Bank</option>
                        <option value="access">Access Bank</option>
                        <option value="citibank">Citibank</option>
                        <option value="diamond">Diamond Bank</option>
                        <option value="ecobank">Ecobank</option>
                        <option value="fidelity">Fidelity Bank</option>
                        <option value="fcmb">First City Monument Bank (FCMB)</option>
                        <option value="fsdh">FSDH Merchant Bank</option>
                        <option value="gtb">Guarantee Trust Bank (GTB)</option>
                        <option value="heritage">Heritage Bank</option>
                        <option value="Keystone">Keystone Bank</option>
                        <option value="rand">Rand Merchant Bank</option>
                        <option value="skye">Skye Bank</option>
                        <option value="stanbic">Stanbic IBTC Bank</option>
                        <option value="standard">Standard Chartered Bank</option>
                        <option value="sterling">Sterling Bank</option>
                        <option value="suntrust">Suntrust Bank</option>
                        <option value="union">Union Bank</option>
                        <option value="uba">United Bank for Africa (UBA)</option>
                        <option value="unity">Unity Bank</option>
                        <option value="wema">Wema Bank</option>
                        <option value="zenith">Zenith Bank</option>
                    </select>
                    <button type="submit" name="submit" value="Register" class="form-control text-white mx-auto my-2 w-75 bg">Register</button>
                </form>

                <!-- alt links -->
                <div class="card-footer bg">
                    <a href="login.php" class="text-white mx-3">Already have an account?</a>
                    <a href="reset.php" class="text-white">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>