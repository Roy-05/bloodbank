<?php 
    require_once('./Model/Dashboard.php');
    $dashboard = new Dashboard();
    
    if(isset($_REQUEST['blood_type'])){
        $dashboard->addBloodSample();
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
</head>

<body>
    <form action="" method="post" name="add_blood_type">
        <input type="text" name="blood_type" placeholder="A+, O+, AB-, etc..." required />
        <input name="submit" type="submit" value="Submit" />
    </form>
    <div>
        <?php
         $html = "<table>";
         $avb_blood = $dashboard->viewAvailableBlood();
         foreach ($avb_blood as $row){
            $html .= "<tr><td>".$row['avb_blood_type']."</td>";
            $html .= "<td>".$row['added_on']."</td></tr>";
         }      
         $html .= "</table>";

         echo $html;
        ?>
    </div>
</body>

</html>