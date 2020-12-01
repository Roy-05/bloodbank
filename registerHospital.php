<?php
    if (!empty($_POST["register_btn"])) {
        require_once('./Model/User.php');
        $member = new User();
        $registrationResponse = $member->registerMember('H');
    }
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("./head.php") ?>
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
</body>

</html>