<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
</head>

<body>
    <?php
    require('db.php');
    session_start();
    if (isset($_REQUEST['blood_type'])) {
        $blood_type = $_REQUEST['blood_type'];
        $user_id = $_SESSION['user_id'];
        $query = "INSERT INTO `AvailableBlood`(hos_id, avb_blood_type, added_on) 
                    VALUES (
                        (SELECT hos_id from `Hospitals` WHERE user_id='$user_id'),
                        '$blood_type', 
                        CURDATE()
                    )";

        $result = mysqli_query($con, $query);
        if ($result) {
            echo "Done";
        } else {
            echo mysqli_error($con);
        }
    } else {
    ?>
        <form action="" method="post" name="add_blood_type">
            <input type="text" name="blood_type" placeholder="A+, O+, AB-, etc..." required />
            <input name="submit" type="submit" value="Submit" />
        </form>
    <?php } ?>
</body>

</html>