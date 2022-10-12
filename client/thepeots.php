<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Poets</title>

    <!-- Bootstrap CSS Stylesheet -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="ffont/css/all.min.css">

    <style>
        div{
            border: 1px solid #000;
        }

        .box{
            width: 20em;
            height: 20em;
            float: left;
            border: 1px solid #000;
        }

        .poetimg{
            width: 15em;
            height: 15em;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php 
        // Step 1: Initialize Curl Session
        $curlsession = curl_init();

        $url = "http://api.naijapoetry.com/api/Poetry/GetRecentPoets";

        // Step 2: Set Call Options
        curl_setopt($curlsession, CURLOPT_URL, $url);
        curl_setopt($curlsession, CURLOPT_RETURNTRANSFER, true); // return the string
        curl_setopt($curlsession, CURLOPT_SSL_VERIFYPEER, false); // do not verify SSL Certificate

        // Step 3: execute curl
        $response = curl_exec($curlsession);

        if (curl_error($curlsession) == true) {
            die("Error :".$curl_error($curlsession));
        }

        // Step 4: close curl session
        curl_close($curlsession);

        // Step 5: use the response to implement Poet Page
        $poets = json_decode($response);
        // echo "<pre>";
        // print_r($poets->data);
        // echo "</pre>";

        $allpoets = $poets->data;

        // check if there is data

        if (count($allpoets) > 0) {
           foreach ($allpoets as $key => $value) {
         # code...
        ?>

        
        <div class="box">
            <?php 
                $firstname = $value->firstname;
                $surname = $value->surname;
                $poetimage = $value->poetImageUrl;

                if (empty($poetimage)) {
                    echo "<img src='../images/avatar.png' alt='$firstname' class='poetimg' />";
                }else{
                    $newpoetimage = "http://naijapoetry.com".$poetimage;
                    echo "<img src='$newpoetimage' alt='$firstname' class='poetimg' />";
                }

                echo "<p>$firstname $surname</p>";
            ?>

        </div>
        <?php
           }
        }
    ?>

    
</body>
</html>