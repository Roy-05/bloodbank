<?php 
    session_start();

    // Deny access to path for users who are not logged in, 
    // or are not the right user type.
    if(!$_SESSION['logged_in'] || $_SESSION['user_type'] !== "H"){
        header("Location: index.php");
        exit();
    };

    require_once('./Model/Dashboard.php');
    $dashboard = new Dashboard();
    
    if(isset($_REQUEST['blood_type'])){
        $dashboard->addBloodSample();
    }
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("./Components/head.php"); ?>
    <title>Dashboard</title>
</head>

<body>
    <?php include("./Components/navbar.php"); ?>
    <form action="" method="post" name="add_blood_type">
        <input type="text" name="blood_type" placeholder="A+, O+, AB-, etc..." required />
        <input name="submit" type="submit" value="Submit" />
    </form>
    <div>
        <?php
         $html = "<table>
                    <tr>
                        <th>Available Blood:</th>
                        <th>Added On:</th>
                    </tr>";
         $avb_blood = $dashboard->viewAvailableBlood();
         foreach ($avb_blood as $row){
            $html .= "<tr>
                        <td>$row[avb_blood_type]</td>
                        <td>$row[added_on]</td>
                      </tr>";
         }      
         $html .= "</table>";

         echo $html;

         $html = "<table>
                    <tr>
                        <th>Requested By:</th>
                        <th>Requested Type:</th>
                        <th>Request Date:</th>
                    </tr>";
         $sample_requests = $dashboard->viewSampleRequests();
         foreach ($sample_requests as $row){
            $html .= "<tr>
                        <td>$row[first_name] $row[last_name]</td>
                        <td>$row[rcvr_blood_type]</td>
                        <td>$row[req_date]</td>
                      </tr>";
         }      
         $html .= "</table>";

         echo $html;
        ?>
    </div>
</body>

</html>