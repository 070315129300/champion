<?php 
   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   
   // check if method is PUT

   if($_SERVER['REQUEST_METHOD'] == 'PUT'){
        # get the raw data from request body
        $rawdata = file_get_contents('php://input');

        $data = json_decode($rawdata);

        // validate all inputs
        if (empty($data->firstname) || empty($data->lastname) || empty($data->dob) || empty($data->phone) || empty($data->email) || empty($data->password) || empty($data->userid)) {
            
            $response = array(
                "status"=> "failed",
                "message"=> "Bad request, All fields are required!",
                "data"=> []
            );

            echo json_encode($response);

        }else{
            # include class
            include_once "champapi.php";

            // create object of class ChampApi
            $obj = new ChampApi();

            // reference insertUser
            $output = $obj->updateUser($data->lastname, $data->firstname, $data->dob, $data->email, $data->password, $data->phone, $data->userid);

            echo $output;
        }

   }else{
    $response = array(
        "status"=> "failed",
        "message"=> "Method not allow",
        "data"=> []
    );

    echo json_encode($response);
   }
?>