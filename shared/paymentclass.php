<?php 
    include_once "constants.php";

    // class definition
    class Payment{

        // member variable
        public $amount;
        public $email;
        public $productid;
        public $conn;// database connection handler

        // member method
        public function __construct(){
            // open DB connection
            $this->conn = new Mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASENAME);

            // check if connected
            if ($this->conn->connect_error) {
               die("Failed to connect ".$this->conn->connect_error);
            }
        }

        # begin getproducts method
        public function getProducts(){
            // prepare statement
            $statement = $this->conn->prepare("SELECT * FROM products");

            // execute
            $statement-> execute();

            // get result
            $result = $statement->get_result();

            $data = array();
            if ($result->num_rows > 0) {
                # fetch row
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }

            return $data;
        }
        # end getproducts method

        # begin insertdetails
        public function insertDetails($userid, $productid, $amount, $reference){
            // prepare statement
            $statement = $this->conn->prepare("INSERT INTO payment(user_id, product_id, amount, reference) VALUES(?,?,?,?)");

            // bind parameters
            $statement->bind_param("iids",$userid, $productid, $amount, $reference);

            // execute
            $statement->execute();

            // check if there is records
            if ($statement->affected_rows == 1) {
                return true;
            }else{
                return false;
            }
        }
        # end insertdetails

        # begin initialize paystack transaction
        public function initializePaystackTransaction($email, $amount, $ref){
            $url = "https://api.paystack.co/transaction/initialize";

            $callbackurl = "http://localhost/champion/paystack_callback.php";
            $key = "sk_test_f86ee939242f1c97445d632e2cfe8ec107cd02f7";

            $fields = array(
                'email'=> $email,
                'amount'=> $amount * 100,
                'callback_url'=> $callbackurl,
                'reference'=> $ref
            );

            // convert the callback to a query string
            $strfields = http_build_query($fields);

            // Step 1: open connection/ curl session
            $ch = curl_init();

            // Step 2: Set curl options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true); // Post Method use in sending the data
            curl_setopt($ch, CURLOPT_POSTFIELDS, $strfields); // data sent
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return response as string
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // do not verify SSL certificate
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer $key",
                "Cache-Control: no-cache",
            ));

            // Step 3: Execute Curl
            $response = curl_exec($ch);

            if (curl_error($ch)) {
                die("Error: ".curl_error($ch));
            }

            // Step 4: Close Connection/curl session
            curl_close($ch);

            // Staep 5: Convert json response to array
            $result = json_decode($response, true);

            return $result;
        }
        # end initialize paystack transaction
        
        # begin veriry paystack transaction
        public function verifyPaystackTransaction($ref){

            $url = "https://api.paystack.co/transaction/verify/$ref";
            $key = "sk_test_f86ee939242f1c97445d632e2cfe8ec107cd02f7";

            // Step 1: open connection
            $ch = curl_init();

            // Step 2: Set curl option 
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer $key"
            ));

            // Step 3: Execute curl
            $response = curl_exec($ch);

            if (curl_error($ch)) {
                die("Oops! ".curl_error($ch));
            }

            // Step 4: close curl session
            curl_close($ch);

            // Step 5: convert json response to object
            $result = json_decode($response);

            return $result;

        }
        # end veriry paystack transaction

        # begin update transaction details
        public function updateDetails($ref, $amount){
            // Check if Paystack Amount is the same as Portal Amount (ASSIGNMENT)

            // update statement
            $statement = $this->conn->prepare("UPDATE payment SET paymentstatus=? WHERE reference=?");

            // bind parameters
            $paymentstatus = "completed";
            $statement->bind_param("ss",$paymentstatus, $ref);

            // execute
            $statement->execute();

            // check if there is records
            if ($statement->affected_rows == 1) {
                return true;
            }else{
                return false;
            }
        }
        # end update transaction details
    }
?>