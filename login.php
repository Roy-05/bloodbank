<?php

session_start();

// Deny access to this path if the user is logged in,
// instead redirect them to the right starting point.
if ($_SESSION['logged_in']) {
    $url =  $_SESSION['user_type'] == "H" ?  "./hospitalDashboard.php" : "./viewSamples.php";
    header("Location: $url");
    exit();
}

if (isset($_REQUEST['email'])) {
    require_once('./Model/User.php');
    $member = new User();
    $loginResult = $member->loginMember();
    echo $loginResult;
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("./Components/head.php") ?>
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>
<?php include("./Components/navbar.php") ?>

<body>
    
<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <div class="form-login">
                <form action="" method="post" name="login">
                    <h4>Sign In</h4>
                    <input type="email" name="email" placeholder="Email"  id="userName" class="form-control input-sm chat-input" required />
                    <input type="password" name="password" placeholder="Password"  id="userPassword" class="form-control input-sm chat-input"required />
                    <div class="wrapper">
                        <span class="group-btn">     
                            <input name="login_btn" class="btn btn-primary btn-md" type="submit" value="Login" />
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

</html>
