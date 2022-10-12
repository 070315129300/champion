<?php 
    var_dump($_REQUEST);

    if (isset($_REQUEST['reference'])) {
        
        include_once "shared/paymentclass.php";

        // create object of class payment
        $obj = new Payment();

        // make use of the verify paystack transaction method
        $output = $obj->verifyPaystackTransaction($_REQUEST['reference']);

        if (isset($output->data->status) && $output->data->status == 'success') {
           
            // update transaction
            $update_status = $obj->updateDetails($output->data->reference, $output->data->amount);

            $ref = $_REQUEST['reference'];

            if ($update_status == true) {
                # redirect to success page
                $ref = $_REQUEST['reference'];
                header("Location: paystack_success.php?ref=$ref");
                exit;
            }else{
                # redirect to failed page
                header("Location: paystack_failed.php?ref=$ref");
                exit;
            }
        }else{
            echo "Oops! Could not verify transaction.";

            echo "<pre>";
            print_r($output);
            echo "</pre>";
        }
    }
?>