<?php
    session_start();
    // Deny access to this path if the user is logged in,
    // instead redirect them to the right starting point.
    if($_SESSION['logged_in']){
        $url =  $_SESSION['user_type'] == "H" ?  "./hospitalDashboard.php" : "./viewSamples.php";
        header("Location: $url");
        exit(); 
    }

    if (!empty($_POST["register_btn"])) {
        require_once('./Model/User.php');
        $member = new User();
        $registrationResponse = $member->registerMember('H');
    }
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("./Components/head.php") ?>
    <title>Sign Up - Hospital</title>
</head>

<body>
    <?php include("./Components/navbar.php") ?>
    <div class="form">
        <h1>Registration</h1>
        <form name="registration" action="" method="post" autocomplete="off">
            <input type="text" name="hos_name" placeholder="Hospital Name" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="submit" name="register_btn" value="Register" />
        </form>
    </div>
    <p>Already registered? <a href='login.php.'>Login Here</a></p>
</body>

</html>