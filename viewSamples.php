<?php 
    require_once("./Model/AvailableSamples.php");
    $samples_obj = new AvailableSamples();

    $html = "<table>
                <tr>
                    <th>Hospital Name</th>
                    <th>Available Blood</th>
                    <th>Added On</th>
                </tr>";
         $avb_samples = $samples_obj->getSamples();
         foreach ($avb_samples as $row){
            $html .= "<tr><td>".$row['name']."</td>";
            $html .= "<td>".$row['avb_blood_type']."</td>";
            $html .= "<td>".$row['added_on']."</td></tr>";
         }      
         $html .= "</table>";

         echo $html;


?>