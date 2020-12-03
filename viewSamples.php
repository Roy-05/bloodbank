<?php 
   
    require_once("./Model/BloodSamples.php");
    require_once("./Model/Requests.php");
    $blood_samples = new BloodSamples();
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
            echo "<div>Login to request blood samples</div>";
        } else {
            include("./components/welcomeBanner.php");
        }
        ?>
        <div class="container w-75 d-flex justify-content-center">
            <?php 
                $html = "
                    <table class='table'>
                        <tr>
                            <th>Hospital Name</th>
                            <th>Available Blood</th>
                            <th>Added On</th>
                        </tr>";

                $avb_samples = $blood_samples->getAvailableSamples();
                foreach ($avb_samples as $row) {
                    $html .= "
                        <tr>
                            <td rowspan=2>$row[name]</td>
                            <td  rowspan=2>$row[avb_blood_type]</td>
                            <td >".date('d-m-Y',strtotime($row['added_on']))."</td>
                        </tr>
                        <tr>
                            <td class=req_btn_cell>
                                <button id=requestSamplebtn type=button class='btn btn-rounded' data-toggle=modal data-target=#addBloodModal>
                                Request
                                </button>
                            </td>
                        </tr>";
                }
                
            //     <td class=req_btn_cell>
            //     <a 
            //         href=viewSamples.php?hos_id=$row[hos_id]&req_blood_type=".urlencode($row['avb_blood_type']).">
            //         <button class=req_sample_btn>Request</button>
            //     </a>
            // </td>
            //     //     if ($_SESSION['logged_in'] && $_SESSION['user_type'] === "R") {
                //         $html .= "
                //             <td>
                //                 <a href=viewSamples.php?hos_id=$row[hos_id]&req_blood_type=".urlencode($row['avb_blood_type']).">
                //                     <button class=req_sample_btn>Request</button>
                //                 </a>
                //             </td>
                //         </tr>";
                //     } else {
                //         $html .= "</tr>";
                //     }
                // }
                $html .= "</table>";

                echo $html;

                if($_SESSION['user_type'] === "R" && $_GET["hos_id"] && $_GET["req_blood_type"]) {
                    $isValid = $requests->isValidRequest($_GET["hos_id"], $_GET['req_blood_type']);
                    if($isValid){
                        $requests->requestBloodSample($_GET["hos_id"]);

                    }   
                }
            ?>
        </div>
    </body>
</html>
