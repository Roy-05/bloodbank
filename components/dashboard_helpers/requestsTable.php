<?php
    $dashboard = new Dashboard();
    $sample_requests = $dashboard->viewSampleRequests();

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
            if(!$sample_requests){
                $html .= "
                    <tr>
                        <td colspan='3'>No Requests to show right now.</td>
                    </tr>";
            }
            else{
                foreach ($sample_requests as $row) {
                    $html .= "
                    <tr>
                        <td>$row[first_name] $row[last_name]</td>
                        <td>$row[rcvr_blood_type]</td>
                        <td>".date('d-m-Y',strtotime($row['req_date']))."</td>
                    </tr>";
                }
            }
            
    $html .= "</tbody>
            </table>";

    echo $html;
