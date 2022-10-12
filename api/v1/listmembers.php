<?php 
    // check if the request method is GET

    if ($_SERVER['REQUEST_METHOD']=='GET') {
        # include champapi class file
        include_once "champapi.php";

        // create object of ChampApi class
        $obj = new ChampApi();

        // make use of getUsers method
        $output = $obj->getUser();

        echo $output;
    }else{
        $response = array(
            "status"=> "failed",
            "message"=> "Method not allow",
            "data"=> []
        );

        echo json_encode($response);
    }
?>