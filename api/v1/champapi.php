<?php 
    // include DB Constants
    include_once "constants.php";

    // class definition
    class ChampApi{
        // member variables
        public $lastname;
        public $firstname;
        public $dob;
        public $password;
        public $email;
        public $conn; // DB connection handler

        // member functions
        public function __construct(){
            // open DB connection
            $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASENAME);

            if ($this->conn->connect_error) {
                $response = array(
                    "status"=> "failed",
                    "message"=> "Connection Failed ".$this->conn->connect_error,
                    "data"=>[]
                );

                return json_encode($response);
            }
        }

        # begin insert user method
        public function insertUser($lname, $fname, $dob, $email, $password, $phone){
            // prepare statement
            $statement = $this->conn->prepare("INSERT INTO users(lastname, firstname, dateofbirth, phonenumber, emailaddress, password) VALUES(?,?,?,?,?,?)");

            // bind parameter
            $pwd = password_hash($password, PASSWORD_DEFAULT);
            $statement->bind_param("ssssss", $lname, $fname, $dob, $phone, $email, $pwd);

            // execute query
            $statement->execute();

            if ($statement->affected_rows == 1) {
                $response = array(
                    "status"=> "success",
                    "message"=> "A user account was successfully created",
                    "data"=> $statement->insert_id
                );
            }else{
                $response = array(
                    "status"=> "failed",
                    "message"=> "Could not create member account",
                    "data"=> []
                );
            }

            return json_encode($response);
        }
        # end insert user method

        # begin get users method
        public function getUser(){
            // prepare statement
            $statement = $this->conn->prepare("SELECT * FROM users WHERE role_id=?");

            // bind param
            $roleid = 2;
            $statement->bind_param("i", $roleid);

            // execute statement
            $statement->execute();

            // fetch result
            $result = $statement->get_result();

            $data = array();

            // check if there is record
            if ($result->num_rows > 0) {
                # fetch all records

                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }

                $response = array(
                    "status"=> "success",
                    "message"=> "All Members Data",
                    "data"=> $data
                );


            }else{
                $response = array(
                    "status"=> "success",
                    "message"=> "No records found",
                    "data"=> []
                );
            
                
            }

            echo json_encode($response);

        }
        # end get users method

        # begin update user
        public function updateUser($lname, $fname, $dob, $email, $password, $phone, $userid){
            // prepare statement
            $statement = $this->conn->prepare("UPDATE users SET lastname=?, firstname=?, dateofbirth=?, phonenumber=?, emailaddress=?, password=? WHERE user_id=?");

            // bind parameter
            $pwd = password_hash($password, PASSWORD_DEFAULT);
            $statement->bind_param("ssssssi", $lname, $fname, $dob, $phone, $email, $pwd, $userid);

            // execute query
            $statement->execute();

            if ($statement->affected_rows == 1) {
                $response = array(
                    "status"=> "success",
                    "message"=> "A user record was successfully updated",
                    "data"=> []
                );
            }else{
                $response = array(
                    "status"=> "failed",
                    "message"=> "Could not updated member record".$statement->error,
                    "data"=> []
                );
            }

            return json_encode($response);
        }
        # end update user

        # begin delete user
        public function deleteUser($lname, $fname, $dob, $email, $password, $phone, $userid){
            // prepare statement
            $statement = $this->conn->prepare("UPDATE users SET lastname=?, firstname=?, dateofbirth=?, phonenumber=?, emailaddress=?, password=? WHERE user_id=?");

            // bind parameter
            $pwd = password_hash($password, PASSWORD_DEFAULT);
            $statement->bind_param("ssssssi", $lname, $fname, $dob, $phone, $email, $pwd, $userid);

            // execute query
            $statement->execute();

            if ($statement->affected_rows == 1) {
                $response = array(
                    "status"=> "success",
                    "message"=> "A user record was successfully deleted",
                    "data"=> []
                );
            }else{
                $response = array(
                    "status"=> "failed",
                    "message"=> "Could not updated member record".$statement->error,
                    "data"=> []
                );
            }

            return json_encode($response);
        }
        # end delete user
    }
?>