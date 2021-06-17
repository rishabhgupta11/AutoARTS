<?php
    $con= mysqli_connect("ADDRESS","USERNAME","PASSWORD","DATABASE_NAME")
    or die(mysqli_error($con));
    if(!isset($_SESSION)) 
    { 
        session_start();
    }
?>