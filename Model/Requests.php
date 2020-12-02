<?php 

    class Requests {
        private $ds;

        function __construct()
        {
            require_once("./DataSource/db.php");
            $this->ds = new DataSource();
        }

        function getRequests($hos_id) {
            $query = 'SELECT first_name, last_name, rcvr_blood_type, req_date
                        FROM Receivers
                        INNER JOIN Requests
                        USING (rcvr_id)
                        WHERE hos_id = ?';
            
            $paramType = 'i';
            $paramValue = array(
                $hos_id
            );

            $result = $this->ds->select($query, $paramType, $paramValue);
            echo $result;
        }
    }