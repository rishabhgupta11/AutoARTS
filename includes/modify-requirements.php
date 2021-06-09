<?php

require("../includes/connect.php");

$email = $_SESSION['email'];
$query = "DELETE FROM requirements WHERE Email='$email'";
mysqli_query($con, $query);

header('location: ../home/addRequirements.php');

?>