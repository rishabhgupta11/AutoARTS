<?php
require("../includes/connect.php");
include("../includes/aws_s3_config.php");
require("../vendor/autoload.php");

if (isset($_POST['action'])) {
    
    $applicantResume = $_POST['applicantResume'];
    $email = $_SESSION['email'];
    try {
        $s3Client = new Aws\S3\S3Client([
            'region' => $region,
            'version' => 'latest',
            'credentials' => [
                'key'    => $key,
                'secret' => $secret,
            ]
        ]);
        //$result = $s3Client->getObjectUrl('autoarts-bucket', $email."/".$applicantResume);
        $cmd = $s3Client->getCommand('GetObject', [
            'Bucket' => 'autoarts-bucket',
            'Key' => $email."/".$applicantResume
        ]);

        $request = $s3Client->createPresignedRequest($cmd, '+20 minutes');
        $presignedUrl = (string)$request->getUri();
        echo $presignedUrl;
    } 
    catch (S3Exception $e) {
        echo $e->getMessage() . "\n";
    }
}
?>