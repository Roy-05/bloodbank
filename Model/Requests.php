<?php

class Requests
{
    private $ds;
    private $rcvr_id;

    function __construct()
    {
        require_once("./DataSource/db.php");
        $this->ds = new DataSource();
        $this->setRcvrId();

        
    }

    /**
     * @return bool
     */
    function isValidRequest($hos_id, $req_blood_type) 
    {   
        session_start();
        $isValid = false;

        // Verify that it is not a duplicate request
        $query = 'SELECT req_id FROM Requests
                    WHERE hos_id = ? AND rcvr_id=?';
        
        $paramType = 'i';
        $paramValue = array(
            $hos_id,
            $this->rcvr_id
        );  

        $result = $this->ds->select($query, $paramType, $paramValue);  
       
        if($result) {
            return $isValid;
        }

        // Verify that the user has the same blood type to request sample
        $query = 'SELECT rcvr_blood_type FROM Receivers
                    WHERE rcvr_id = ?';
        $paramType = 'i';
        $paramValue = array(
           $this->rcvr_id
        );

        $result = $this->ds->select($query, $paramType, $paramValue);  
        $rcvr_blood_type = $result[0]['rcvr_blood_type'];

        if($rcvr_blood_type !== $req_blood_type) {
            return $isValid;
        }

        $isValid = true;
        return $isValid;
    }   

    function requestBloodSample($hos_id) {
        $query = "INSERT INTO Requests(rcvr_id, hos_id, req_date)
                    VALUES (?, ?, CURDATE())";
        $paramType = 'ii';
        $paramValue = array(
            $this->rcvr_id,
            $hos_id
        );

        $result = $this->ds->insert($query, $paramType, $paramValue);
       }
    

    function setRcvrId() {
        session_start();
        if($_SESSION['logged_in']){
            $query = 'SELECT rcvr_id FROM Receivers
                    WHERE user_id = ?';
            $paramType = 'i';
            $paramValue = array($_SESSION['user_id']);

            $result = $this->ds->select($query, $paramType, $paramValue);  
            $this->rcvr_id = $result[0]['rcvr_id'];
        }
    }
}
