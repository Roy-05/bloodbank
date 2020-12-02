<?php 

    include("./Components/head.php");
    include("./Components/navbar.php");
    require_once("./Model/BloodSamples.php");
    $blood_samples = new BloodSamples();
    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        echo "<div>Login to request blood samples</div>";
    }

    $html = "<table>
                <tr>
                    <th>Hospital Name</th>
                    <th>Available Blood</th>
                    <th>Added On</th>
                </tr>";
         $avb_samples = $blood_samples->getAvailableSamples();
         foreach ($avb_samples as $row){
            $html .= "<tr>
                        <td>$row[name]</td>
                        <td>$row[avb_blood_type]</td>
                        <td>$row[added_on]</td>";
            
            if($user_id){
                $html .= "
                        <td>
                            <button class=req_sample_btn id=$row[avb_id]>Request</button>
                        </td>
                      </tr>";
            }
            else {
                $html .= "</tr>";
            }                 
         }      
         $html .= "</table>";

         echo $html;
         //echo $blood_samples->requestBloodSample();
?>