<?php
class User
{

    private $ds;

    function __construct()
    {
        require_once('./db.php');
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
                "status" => "error",
                "message" => "User already exists."
            );
        } else {
           
            if (! empty($_POST["password"])) {

                $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
            }
            $query = 'INSERT INTO Logins (email, password, user_type) VALUES (?, ?, ?)';
            $paramType = 'sss';
            $paramValue = array(
                $_POST["email"],
                $hashedPassword,
                $user_type
            );
            $insertId = $this->ds->insert($query, $paramType, $paramValue);
            

            if($user_type === 'H'){
              $query =  "INSERT into Hospitals(name, user_id)
                            VAlUES (?, (SELECT user_id from `Logins` WHERE email=?))";
              $paramType = 'ss';
              $paramValue = array(
                $_POST["hos_name"],
                $_POST["email"]
            );

            $insertId1 = $this->ds->insert($query, $paramType, $paramValue);
            }
            else {
                $query =  "INSERT into Receivers(first_name, last_name, rcvr_blood_type, user_id)
                            VALUES (?, ?, ?, (SELECT user_id from `Logins` WHERE email=?))";
              $paramType = 'ssss';
              $paramValue = array(
                $_POST["first_name"],
                $_POST["last_name"],
                $_POST["blood_type"],
                $_POST["email"],
            );

            $insertId1 = $this->ds->insert($query, $paramType, $paramValue);
            }
            
            if (!empty($insertId) && !empty($insertId1)) {
                // $response = array(
                //     "status" => "success",
                //     "message" => "You have registered successfully."
                // );

                header("Location: login.php");
                        
            }
        }
        //return $response;
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
        if (! empty($memberRecord)) {
            if (! empty($_POST["password"])) {
                $password = $_POST["password"];
                echo $password;
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
            session_write_close();
            $url = ($memberRecord[0]["user_type"] == "H") ?  "./hospitalDashboard.php" : "./welcome.php";
            header("Location: $url");
        } else if ($loginPassword == 0) {
            $loginStatus = "Invalid username or password.";
            return $loginStatus;
        }
    }
}
