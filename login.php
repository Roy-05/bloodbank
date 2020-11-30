<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<!-- <link rel="stylesheet" href="css/style.css" /> -->
</head>
<body>
<?php
require('db.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['email'])){
        // removes backslashes
 $email = stripslashes($_REQUEST['email']);
        //escapes special characters in a string
 $email = mysqli_real_escape_string($con,$email);
 $password = stripslashes($_REQUEST['password']);
 $password = mysqli_real_escape_string($con,$password);
 //Checking is user existing in the database or not
        $query = "SELECT user_type, user_id FROM `Logins` WHERE email='$email'
and password='".md5($password)."'";
 $result = mysqli_query($con,$query) or die(mysqli_error($con));
 $rows = mysqli_num_rows($result);
        if($rows==1){
     $_SESSION["email"] = $email;
              
              $row_data = mysqli_fetch_assoc($result);
              $_SESSION['user_id'] = $row_data["user_id"];
              if($row_data["user_type"] == "H" ){
                     header("Location: hospitalDashboard.php");
              }
              else {
                     header("Location: welcome.php");   
              }
         }else{
 echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
 }
    }else{
?>
<div class="form">
<h1>Log In</h1>
<form action="" method="post" name="login">
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<input name="submit" type="submit" value="Login" />

</form>
<p>Not registered yet? <a href='userTypeRegister.php'>Register Here</a></p>
</div>
<?php } ?>
</body>
</html>