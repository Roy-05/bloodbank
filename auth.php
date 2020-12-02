<?php
session_start();

if(!$_SESSION['logged_in']){
    header("Location: index.php");
    exit(); 
}
elseif($_SESSION['logged_in'] && $_SESSION['user_type']=="R"){
    header("Location: viewSamples.php");
    exit(); 
}
?>