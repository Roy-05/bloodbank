<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Select User Type</title>
<!-- <link rel="stylesheet" href="css/style.css" /> -->
</head>
<body>
    <div>
        <h1>Are you a:</h1>
        <form action="" method="POST" autocomplete="off"> 
            <input type="radio" name="hospital">Hospital</input>
            <input type="radio" name="receiver">Receiver</input>
            <input name="submit" type="submit" value="Submit" />
        </form>
    </div>
</body>
</html>
<?php
    if(isset($_POST['hospital'])){
        header("Location: registerHospital.php");
    }
    else if(isset($_POST['receiver'])){
        header("Location: registerReceiver.php");
    }

    ?>