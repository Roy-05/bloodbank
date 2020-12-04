<?php 
    require_once("./Model/Requests.php");
    $requests = new Requests();
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>   
        <?php include("./components/head.php"); ?>
        <link rel="stylesheet" href="./css/viewSamples.css">
        <script src="./loader.js"></script>
        <title>View Samples</title>
    </head>
    <body>
        <div id="loader" class="center"></div> 
        <?php
        include("./components/navbar.php");
        if (!$_SESSION['logged_in']) {
            echo "
            <div class='my-4 w-100 text-center'>
                <h5>
                    <div>Login to request blood samples</div>
                </h5>
            </div>";
        } else {
            include("./components/welcomeBanner.php");
        }
        ?>
        <div class="container w-75 d-flex justify-content-center">
            <?php 
                ob_start();
                include_once("./avbSamplesTable.php");
                if ($_GET['requestSample']){
                    if(!$_SESSION['logged_in']){
                        header("Location: login.php");
                        exit();
                    };

     
                    if($_SESSION['user_type'] === 'H'){
                        $response = "Please login as a Receiver to request blood.";
                        $responseType = "danger";

                    }
                    else if($_SESSION['user_type'] === "R" && $_GET["hos_id"] && $_GET["req_blood_type"]){
                        $isValid = $requests->isValidRequest($_GET["hos_id"], $_GET['req_blood_type']);
                        $response = $isValid["message"];

                        if($isValid["status"] === "success"){
                            $requests->requestBloodSample($_GET["hos_id"]);
                            $responseType = "success";
                        }     
                        else {
                            $responseType = "danger";
                        }
                    }
                   echo "
                    <script>
                       display_alert('user-banner', '$response', '$responseType');
                    </script>";
                } 
            ?>
        </div>
    </body>
</html>
