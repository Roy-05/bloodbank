<?php
session_start();
if (!$_SESSION['logged_in']) {
    header("Location: index.php");
    exit();
}

// Destroying All Sessions
if (session_destroy()) {
    header("Location: index.php");
}
