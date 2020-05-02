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
    <!-- font awesome icon -->
    <script src="js/all.js"></script>

    <!-- internal style -->
    <style>
        body {
            background: url("images/login-bg.jpg")center/cover no-repeat;
            height: 100vh;
        }
    </style>
</head>

<body>
    <!-- change password form -->
    <div class="row">
        <div class="col-10 col-md-6 col-lg-4 mt-5 login mx-auto text-center">
            <div class="card my-5">

                <!-- title -->
                <div class="bg card-title">
                    <h3 class="py-3">Update New Password</h3>
                </div>

                <!-- main change password form -->
                <form action="" class="m-3" onsubmit="return check()" method="post">
                    <?php
                        // include action.php
                        include "dashboard/action/action.php";
                        // Get user details
                        if (isset($_GET['resetid'])){
                            $id = $_GET['resetid'];
                            $result = $con->userdetails($id);
                        }
                    ?>
                    <input type="email" class="form-control mt-3" name="email" value="<?php echo $result['email'] ?>" disabled>
                    <textarea name="question" class="w-100 form-control mt-3" disabled><?php echo $result['question'];  ?></textarea>
                    <input type="text" class="form-control mt-3" required="required" name="answer" placeholder="Enter Answer">
                    <p class="m-0 text-left small pass-msg" style="color: red; display: none;">Password too short or doesn't match</p>
                    <input type="password" class="form-control mt-3 pass-fld" required="required" name="password" placeholder="New Password">
                    <p class="m-0 text-left small cpass-msg" style="color: red; display: none;">Password too short or doesn't match</p>
                    <input type="password" class="form-control mt-3 cpass-fld" required="required" name="cpassword" placeholder="Confirm New Password">
                    <button type="submit" name="updatepassword" class="form-control text-white mx-auto my-2 w-75 bg">Update</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function check(){
            if (document.querySelector('.pass-fld').value != "" || document.querySelector('.cpass-fld').value != ""){
                if (document.querySelector('.pass-fld').value.length > 7 && document.querySelector('.pass-fld').value == document.querySelector('.cpass-fld').value) {
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
            }else {
                return true;
            }
        }
    </script>
</body>

</html>