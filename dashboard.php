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
        <title>Dashboard</title>
    </head>
    <body>
        <?php include("./components/navbar.php"); ?>
        <?php include("./components/welcomeBanner.php"); ?>
        <div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#menu1">View Requests</a></li>
                <li><a data-toggle="tab" href="#menu2">View Available Samples</a></li>
            </ul>
            <div class="tab-content">
                <div id="menu1" class="tab-pane fade in active show">
                <h3>View Requests</h3>
                <div class="container  w-50">
                    <?php
                        $html = "
                            <table class='table table-hover'>
                                <thead>
                                    <tr>
                                        <th>Requested By:</th>
                                        <th>Requested Type:</th>
                                        <th>Request Date:</th>
                                    </tr>
                                </thead>
                                <tbody>";

                        $sample_requests = $dashboard->viewSampleRequests();
                        foreach ($sample_requests as $row) {
                            $html .= "
                                <tr>
                                    <td>$row[first_name] $row[last_name]</td>
                                    <td>$row[rcvr_blood_type]</td>
                                    <td>".date('d-m-Y',strtotime($row['req_date']))."</td>
                                </tr></thead>";
                        }

                        $html .= "</tbody></table>";

                        echo $html;
                    ?>
                </div>
            </div>
            <div id="menu2" class="tab-pane fade">
                <h3>View Available Samples</h3>
                <div class="container w-50">
                    <!-- Trigger modal on button click-->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBloodModal">
                    Add New Sample
                    </button>
                    <?php include_once("./addBloodModal.php") ?>
                    <?php
                        $html = "
                            <table class='table table-hover'>
                                <tr>
                                    <th>Available Blood:</th>
                                    <th>Added On:</th>
                                </tr>"; 
                        $avb_blood = $dashboard->viewAvailableBlood();
                        foreach ($avb_blood as $row) {
                            $html .= "
                                <tr>
                                    <td>$row[avb_blood_type]</td>
                                    <td>".date('d-m-Y',strtotime($row['added_on']))."</td>
                                </tr>";
                        }

                        $html .= "</table>";

                        echo $html;
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
