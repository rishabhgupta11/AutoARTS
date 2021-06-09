<?php

require("../includes/connect.php");

$email = $_SESSION['email'];

if(isset($_POST['uploadFiles']) && isset($_FILES['file'])){
	$total = count($_FILES['file']['name']);

	for($num=0 ; $num < $total ; $num++){
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
		for($i=0; $i<count($array); $i++){
			if($array[$i] == "Duration:"){
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
		$applicantLanguages = '';
		$applicantApplications = '';
		$applicantMiscellaneous = '';

		for($i=0; $i<count($array); $i++){
			if($array[$i] == "Assembly" && $array[$i+1] == "Language"){
				$applicantLanguages .= $array[$i].' '.$array[$i+1].',';
			}
			if($array[$i] == "C/C++" || $array[$i] == "C++" || $array[$i] == "C"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "C#"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Dart"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Fortran"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Go" || $array[$i] == "Golang"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Haskell"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "HTML/CSS"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Java"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Javascript" || $array[$i] == "JavaScript"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Kotlin"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "MATLAB" || $array[$i] == "Matlab"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Objective-C" || $array[$i] == "Obj-C"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Perl"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "PHP"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Python"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "R"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Ruby"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Rust"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Scala"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Swift"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "SQL" || $array[$i] == "NoSQL"){
				$applicantLanguages .= $array[$i].',';
			}
			if($array[$i] == "Typescript" || $array[$i] == "TypeScript"){
				$applicantLanguages .= $array[$i].',';
			}


			if($array[$i] == "Amazon" && $array[$i+1] == "Web" && $array[$i+2] == "Services"){
				$applicantApplications .= 'AWS'.',';
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
				$applicantApplications .= 'GCP'.',';
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
			if($array[$i] == "VMware" || $array[$i] == "VMWare"){
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
				$applicantMiscellaneous .= 'SEO'.',';
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
		$applicantLanguages = explode(',', $applicantLanguages);
		$applicantLanguages = array_flip($applicantLanguages);
		$applicantLanguages = array_flip($applicantLanguages);
		$applicantLanguages = array_values($applicantLanguages);
		$applicantLanguages = implode(',', $applicantLanguages);

		$applicantApplications = explode(',', $applicantApplications);
		$applicantApplications = array_flip($applicantApplications);
		$applicantApplications = array_flip($applicantApplications);
		$applicantApplications = array_values($applicantApplications);
		$applicantApplications = implode(',', $applicantApplications);

		$applicantMiscellaneous = explode(',', $applicantMiscellaneous);
		$applicantMiscellaneous = array_flip($applicantMiscellaneous);
		$applicantMiscellaneous = array_flip($applicantMiscellaneous);
		$applicantMiscellaneous = array_values($applicantMiscellaneous);
		$applicantMiscellaneous = implode(',', $applicantMiscellaneous);

		//Saving Number of Projects
		ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
		$api_json = file_get_contents('https://api.github.com/users/'.$applicantGithubID.'/repos', true);
		$api_data = json_decode($api_json);
		$applicantProjects = count($api_data);

		//Generate Score
		$applicantScore = 0;
		//For Projects
		if($applicantProjects < 15){
			$applicantScore += $applicantProjects * 1.5;
		}
		else{
			if($applicantProjects >= 15){
				$applicantScore += 30;
			}
		}
		//For Experience
		if($applicantExperience >= 1 && $applicantExperience <= 5){
			$applicantScore += 6;
		}
		else{
			if($applicantExperience >= 6 && $applicantExperience <= 12){
				$applicantScore += 12;
			}
			else{
				if($applicantExperience > 12){
					$applicantScore += 20;
				}
			}
		}
		//For Education
		if($applicantPercentage10 >= 65 && $applicantPercentage10 <= 85){
			$applicantScore += 3;
		}
		else{
			if($applicantPercentage10 > 85){
				$applicantScore += 5;
			}
		}
		if($applicantPercentage12 >= 65 && $applicantPercentage12 <= 85){
			$applicantScore += 3;
		}
		else{
			if($applicantPercentage12 > 85){
				$applicantScore += 5;
			}
		}
		if($applicantCGPA >= 6 && $applicantCGPA <= 8){
			$applicantScore += 7;
		}
		else{
			if($applicantCGPA > 8){
				$applicantScore += 10;
			}
		}
		//For Skills
		$languageArray = count(explode(',', $applicantLanguages)) - 1;
		$applicationArray = count(explode(',', $applicantApplications)) - 1;
		$miscArray = count(explode(',', $applicantMiscellaneous)) - 1;
		if($languageArray >= 1 && $languageArray <= 5){
			$applicantScore += $languageArray * 1.5;
		}
		else{
			if($languageArray > 5){
				$applicantScore += 12;
			}
		}
		if($applicationArray >= 1 && $applicationArray <= 3){
			$applicantScore += $applicationArray * 2;
		}
		else{
			if($applicationArray > 3){
				$applicantScore += 10;
			}
		}
		if($miscArray >= 1 && $miscArray <= 4){
			$applicantScore += $miscArray;
		}
		else{
			if($miscArray > 4){
				$applicantScore += 8;
			}
		}

		$emailid = $_SESSION['email'];
		$query = "INSERT INTO applicants (Email, FileName, ApplicantName, ApplicantEmail, GithubID, SkillsLanguage, SkillsApplication, SkillsMisc, Experience, Percentage10, Percentage12, CGPA, Projects, Score) 
                    VALUES ('$emailid', '$file_name', '$applicantName', '$applicantEmail', '$applicantGithubID', '$applicantLanguages', '$applicantApplications', '$applicantMiscellaneous', '$applicantExperience', '$applicantPercentage10', '$applicantPercentage12', '$applicantCGPA', '$applicantProjects', '$applicantScore')";
        mysqli_query($con, $query);
	}
}

?>

<script>
	if(confirm("Resume(s) Uploaded Successfully!"))
	{
		location.href = "../home/rank.php";
	}
	else
	{
		location.href = "../home/rank.php";
	}
</script>