<?php

require("../includes/connect.php");
if (isset($_REQUEST['applicantEmail'])) {
    $applicantEmail = $_REQUEST['applicantEmail'];
    $email = $_SESSION['email'];

    
    $query = "UPDATE applicants SET Star = '0' WHERE Email='$email' AND ApplicantEmail='$applicantEmail'";
    mysqli_query($con, $query) or die(mysqli_error($con));
    echo "done";
}
?>