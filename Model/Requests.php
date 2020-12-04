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

    function getAvailableSamples() {
        $query = "SELECT name, avb_blood_type, added_on, hos_id FROM AvailableBlood
                    JOIN Hospitals
                    USING(hos_id)
                    ORDER BY added_on DESC";

        return $this->ds->select($query);
    }

    /**
     * Check if the request is a valid one
     * @return bool
     */
    function isValidRequest($hos_id, $req_blood_type) 
    {   
        session_start();
        $response = array(
            "status" => "error",
            "message" => "You have already requested this sample."
        );

        // Verify that it is not a duplicate request
        $query = 'SELECT req_id FROM Requests
                    WHERE hos_id = ? AND rcvr_id=?';
        
        $paramType = 'ii';
        $paramValue = array(
            $hos_id,
            $this->rcvr_id
        );  

        $result = $this->ds->select($query, $paramType, $paramValue);  
       
        if($result) {
            return $response;
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
            $response['message'] = "You do not have the matching blood type.";
            return $response;
        }

        $response["status"] = "success";
        $response["message"] = "Success! Your request has been sent to the hospital.";
        return $response;
    }   

    
    function requestBloodSample($hos_id) {
        $query = "INSERT INTO Requests(rcvr_id, hos_id, req_date)
                    VALUES (?, ?, CURDATE())";
        $paramType = 'ii';
        $paramValue = array(
            $this->rcvr_id,
            $hos_id
        );

        $this->ds->insert($query, $paramType, $paramValue);
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
