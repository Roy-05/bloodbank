<?php
if (! empty($_POST["register_btn"])) {
    require_once('./Model/User.php');
    $member = new User();
    $registrationResponse = $member->registerMember('R');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Up - Receiver</title>
</head>
<body>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post" autocomplete="off">
<input type="text" name="first_name" placeholder="First Name" required />
<input type="text" name="last_name" placeholder="Last Name" required />
<input type="text" name="blood_type" placeholder="A+, O+, AB-, etc..." required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="register_btn" value="Register" />
</form>
</div>
</body>
</html>