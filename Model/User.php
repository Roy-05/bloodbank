<?php
class User
{

    private $ds;

    function __construct()
    {
        require_once('./DataSource/db.php');
        $this->ds = new DataSource();
    }

    /**
     * to check if the user already exists
     *
     * @param string $email
     * @return boolean
     */
    public function isUserExists($email)
    {
        $query = 'SELECT user_id FROM Logins where email = ?';
        $paramType = 's';
        $paramValue = array(
            $email
        );
        $resultArray = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function isValidBloodType($blood_type){
        $response = array(
            "status" => "danger",
            "message" => "Please enter a valid blood type"
        );


        $blood_type = strtoupper($blood_type);
        $valid_blood_types = array(
            "A+", "A-", "B+", "B-", "O+", "O-", "AB+", "AB-"
        );

        // Check if the blood type is a valid string
        if(!in_array($blood_type, $valid_blood_types)){
            
            return $response;
        }
        else {
            $response["status"] = "success";
            $response["message"] = "";

            return $response;
        }
    }

    /**
     * to signup / register a user
     *
     * @return string[] registration status message
     */
    public function registerMember($user_type)
    {
        $isUserExists = $this->isUserExists($_POST["email"]);
        if ($isUserExists) {
            $response = array(
                "status" => "danger",
                "message" => "User already exists."
            );

            return $response;
        } else {

            if (!empty($_POST["password"])) {

                $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
            }
            $query = 'INSERT INTO Logins (email, password, user_type) VALUES (?, ?, ?)';
            $paramType = 'sss';
            $paramValue = array(
                strtolower($_POST["email"]),
                $hashedPassword,
                $user_type
            );
            $isSuccessful = $this->ds->insert($query, $paramType, $paramValue);


            if ($user_type === 'H') {
                $query =  "INSERT into Hospitals(name, user_id)
                            VAlUES (?, (SELECT user_id from `Logins` WHERE email=?))";
                $paramType = 'ss';
                $paramValue = array(
                    ucwords(strtolower($_POST["hos_name"])),
                    strtolower($_POST["email"])
                );

                $isSuccessful_1 = $this->ds->insert($query, $paramType, $paramValue);
            } else {
                
                // Validate if user input is of a correct blood type
                $response = $this->isValidBloodType($_POST["blood_type"]);
                if($response["status"] === "danger"){
                    return $response;
                }

                $query =  "INSERT into Receivers(first_name, last_name, rcvr_blood_type, user_id)
                            VALUES (?, ?, ?, (SELECT user_id from `Logins` WHERE email=?))";
                $paramType = 'ssss';
                $paramValue = array(
                    ucwords(strtolower($_POST["first_name"])),
                    ucwords(strtolower($_POST["last_name"])),
                    $_POST["blood_type"],
                    strtolower($_POST["email"])
                );

                $isSuccessful_1 = $this->ds->insert($query, $paramType, $paramValue);
            }

            if ($isSuccessful && $isSuccessful_1) {
                $response = array(
                    "status" => "success",
                    "message" => "You have registered successfully."
                );

                
            }
        }
        return $response;
    }

    public function getMember($email)
    {
        $query = 'SELECT * FROM Logins where email = ?';
        $paramType = 's';
        $paramValue = array(
            $email
        );
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }

    /**
     * to login a user
     *
     * @return string
     */
    public function loginMember()
    {
        $memberRecord = $this->getMember($_POST["email"]);
        $loginPassword = 0;
        if (!empty($memberRecord)) {
            if (!empty($_POST["password"])) {
                $password = $_POST["password"];
            }
            $hashedPassword = $memberRecord[0]["password"];
            $loginPassword = 0;
            if (password_verify($password, $hashedPassword)) {
                $loginPassword = 1;
            }
        } else {
            $loginPassword = 0;
        }
        if ($loginPassword == 1) {
            // login sucess so store the member's username in
            // the session
            session_start();
            $_SESSION["user_id"] = $memberRecord[0]["user_id"];
            $_SESSION['logged_in'] = true;
            $_SESSION['user_type'] = $memberRecord[0]["user_type"];
            session_write_close();
            $url = ($memberRecord[0]["user_type"] == "H") ?  "./dashboard.php" : "./viewSamples.php";
            header("Location: $url");
            exit();
        } else if ($loginPassword == 0) {
            $response = array(
                "status" => "danger",
                "message" => "Invalid Username or password"
            );            

            return $response;
        }
    }

    /**
     * Get the name of the currently logged in  user
     */
    public function getUserName()
    {
        session_start();
        if ($_SESSION['logged_in']) {
            $user_type = $_SESSION["user_type"];
            if ($user_type === "R") {
                $query = "SELECT first_name, last_name FROM Receivers
                            WHERE user_id = ?";
                $paramType = "i";
                $paramValue = array(
                    $_SESSION["user_id"]
                );

                $result = $this->ds->select($query, $paramType, $paramValue);
                $name = $result[0]['first_name'] . ' ' . $result[0]['last_name'];

                return $name;
            } else {
                $query = "SELECT name FROM Hospitals WHERE user_id = ?";
                $paramType = "i";
                $paramValue = array(
                    $_SESSION["user_id"]
                );

                $result = $this->ds->select($query, $paramType, $paramValue);
                $name = $result[0]['name'];
                
                return $name;
            }
        }
    }


    /**
     * Get the name of the currently logged in  user
     */
    public function getUserBloodType()
    {
        session_start();
        if ($_SESSION['logged_in']) {
            $query = "SELECT rcvr_blood_type FROM Receivers
                        WHERE user_id = ?";
            $paramType = "i";
            $paramValue = array(
                $_SESSION["user_id"]
            );

            $result = $this->ds->select($query, $paramType, $paramValue);
            $blood_type = $result[0]['rcvr_blood_type'];

            return $blood_type;
        }
    }
}
