<?php
session_start();
// Deny access to this path if the user is logged in,
// instead redirect them to the right starting point.
if ($_SESSION['logged_in']) {
    $url =  $_SESSION['user_type'] == "H" ?  "./dashboard.php" : "./viewSamples.php";
    header("Location: $url");
    exit();
}

if (!empty($_POST["register_btn"])) {
    require_once('./Model/User.php');
    $member = new User();
    $response = $member->registerMember('H');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include("./components/head.php") ?>
        <title>Register - Hospital</title>
    </head>
    <body>
        <div id="loader" class="center"></div> 
        <?php include("./components/navbar.php") ?>
        <div class="container mt-3">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin">
                        <div class="card-body p-4">
                            <div>
                                <h5 class="card-title text-center">Register - Hospital</h5>
                                <div id="reg-hos-head"></div>
                            </div>
                           
                            <form class="form-signin w-100" action="" method="post" name="registration">
                                <div class="form-label-group">
                                    <label for="regHosName">Hospital Name:</label>
                                    <input type="text" name="hos_name" id="regHosName" class="form-control" placeholder="AIIMS Hospital" required>
                                </div>
                                <div class="form-label-group">
                                    <label for="regHosEmail">Official Email Address:</label>
                                    <input type="email" name="email" id="regHosEmail" class="form-control" placeholder="name@hospital_name.com" required>
                                </div>
                                <div class="form-label-group mb-4">
                                    <label for="regHosPassword">Password:</label>
                                    <input type="password" name="password" id="regHosPassword" class="form-control" placeholder="Password" required>
                                </div>
                                <input type="submit" name="register_btn"  class="btn btn-lg btn-primary btn-block" value="REGISTER" />
                                <div class="row justify-content-center mt-1">
                                    Already have an account?    
                                    <a href="login.php">Login.</a>
                                </div>
                            </form>
                            <?php 
                                echo "
                                <script>
                                    display_alert('reg-hos-head', '$response[message]', '$response[status]');
                                </script>";
                             ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>