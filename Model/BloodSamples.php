<?php

    class BloodSamples {
        private $ds;

        function __construct()
        {   
            require_once('./DataSource/db.php');
            $this->ds = new DataSource;
        }

        function getAvailableSamples() {
            $query = "SELECT name, avb_blood_type, added_on, hos_id FROM AvailableBlood
                        JOIN Hospitals
                        USING(hos_id)";

            return $this->ds->select($query);
        }

        function getSampleRequests($hos_id)
        {
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
