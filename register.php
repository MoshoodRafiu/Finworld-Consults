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
                <form action="dashboard/action/action.php" onsubmit="return check()" class="mx-3 my-3" method="post">
                    <!-- Check if user has registered -->
                    <?php
                        if (!empty($_GET['registered'])){
                            if ($_GET['registered'] == 1) {
                            ?>
                                <!-- Display success message if registered and redirect to login -->
                                <div class="alert alert-success mx-auto text-center" role="alert">User Successfully Registered</div>
                            <?php
                                header ("refresh: 1; url=login.php");
                            } else if ($_GET['registered'] == 'username_error'){
                                ?>
                                <!-- Display success message if username already exists -->
                                <div class="alert alert-danger mx-auto text-center" role="alert">Username Already Exist</div>
                            <?php
                            } else if ($_GET['registered'] == 'email_error') {
                                ?>
                                <!-- Display error message if email already exists -->
                                <div class="alert alert-danger mx-auto text-center" role="alert">Email Already Exist</div>
                            <?php
                            } else if ($_GET['registered'] == 'acct_error') {
                                ?>
                                <!-- Display error message if acct num already exists -->
                                <div class="alert alert-danger mx-auto text-center" role="alert">This Bank Account Details Has already Been Used, Multiple Accounts Not Allowed</div>
                            <?php
                            }
                        }
                    ?>
                    <input type="text" class="form-control mt-3" required="required" name="fname" placeholder="First Name*">
                    <input type="text" class="form-control mt-3" required="required" name="lname" placeholder="Last Name*">
                    <input type="text" class="form-control mt-3" name="uname" placeholder="Username">
                    <input type="email" class="form-control mt-3" required="required" name="email" placeholder="Email*">
                    <input type="tel" class="form-control my-3" required="required" name="phone" placeholder="Phone*">
                    <p class="m-0 text-left small pass-msg" style="color: red; display: none;">Password too short or doesn't match</p>
                    <input type="password" class="form-control mb-3 pass-fld" required="required" name="password" placeholder="Password*">
                    <p class="m-0 text-left small cpass-msg" style="color: red; display: none;">Password too short or doesn't match</p>
                    <input type="password" class="form-control mb-3 mb-1 cpass-fld" required="required" name="cpassword" placeholder=" Confirm Password*">
                    <input type="text" class="form-control my-3" name="acctnum" placeholder="Account Number*">
                    <select type="text" name="bname" class="form-control my-3" required>
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
                    <select type="text" name="question" class="form-control " required>
                        <option selected>Select security question</option>
                        <option value="What was your favourite place to visit as a child?">What was your favourite place to visit as a child?</option>
                        <option value="Who is your favourite actor, musician or artist?">Who is your favourite actor, musician or artist?</option>
                        <option value="What high school did you attend?">What high school did you attend?</option>
                        <option value="What is the name of your first school?">What is the name of your first school?</option>
                        <option value="What is your favourite movie?">What is your favourite movie?</option>
                        <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                        <option value="What is your favourite color?">What is your favourite color?</option>
                        <option value="What is your best friend's name?">What is your best friend's name?</option>
                    </select>
                    <input type="text" class="form-control my-3" name="answer" placeholder="answer*">
                    <button type="submit" name="register" value="Register" class="form-control text-white mx-auto my-2 w-75 bg">Register</button>
                </form>

                <!-- alt links -->
                <div class="card-footer bg">
                    <a href="login.php" class="text-white mx-3">Already have an account?</a>
                    <a href="reset.php" class="text-white">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function check(){
            if (document.querySelector('.pass-fld').value.length > 1 && document.querySelector('.pass-fld').value == document.querySelector('.cpass-fld').value) {
                document.querySelector('.pass-msg').style.display = 'none';
                document.querySelector('.cpass-msg').style.display = 'none';
                document.querySelector('.pass-fld').style.border = 'none';
                document.querySelector('.cpass-fld').style.border = 'none';
                return true;
            } else {
                document.querySelector('.pass-fld').style.border = '2px solid red';
                document.querySelector('.pass-msg').style.display = '';
                document.querySelector('.cpass-fld').style.border = '2px solid red';
                document.querySelector('.cpass-msg').style.display = '';
                return false;
            }
        }

    </script>
</body>

</html>