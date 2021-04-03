<?php
if(isset($_FILES['file']))
{
	$total = count($_FILES['file']['name']);

	for( $i=0 ; $i < $total ; $i++ )
	{
		$file_name = $_FILES['file']['name'][$i];   
		$temp_file_location = $_FILES['file']['tmp_name'][$i]; 

		require 'vendor/autoload.php';

		$s3 = new Aws\S3\S3Client([
			'region'  => 'us-east-1',
			'version' => 'latest',
			'credentials' => [
				'key'    => "AKIAXDUT7QBNPY7AR2WG",
				'secret' => "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",
			]
		]);		

		$result = $s3->putObject([
			'Bucket' => 'autoarts-bucket',
			'Key'    => $file_name,
			'SourceFile' => $temp_file_location			
		]);

		var_dump($result);
	}
}
?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">         
	<input type="file" name="file[]" multiple/>
	<br>
	<br>
	<input type="submit"/>
</form>