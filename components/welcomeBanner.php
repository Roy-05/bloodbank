<!-- This component is a simple banner to display the currently logged in user. -->
<div id="user-banner" class="my-4 w-100 text-center">
    <h2>
        Welcome,
        <?php
        require_once("./Model/User.php");
        $user = new User();
        $user_name = $user->getUserName();
        session_start();
        if ($_SESSION['user_type'] === "R") {
            $blood_type = $user->getUserBloodType();
            echo $user_name . " [Blood Type: $blood_type]";
        } else {
            echo $user_name;
        }
        ?>
    </h2>
</div>