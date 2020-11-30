<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Up - Hospital</title>
</head>
<body>
<?php
require('db.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['email'])){
        // removes backslashes
 $email = stripslashes($_REQUEST['email']);
 $email = mysqli_real_escape_string($con,$email);
 $password = stripslashes($_REQUEST['password']);
 $password = mysqli_real_escape_string($con,$password);
 $hos_name = $_REQUEST['hos_name'];
 
 $query = "INSERT into `Logins` (email, password, user_type)
            VALUES ('$email', '".md5($password)."', 'H')";
 
 $query_2 = "INSERT into `Hospitals` (name, user_id)
              VAlUES ('$hos_name',
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
<input type="text" name="hos_name" placeholder="Hospital Name" required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
</div>
<?php } ?>
</body>
</html>