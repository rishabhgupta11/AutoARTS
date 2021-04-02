<?php
    $con= mysqli_connect("localhost","root","","autoarts")
    or die(mysqli_error($con));
    if(!isset($_SESSION)) 
    { 
        session_start();
    }
?>