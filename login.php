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
    <title>Login</title>
</head>
<?php include("./Components/navbar.php") ?>

<body>
    <div class="form">
        <h1>Log In</h1>
        <form action="" method="post" name="login">
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <input name="login_btn" type="submit" value="Login" />

        </form>
    </div>
</body>

</html>