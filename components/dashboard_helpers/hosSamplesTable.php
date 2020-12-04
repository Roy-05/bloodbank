<?php

    $dashboard = new Dashboard();
    $sample_requests = $dashboard->viewSampleRequests();
    $avb_blood = $dashboard->viewAvailableBlood();

    $html = "
        <table class='table table-hover'>
            <thead>
                <tr>
                    <th>Available Blood:</th>
                    <th>Added On:</th>
                </tr>
            </thead>
            <tbody>"; 
        if(!$avb_blood){
            $html .= "
                <tr>
                    <td colspan='3'>No samples to show right now.</td>
                </tr>";
        }
        else{
            foreach ($avb_blood as $row) {
            $html .= "
                <tr>
                    <td>$row[avb_blood_type]</td>
                    <td>".date('d-m-Y',strtotime($row['added_on']))."</td>
                </tr>";
            }
        }

    $html .= "</tbody>
        </table>";

    echo $html;
