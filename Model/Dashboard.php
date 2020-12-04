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

    public function isValidSample($blood_type){
        $blood_type = strtoupper($blood_type);
        $valid_blood_types = array(
            "A+", "A-", "B+", "B-", "O+", "O-", "AB+", "AB-"
        );

        // Check if the blood type is a valid string
        if(!in_array($blood_type, $valid_blood_types)){
            $response = array(
                "status" => "danger",
                "message" => "Please enter a valid blood type"
            );

            return $response;
        };

        // Check if the blood type already exists in the database
        $query = "SELECT avb_id FROM AvailableBlood
                    WHERE avb_blood_type = ?
                    AND hos_id = ?";
        
        $paramType = "si";
        $paramValue = array(
            $blood_type,
            $this->hos_id
        );

        $result = $this->ds->select($query, $paramType, $paramValue);
        if($result) {
            $response = array(
                "status" => "danger",
                "message" => "Blood Type is already in the database."
            );

            return $response;
        }

        $response = array(
            "status" => "success",
            "message" => "Success! Blood Type has been added to the database."
        );

        return $response;
    }   

    /**
     * Insert a new blood sample to the database 
     */
    public function addBloodSample() {

        //Store blood type in upper case
        $blood_type = strtoupper($_POST['blood_type']);

        $query = "INSERT INTO AvailableBlood(hos_id, avb_blood_type, added_on) 
                    VALUES(?, ?, CURDATE())";
        

        $paramType = 'is';
        $paramValue = array(
            $this->hos_id,
            $blood_type
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

    function viewSampleRequests() {
        $query = 'SELECT first_name, last_name, rcvr_blood_type, req_date
                    FROM Receivers
                    INNER JOIN Requests
                    USING (rcvr_id)
                    WHERE hos_id = ?';
        
        $paramType = 'i';
        $paramValue = array(
            $this->hos_id
        );

        return $this->ds->select($query, $paramType, $paramValue);
    }
}
