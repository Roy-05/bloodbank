<?php

session_start();

// Deny access to this path if the user is logged in,
// instead redirect them to the right starting point.
if ($_SESSION['logged_in']) {
    $url =  $_SESSION['user_type'] == "H" ?  "./dashboard.php" : "./viewSamples.php";
    header("Location: $url");
    exit();
}

if (!empty($_POST['login_btn'])) {
    require_once('./Model/User.php');
    $member = new User();
    $response = $member->loginMember();
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("./components/head.php") ?>
    <title>Login</title>
</head>

<body>
    <div id="loader" class="center"></div>
    <?php include("./components/navbar.php") ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin ">
                    <div class="card-body p-4">
                        <div>
                            <h5 class="card-title text-center">Sign In</h5>
                            <div id="login-head"></div>
                        </div>
                        <form class="form-signin w-100" action="" method="post" name="login">
                            <div class="form-label-group">
                                <label for="loginEmail">Email address:</label>
                                <input type="email" name="email" id="loginEmail" class="form-control" placeholder="john.doe@example.com" required>
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="loginPassword">Password:</label>
                                <input type="password" name="password" id="loginPassword" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="row justify-content-center">
                                <input type="submit" name="login_btn" class="btn btn-rounded" value="SIGN IN" />
                            </div>
                            <div class="rows text-center mt-1">
                                <div>
                                    Dont have an account yet?
                                </div>
                                <div>
                                    Register (
                                    <a href="registerHospital.php">Hospital</a>
                                    /
                                    <a href="registerReceiver.php">Receiver</a>
                                    )
                                </div>
                            </div>
                        </form>
                        <?php
                        echo "
                                <script>
                                    display_alert('login-head', '$response[message]', '$response[status]');
                                </script>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>