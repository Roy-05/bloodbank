<?php 

class Dashboard {

    private $ds;

    function __construct()
    {
        require_once('./db.php');
        $this->ds = new DataSource;
    }
    /**
     * Insert a new blood sample to the database 
     */
    public function addBloodSample() {
        session_start();
        $user_id = $_SESSION['user_id'];
        $query = "INSERT INTO AvailableBlood(avb_blood_type, added_on, hos_id) 
                    VALUES(?, CURDATE(),
                        (SELECT hos_id from Hospitals WHERE user_id=?))";
        
        $paramType = 'si';
        $paramValue = array(
            $_POST['blood_type'],
            $user_id
        );

        $this->ds->insert($query, $paramType, $paramValue);
    }
}



?>