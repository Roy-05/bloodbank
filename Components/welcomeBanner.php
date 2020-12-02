<!-- This component is a simple banner to display the currently logged in user. -->
<div>
    <span>
        Welcome, 
        <?php
        require_once("./Model/User.php");
        $user = new User();
        $user_name = $user->getUserName();
        
        echo $user_name;
        ?>
    </span>
</div>