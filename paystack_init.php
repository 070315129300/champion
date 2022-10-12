<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnpay'])) {
        
        //var_dump($_POST);

        include_once "shared/paymentclass.php";

        // create object of payment class
        $obj = new Payment();

        // make use of initialize paystack transaction method
        $output = $obj->initializePaystackTransaction($_POST['email'], $_POST['amount'], $_POST['myreference']);

        $redirect_url = $output['data']['authorization_url'];

        if (!empty($redirect_url)) {
            # redirect to paystack payment gateway
            header("Location: $redirect_url");
        }else{
            echo "<pre>";
            print_r($output);
            echo "</pre>";
        }
    }
?>