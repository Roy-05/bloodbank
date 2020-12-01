<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
</head>

<body>
    <?php 
        if(isset($_REQUEST['blood_type'])){
            require_once('./Model/Dashboard.php');
            $dashboard = new Dashboard();
            $dashboard->addBloodSample();
        }
    ?>
    <form action="" method="post" name="add_blood_type">
        <input type="text" name="blood_type" placeholder="A+, O+, AB-, etc..." required />
        <input name="submit" type="submit" value="Submit" />
    </form>
</body>

</html>