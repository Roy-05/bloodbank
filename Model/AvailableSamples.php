<?php

    class AvailableSamples {
        private $ds;

        function __construct()
        {   
            require_once('./db.php');
            $this->ds = new DataSource;
        }

        function getSamples() {
            $query = "SELECT name, avb_blood_type, added_on FROM AvailableBlood
                        JOIN Hospitals
                        USING(hos_id)";

            return $this->ds->select($query);
        }
        
    }
?>
