<?php
session_start();

// Deny access to path for users who are not logged in, 
// or are not the right user type.
if (!$_SESSION['logged_in'] || $_SESSION['user_type'] !== "H") {
    header("Location: index.php");
    exit();
};

require_once('./Model/Dashboard.php');
$dashboard = new Dashboard();

if (isset($_POST['blood_type'])) {
    $response = $dashboard->isValidSample($_POST['blood_type']);
   
    if($response["status"] === "success"){
        $dashboard->addBloodSample();
    }
    else {
        //echo $response["message"];
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include("./components/head.php"); ?>
        <link rel="stylesheet" href="./css/dashboard.css">
        <title>Dashboard </title>
    </head>
    <body>
        <div id="loader" class="center"></div>  
        <?php include("./components/navbar.php"); ?>
        <?php include("./components/welcomeBanner.php"); ?>
        <div class="container w-75">
            <nav>
                <div class="nav nav-tabs row">
                    <a class="nav-item nav-link active col-6 text-center py-3" data-toggle="tab" href="#menu1">
                        View Requests
                    </a>
                    <a class="nav-item nav-link col-6 text-center py-3" data-toggle="tab" href="#menu2">
                        View Available Samples
                    </a>
                </div>
            </nav>
            <div class="tab-content d-flex justify-content-center my-4">
                <div id="menu1" class="tab-pane fade show active">
                    <?php include_once("./viewRequestsTable.php") ?>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <!-- Trigger modal on button click-->
                    <div class="row justify-content-center">
                        <button id="addNewBlood" type="button" class="btn btn-rounded mb-4" data-toggle="modal" data-target="#addBloodModal">
                        Add New Sample
                        </button>
                    </div>
                    <?php include_once("./addBloodModal.php") ?>
                    <?php include_once("./viewAvbBloodTable.php") ?>
                </div>
            </div>
        </div>
    </body>
</html>
