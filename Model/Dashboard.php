<?php 

class Dashboard {

    private $ds;
    private $hos_id;
    function __construct()
    {
        require_once('./DataSource/db.php');
        $this->ds = new DataSource;
        $this->setHospitalId();
    }

    public function setHospitalId() {
        session_start();
        $user_id = $_SESSION['user_id'];
        $query = "SELECT hos_id FROM Hospitals WHERE user_id = ?";
        $paramType = 'i';
        $paramValue = array($user_id);

        $result = $this->ds->select($query, $paramType, $paramValue);
        $this->hos_id = $result[0]['hos_id'];
    }

    /**
     * Insert a new blood sample to the database 
     */
    public function addBloodSample() {
       
        $query = "INSERT INTO AvailableBlood(hos_id, avb_blood_type, added_on) 
                    VALUES(?, ?, CURDATE())";
        
        $paramType = 'is';
        $paramValue = array(
            $this->hos_id,
            $_POST['blood_type']
        );

        $this->ds->insert($query, $paramType, $paramValue);
    }

    public function viewAvailableBlood(){
        $query = "SELECT avb_blood_type, added_on FROM AvailableBlood
                    WHERE hos_id = ?";

        $paramType = 'i';
        $paramValue = array($this->hos_id);

        return $this->ds->select($query, $paramType, $paramValue);
    }
}



?>