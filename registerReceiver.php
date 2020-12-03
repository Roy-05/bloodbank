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
       $registrationResponse = $member->registerMember('R');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include("./components/head.php") ?>
        <title>Sign Up - Receiver</title>
    </head>
    <body>
        <?php include("./components/navbar.php") ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin">
                        <div class="card-body p-4">
                            <h5 class="card-title text-center">Register - Receiver</h5>
                            <form class="form-signin w-100" action="" method="post" name="registration">
                                <div class="row">    
                                    <div class="col-6 form-label-group">
                                        <label for="regFirstName">First Name:</label>
                                        <input type="text" name="first_name" id="regFirstName" class="form-control" placeholder="John" required>
                                    </div>
                                    <div class="col-6 form-label-group">
                                        <label for="regLastName">Last Name:</label>
                                        <input type="text" name="last_name" id="regLastName" class="form-control" placeholder="Doe" >
                                    </div>
                                </div>
                                <div class="form-label-group">
                                    <label for="regBloodType">Blood Type:</label>
                                    <input type="text" name="blood_type" id="regBloodType" class="form-control" placeholder="A+, O+, AB-, etc..." required>
                                </div>
                                <div class="form-label-group">
                                    <label for="regRcvrEmail">Email Address:</label>
                                    <input type="email" name="email" id="regRcvrEmail" class="form-control" placeholder="name@hospital_name.com" required>
                                </div>
                                <div class="form-label-group">
                                    <label for="regRcvrPassword">Password:</label>
                                    <input type="password" name="password" id="regRcvrPassword" class="form-control" placeholder="Password" required>
                                </div>
                                <input type="submit" name="register_btn"  class="btn btn-lg btn-primary btn-block" value="REGISTER" />
                                <hr class="my-4">
                                <div>
                                    Already have an account?    
                                    <a href="login.php">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
