<?php

    class BloodSamples {
        private $ds;

        function __construct()
        {   
            require_once('./DataSource/db.php');
            $this->ds = new DataSource;
        }

        function getAvailableSamples() {
            $query = "SELECT name, avb_blood_type, added_on, avb_id FROM AvailableBlood
                        JOIN Hospitals
                        USING(hos_id)";

            return $this->ds->select($query);
        }

        function requestBloodSample() {
            session_start();
            $user_id =  $_SESSION['user_id'];

            if(!$user_id){
                header("Location: index.php");
                exit();
            }

            $query = "SELECT rcvr_id FROM Receivers WHERE user_id = ?";
            $paramType = 'i';
            $paramValue = array(
                $_SESSION['user_id']
            );

            $result = $this->ds->select($query, $paramType, $paramValue);
           
                $rcvr_id = $result[0]["rcvr_id"];
                var_dump($_SESSION['user_id']);
            
        }
        
    }
