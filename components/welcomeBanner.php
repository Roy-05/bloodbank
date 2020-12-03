<!-- This component is a simple banner to display the currently logged in user. -->
<div>
    <h2 class="my-4 mx-3">
        Welcome, 
        <?php
        require_once("./Model/User.php");
        $user = new User();
        $user_name = $user->getUserName();
        
        echo $user_name;
        ?>
    </h2>
</div>