<?php 
    // include constants file
    include_once("constants.php");

    // class definition
    class User{
        // member variables
        public $lastname;
        public $firstname;
        public $email;
        public $password;
        public $conn; // database connection handler

        // member functions
        function __construct(){
            // create object of mysqli
            $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASENAME);

            // check if connected to DB
            if ($this->conn->connect_error) {
                die("Failed: ".$this->conn->connect_error);
            }
        }

        # begin login
        function login($email, $password){
            // prepare statement
            $statement = $this->conn->prepare("SELECT * FROM users JOIN roles ON users.role_id=roles.role_id WHERE emailaddress=?");
            
            // bind parameter
            $statement->bind_param("s",$email);

            // execute
            $statement->execute();

            // get result
            $result = $statement->get_result();

            // fetch record
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                // verify password
                if (password_verify($password, $row['password'])) {
                    // password match, then create ksession variable

                    session_start();

                    $_SESSION['myuserid'] = $row['user_id'];
                    $_SESSION['myrole'] = $row['role_name'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['mylogger'] = "OT_BestIR01";
                    $_SESSION['myemail'] = $row['emailaddress'];

                    return true;
                }else {
                    // password doesn't match
                    return false;
                }
            }else {
                // email address doesn't exist
                return false;
            }
        }
        # end login

        # begin logout
        function logout(){
            session_start();
            session_destroy();

            // redirect to login
            header("Location: login.php");
            exit();
        }
    }
?>