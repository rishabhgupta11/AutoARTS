<?php

require("../includes/connect.php");
include("../includes/aws_s3_config.php");
require("../vendor/autoload.php");

$email = $_SESSION['email'];

if(isset($_POST['uploadFiles']) && isset($_FILES['file']))
{
	$total = count($_FILES['file']['name']);

	for( $i=0 ; $i < $total ; $i++ )
	{
		$file_name = $_FILES['file']['name'][$i];   
		$temp_file_location = $_FILES['file']['tmp_name'][$i]; 

		$s3 = new Aws\S3\S3Client([
			'region'  => $region,
			'version' => 'latest',
			'credentials' => [
				'key'    => $key,
				'secret' => $secret,
			]
		]);		

		$result = $s3->putObject([
			'Bucket' => $bucket,
			'Key'    => $email."/".$file_name,
			'SourceFile' => $temp_file_location			
		]);

		var_dump($result);
	}
}

?>