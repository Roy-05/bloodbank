<?php 
    $requests = new Requests();
    $avb_samples = $requests->getAvailableSamples();

    $html = "
            <table class='table'>
                <tr>
                    <th>Hospital Name</th>
                    <th>Available Blood</th>
                    <th>Added On</th>
                </tr>";
        foreach ($avb_samples as $row) {
            $html .= "
                <tr>
                    <td rowspan=2>$row[name]</td>
                    <td  rowspan=2>$row[avb_blood_type]</td>
                    <td >".date('d-m-Y',strtotime($row['added_on']))."</td>
                </tr>
                <tr>
                    <td class=req_btn_cell>
                        <a 
                        id=requestSamplebtn 
                        type=button 
                        class='btn btn-rounded'
                        href= ./viewSamples.php?requestSample=true&hos_id=$row[hos_id]&req_blood_type=".urlencode($row['avb_blood_type'])."
                        >
                        Request
                        </a>
                    </td>
                </tr>";
        }
    $html .= "</table>";

    echo $html;
