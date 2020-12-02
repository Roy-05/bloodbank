<?php

class Requests
{
    private $ds;

    function __construct()
    {
        require_once("./DataSource/db.php");
        $this->ds = new DataSource();
    }

    /**
     * @return bool
     */
    function isValidRequest($avb_id) 
    {   
        session_start();
        $isValid = false;

        // Verify that it is not a duplicate request
        $query = 'SELECT req_id FROM Requests
                    WHERE avb_id = ?';
        
        $paramType = 'i';
        $paramValue = array(
            $avb_id
        );  

        $result = $this->ds->select($query, $paramType, $paramValue);  
       
        if($result) {
            return $isValid;
        }

        // Verify that the user has the same blood type to request sample
        $query = 'SELECT rcvr_blood_type FROM Receivers
                    WHERE user_id = ?';
        $paramType = 'i';
        $paramValue = array(
            $_SESSION['user_id']
        );

        $result = $this->ds->select($query, $paramType, $paramValue);  
        $rcvr_blood_type = $result[0]['rcvr_blood_type'];

        $query = 'SELECT avb_blood_type FROM AvailableBlood
                    WHERE avb_id = ?';
        $paramType = 'i';
        $paramValue = array(
            $avb_id
        );  

        $result = $this->ds->select($query, $paramType, $paramValue);  
        $avb_blood_type = $result[0]['avb_blood_type'];

        if($rcvr_blood_type !== $avb_blood_type) {
            return $isValid;
        }

        $isValid = true;
        return $isValid;
    }   

    function requestBloodSample($avb_id) {
       if($this->isValidRequest($avb_id)){
        session_start();
        $query = 'SELECT rcvr_id FROM Receivers
                    WHERE user_id = ?';
        $paramType = 'i';
        $paramValue = array($_SESSION['user_id']);

        $result = $this->ds->select($query, $paramType, $paramValue);  
        $rcvr_id = $result[0]['rcvr_id'];

        $query = "INSERT INTO Requests(rcvr_id, avb_id, req_date)
                    VALUES (?, ?, CURDATE())";
        $paramType = 'ii';
        $paramValue = array(
            $rcvr_id,
            $avb_id
        );

        $result = $this->ds->insert($query, $paramType, $paramValue);
       }
    }
}
