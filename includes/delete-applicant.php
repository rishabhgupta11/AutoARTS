<?php
require("../includes/connect.php");
include("../includes/aws_s3_config.php");
require("../vendor/autoload.php");

if (isset($_POST['action'])) {
    
    $applicantEmail = $_REQUEST['applicantEmail'];
    $email = $_SESSION['email'];
    
    $query1 = "SELECT FileName FROM applicants WHERE Email='$email' AND ApplicantEmail='$applicantEmail'";
    $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
    $row1 = mysqli_fetch_array($result1);
    $filename = $row1['FileName'];

    try {
        $s3Client = new Aws\S3\S3Client([
            'region' => $region,
            'version' => 'latest',
            'credentials' => [
                'key'    => $key,
                'secret' => $secret,
            ]
        ]);
        $result = $s3Client->deleteObject([
            'Bucket' => 'autoarts-bucket',
            'Key' => $email."/".$filename,
        ]);
    } catch (S3Exception $e) {
        echo $e->getMessage() . "\n";
    }

    $query2 = "DELETE FROM applicants WHERE Email='$email' AND ApplicantEmail='$applicantEmail'";
    mysqli_query($con, $query2) or die(mysqli_error($con));
    echo $filename;
}
?>