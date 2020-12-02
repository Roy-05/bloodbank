<?php
session_start();
if(!$_SESSION['logged_in']){
    header("Location: index.php");
    exit();
}

// Destroying All Sessions
if(session_destroy())
{
    echo "You have been logged out";
    echo '<div>
            <a href=login.php>Click here</a> to Login.
          </div>';
}

