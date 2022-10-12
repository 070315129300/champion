<?php 
    include_once("shared/user.php");

    // create object of user
    $obj = new User();

    // make reference to login
    $obj->logout();
?>