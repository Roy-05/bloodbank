<?php

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
    <meta charset="utf-8">
    <title>Login</title>
    <!-- <link rel="stylesheet" href="css/style.css" /> -->
</head>

<body>

    <div class="form">
        <h1>Log In</h1>
        <form action="" method="post" name="login">
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <input name="login_btn" type="submit" value="Login" />

        </form>
        <p>Not registered yet? <a href='userTypeRegister.html'>Register Here</a></p>
    </div>
</body>

</html>