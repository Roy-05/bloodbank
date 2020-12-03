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
    }
