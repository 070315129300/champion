<?php 
    // include constants
    include_once "constants.php";
    include_once "common.php";

    // class definition
    class Club{
        // member variable
        public $clubname;
        public $clubyear;
        public $clubdesc;
        public $slogan;
        public $country;
        public $emblem;
        public $conn; // DB connection handler

        // member functions

        #begin constructor
        function __construct(){
            // create mysqli object
            $this->conn = new Mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASENAME);

            // check if connected
            if ($this->conn->connect_error) {
               die("Connection Failed: ".$this->conn->connect_error);
            }
        }
        #end constructor

        # begin listclubs
        public function listClubs(){
            // prepare statement
            $statement = $this->conn->prepare("SELECT * FROM clubs LEFT JOIN countries ON countries.country_id = clubs.country_id");

            // execute
            $statement->execute();

            // get result
            $result = $statement->get_result();

            // fetch records
            $records = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $records[] = $row;
                }
            }

            return $records;
        }
        # end listclubs

        # begin getcountry
        public function getCountry(){
            // prepare statement
            $statement = $this->conn->prepare("SELECT country_id, country_name FROM countries");

            // execute
            $statement->execute();

            // get result
            $result = $statement->get_result();

            // fetch records
            $records = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $records[] = $row;
                }
            }

            return $records;
        }
        # end getcountry

        // begin insertclub
        public function insertClub($name, $year, $desc, $country, $slogan){
            // prepare the statement

            $statement = $this->conn->prepare("INSERT INTO clubs(club_name, year_established, club_desc, emblem, country_id, slogan) VALUES(?,?,?,?,?,?)");


            // allow file extension
            $ext = array('jpg', 'png', 'jpeg', 'gif');

            // create common object
            $obj = new Common;

            $emblem = $obj->uploadAnyFile("clubphotos/", 1048576, $ext);

            // echo "<pre>";
            // print_r($emblem);
            // echo "</pre>";
            // exit;

            if (array_key_exists('success', $emblem)) {
            
                $filename = $emblem['success'];
                // bind parameters
                $statement->bind_param("ssssis",$name, $year, $desc, $filename, $country, $slogan);

                // execute
                $statement->execute();

                if ($statement->affected_rows == 1) {
                    return true;
                }else {
                    return $statement->errors;
                }
            }else{
                return $emblem['error'];
            }
        }
        // end insertclub

        # begin getClub
        public function getClub($clubid){
            // prepare statement
            $statement = $this->conn->prepare("SELECT * FROM clubs WHERE club_id=?");

            // bind the parameter
            $statement->bind_param("i", $clubid);

            // execute
            $statement->execute();

            // get result
            $result = $statement->get_result();
            
            return $result->fetch_assoc();
        }
        # end getClub

        # begin updateClub method
        public function updateClub($name, $year, $desc, $country, $slogan, $clubid){
            // prepare the statement
            $statement = $this->conn->prepare("UPDATE clubs SET club_name=?, year_established=?, club_desc=?, country_id=?, slogan=? WHERE club_id=?");
            // bind parameters
            $statement->bind_param("sssisi", $name, $year, $desc, $country, $slogan, $clubid);

            // execute
            $statement->execute();

            // check if record was updated
            if ($statement->affected_rows == 1){
                return $statement->affected_rows;
            }
        }
        # end updateClub method

        # Begin deleteClub method
        public function deleteClub($id){
            // prepare the state
            $statement = $this->conn->prepare("DELETE FROM clubs WHERE club_id=?");

            // bind param
            $statement->bind_param("i", $id);

            // execute
            $statement->execute();

            // check if record was deleted
            if ($statement->affected_rows == 1) {
               // redirect to listclubs
               $msg = "Club was successfully deleted!";
               header("Location: listclubs.php?m=$msg");
               exit;
            }else{
                // redirect to listclubs
                $msg = "Oops! Could not delete club record.";
               header("Location: listclubs.php?err=$msg");
               exit;
            }
        }
        # End deleteClub method 
    }
?>