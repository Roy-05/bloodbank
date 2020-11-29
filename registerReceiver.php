<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Up - Receiver</title>
<!-- <link rel="stylesheet" href="css/style.css" /> -->
</head>
<body>
<?php
require('db.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['email'])){
        // removes backslashes
 $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
 $username = mysqli_real_escape_string($con,$username); 
 $email = stripslashes($_REQUEST['email']);
 $email = mysqli_real_escape_string($con,$email);
 $password = stripslashes($_REQUEST['password']);
 $password = mysqli_real_escape_string($con,$password);
 $first_name = $_REQUEST['first_name'];
 $last_name = $_REQUEST['last_name'];
 $blood_type = $_REQUEST['blood_type'];
 
 $query = "INSERT into `Logins` (email, password, user_type)
            VALUES ('$email', '".md5($password)."', 'R')";
 
 $query_2 = "INSERT into `Receivers` (first_name, last_name, rcvr_blood_type, user_id)
              VAlUES ('$first_name', '$last_name', '$blood_type', 
              (SELECT user_id from `Logins` WHERE email='$email'
                and password='".md5($password)."'))";

 $result = mysqli_query($con,$query);
 $result1 = mysqli_query($con,$query_2);
        if($result && $result1){
            echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post" autocomplete="off">
<input type="text" name="first_name" placeholder="First Name" required />
<input type="text" name="last_name" placeholder="Last Name" required />
<input type="text" name="blood_type" placeholder="A+, O+, AB-, etc..." required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
</div>
<?php } ?>
</body>
</html>