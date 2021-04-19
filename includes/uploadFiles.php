<?php

require("../includes/connect.php");

$email = $_SESSION['email'];

if(isset($_POST['uploadFiles']) && isset($_FILES['file']))
{
	$total = count($_FILES['file']['name']);

	for($num=0 ; $num < $total ; $num++)
	{
		$file_name = $_FILES['file']['name'][$num];   
		$temp_file_location = $_FILES['file']['tmp_name'][$num]; 

		include("../includes/aws_s3_config.php");
		require("../vendor/autoload.php");

		$s3 = new Aws\S3\S3Client([
			'region'  => $region,
			'version' => 'latest',
			'credentials' => [
				'key'    => $key,
				'secret' => $secret,
			]
		]);		
		
		//Upload to S3
		$result = $s3->putObject([
			'Bucket' => $bucket,
			'Key'    => $email."/".$file_name,
			'SourceFile' => $temp_file_location			
		]);

		//Parse PDF
		$parser = new \Smalot\PdfParser\Parser();
		$pdf    = $parser->parseFile($temp_file_location);
		
		$pages  = $pdf->getPages();
		
		foreach ($pages as $page){
			$a = $page->getText();
		}
		
		//Convert string to array
		$array = explode(' ', $a);
		foreach($array as $key => $value){
			$array[$key] = trim($value);
		}

		//Saving Name
		$firstname = $array[0];
		$lastname = $array[1];
		$applicantName = $firstname." ".$lastname;

		//Saving Email
		$getRegex = preg_grep("/@/", $array);
		$str = implode(" ",$getRegex);
		$emailArray = explode(" ", $str);
		$applicantEmail = $emailArray[0];

		//Saving Github ID
		$getRegex = preg_grep("/github.com/", $array);
		$str = implode("/", $getRegex);
		$gitarray = explode('/', $str);
		$applicantGithubID = $gitarray[1];

		//Saving Experience
		$applicantExperience = 0;
		for($i=0; $i<count($array); $i++)
		{
			if($array[$i] == "Duration:")
			{
				$applicantExperience += $array[$i+1];
			}
		}

		//Saving Percentages
		$higherIdx = 0;
		$seniorIdx = 0;

		for($i=0; $i<count($array); $i++){
			if($array[$i] == "Higher" && $array[$i+1] == "Secondary" && $array[$i+2] == "School"){
				$higherIdx = $i;
			}
			if($array[$i] == "Senior" && $array[$i+1] == "Secondary" && $array[$i+2] == "School"){
				$seniorIdx = $i;
			}
		}

		if($higherIdx < $seniorIdx){
			$getRegex = preg_grep("/(\d)+%/", $array);
			$str = implode('', $getRegex);
			$percentageArray = explode('%', $str);
			$applicantPercentage12 = $percentageArray[0];
			$applicantPercentage10 = $percentageArray[1];
		}

		if($seniorIdx < $higherIdx){
			$getRegex = preg_grep("/(\d)+%/", $array);
			$str = implode('', $getRegex);
			$percentageArray = explode('%', $str);
			$applicantPercentage10 = $percentageArray[0];
			$applicantPercentage12 = $percentageArray[1];
		}

		//Saving CGPA
		for($i=0; $i<count($array); $i++){
			if($array[$i] == "CGPA:" || $array[$i] == "GPA:"){
				$cgpa = $array[$i+1];
			}
		}
		$cgpa = explode("/", $cgpa);
		$applicantCGPA = $cgpa[0];

		//Saving Skills
		$applicantLangauages = '';
		$applicantApplications = '';
		$applicantMiscellaneous = '';

		for($i=0; $i<count($array); $i++){
			if($array[$i] == "Assembly" && $array[$i+1] == "Language"){
				$applicantLanguages .= $array[$i].' '.$array[$i+1].',';
			}
			if($array[$i] == "C/C++" || $array[$i] == "C++" || $array[$i] == "C"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "C#"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Dart"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Fortran"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Go" || $array[$i] == "Golang"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Haskell"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "HTML/CSS"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Java"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Javascript" || $array[$i] == "JavaScript"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Kotlin"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "MATLAB" || $array[$i] == "Matlab"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Objective-C" || $array[$i] == "Obj-C"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Perl"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "PHP"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Python"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "R"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Ruby"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Rust"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Scala"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Swift"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "SQL" || $array[$i] == "NoSQL"){
				$applicantLangauages .= $array[$i].',';
			}
			if($array[$i] == "Typescript" || $array[$i] == "TypeScript"){
				$applicantLangauages .= $array[$i].',';
			}


			if($array[$i] == "Amazon" && $array[$i+1] == "Web" && $array[$i+2] == "Services"){
				$applicantApplications .= $array[$i].' '.$array[$i+1].' '.$array[$i+2].',';
			}
			if($array[$i] == "AWS"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "ASP.NET"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "Android"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "Django"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "ExpressJS"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "Flutter"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "Flask"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "Google" && $array[$i+1] == "Cloud" && $array[$i+2] == "Platform"){
				$applicantApplications .= $array[$i].' '.$array[$i+1].' '.$array[$i+2].',';
			}
			if($array[$i] == "GCP"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "IBM" && $array[$i+1] == "Cloud"){
				$applicantApplications .= $array[$i].' '.$array[$i+1].',';
			}
			if($array[$i] == "iOS"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "LAMP"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "Laravel"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "Microsoft" && $array[$i+1] == "Azure"){
				$applicantApplications .= $array[$i].' '.$array[$i+1].',';
			}
			if($array[$i] == "NodeJS"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "Oracle"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "React"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "React" && $array[$i+1] == "Native"){
				$applicantApplications .= $array[$i].' '.$array[$i+1].',';
			}
			if($array[$i] == "Spring"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "VMware"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "Xamarin"){
				$applicantApplications .= $array[$i].',';
			}
			if($array[$i] == "XAMPP"){
				$applicantApplications .= $array[$i].',';
			}


			if($array[$i] == "Linux"){
				$applicantMiscellaneous .= $array[$i].',';
			}
			if($array[$i] == "MS" && $array[$i+1] == "Office"){
				$applicantMiscellaneous .= $array[$i].' '.$array[$i+1].',';
			}
			if($array[$i] == "SDLC"){
				$applicantMiscellaneous .= $array[$i].',';
			}
			if($array[$i] == "SEO"){
				$applicantMiscellaneous .= $array[$i].',';
			}
			if($array[$i] == "Search" && $array[$i+1] == "Engine" && $array[$i+2] == "Optimization"){
				$applicantApplications .= $array[$i].' '.$array[$i+1].' '.$array[$i+2].',';
			}
			if($array[$i] == "Shell" && $array[$i+1] == "Script"){
				$applicantMiscellaneous .= $array[$i].' '.$array[$i+1].',';
			}
			if($array[$i] == "Systems" && $array[$i+1] == "Design"){
				$applicantMiscellaneous .= $array[$i].' '.$array[$i+1].',';
			}
			if($array[$i] == "UI/UX"&& $array[$i+1] == "Design"){
				$applicantMiscellaneous .= $array[$i].' '.$array[$i+1].',';
			}
			
		}

		$emailid = $_SESSION['email'];
		$query = "INSERT INTO applicants (Email, ApplicantName, ApplicantEmail, GithubID, SkillsLanguage, SkillsApplication, SkillsMisc, Experience, Percentage10, Percentage12, CGPA) 
                    VALUES ('$emailid', '$applicantName', '$applicantEmail', '$applicantGithubID', '$applicantLangauages', '$applicantApplications', '$applicantMiscellaneous', '$applicantExperience', '$applicantPercentage10', '$applicantPercentage12', '$applicantCGPA')";
        mysqli_query($con, $query);
	}
}

?>

<script>
	if(confirm("Resume(s) Uploaded Successfully!"))
	{
		location.href = "../home/upload.php";
	}
	else
	{
		location.href = "../home/upload.php";
	}
</script>