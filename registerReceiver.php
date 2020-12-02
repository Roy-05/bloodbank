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
       $registrationResponse = $member->registerMember('R');
}
?>
<!DOCTYPE html>
<html>

<head>
       <?php include("./Components/head.php") ?>
       <title>Sign Up - Receiver</title>
</head>

<body>
       <?php include("./Components/navbar.php") ?>
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
       <p>Already registered? <a href='login.php'>Login Here</a></p>
</body>

</html>