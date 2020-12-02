<?php

include("./Components/head.php");
include("./Components/navbar.php");
require_once("./Model/BloodSamples.php");
require_once("./Model/Requests.php");
$blood_samples = new BloodSamples();
$requests = new Requests();

session_start();
if (!$_SESSION['logged_in']) {
    echo "<div>Login to request blood samples</div>";
} else {
    include("./Components/welcomeBanner.php");
}

$html = "<table>
                <tr>
                    <th>Hospital Name</th>
                    <th>Available Blood</th>
                    <th>Added On</th>
                </tr>";
$avb_samples = $blood_samples->getAvailableSamples();
foreach ($avb_samples as $row) {
    $html .= "<tr>
                        <td>$row[name]</td>
                        <td>$row[avb_blood_type]</td>
                        <td>$row[added_on]</td>";

    if ($_SESSION['logged_in'] && $_SESSION['user_type'] === "R") {
        $html .= "
                        <td>
                            <a href=viewSamples.php?avb_id=$row[avb_id]>
                                <button class=req_sample_btn>Request</button>
                            </a>
                        </td>
                      </tr>";
    } else {
        $html .= "</tr>";
    }
}
$html .= "</table>";

echo $html;

    if($_SESSION['user_type'] === "R" && $_GET["avb_id"]) {
        $requests->requestBloodSample($_GET["avb_id"]);
    }
?>