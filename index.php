<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./components/head.php") ?>
    <link rel="stylesheet" href="./css/index.css">
    <title>Saket's Bloodbank</title>
</head>

<body>
    <div id="loader" class="center"></div>
    <?php include("./components/navbar.php") ?>
    <div class="mt-3 h-75 d-flex justify-content-center align-items-center text-center">
        <div class="jumbotron  w-50">
            <h1 class="display-4 ">
                Welcome to Saket's Bloodbank
            </h1>
            <div class="row justify-content-center">
                <a class="btn btn-rounded mt-3" href="viewSamples.php">View Available Samples
                </a>
            </div>
            <?php session_start();
            if (!$_SESSION["logged_in"]) {
                echo '
                        <div class="row justify-content-center">
                            <a
                            class="btn btn-rounded mt-3"
                            href="login.php"
                            >Login
                            </a>
                        </div>';
            }
            ?>
        </div>
    </div>
</body>

</html>