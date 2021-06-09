<?php
require("../includes/connect.php");
require("../includes/connect2.php");

function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

$email = $_SESSION['email'];

$query1 = "SELECT * FROM requirements WHERE Email='$email'";
$result1 = mysqli_query($con, $query1);
if(mysqli_num_rows($result1) == 0){
    header('location: ../home/addRequirements.php');
}
else{
    $row1 = mysqli_fetch_array($result1);
    $expectedExperience = $row1['Duration'];
    $expectedPercentage10 = $row1['Percentage10'];
    $expectedPercentage12 = $row1['Percentage12'];
    $expectedCGPA = $row1['CGPA'];
    $expectedLanguages = $row1['Languages'];
    $expectedApplications = $row1['Applications'];
    $expectedMiscellaneous = $row1['Miscellaneous'];

    $expectedLanguages = explode(',', $expectedLanguages);
    array_splice($expectedLanguages, count($expectedLanguages) - 1, 1);

    $expectedApplications = explode(',', $expectedApplications);
    array_splice($expectedApplications, count($expectedApplications) - 1, 1); 

    $expectedMiscellaneous = explode(',', $expectedMiscellaneous);
    array_splice($expectedMiscellaneous, count($expectedMiscellaneous) - 1, 1); 
}

$fileName = "autoarts-download".date('Ymd') .".xlsx"; 
    
$fields = array('Name', 'Email'); 

$excelData = implode("\t", array_values($fields)) . "\n"; 

$query = $conn->query("SELECT * FROM applicants ORDER BY Score, Star DESC"); 
if($query->num_rows > 0)
{ 
    while($row = $query->fetch_assoc())
    { 

        if($row['Experience'] >= $expectedExperience && $row['Percentage10'] >= $expectedPercentage10 && $row['Percentage12'] >= $expectedPercentage12 && $row['CGPA'] >= $expectedCGPA)
        {
                        
            $applicantLanguages = $row['SkillsLanguage'];
            $applicantLanguages = explode(',', $applicantLanguages);
            array_splice($applicantLanguages, count($applicantLanguages) - 1, 1); 

            $applicantApplications = $row['SkillsApplication'];
            $applicantApplications = explode(',', $applicantApplications);
            array_splice($applicantApplications, count($applicantApplications) - 1, 1);

            $applicantMiscellaneous = $row['SkillsMisc'];
            $applicantMiscellaneous = explode(',', $applicantMiscellaneous);
            array_splice($applicantMiscellaneous, count($applicantMiscellaneous) - 1, 1);

            $iterations = 0;
            if(count($applicantLanguages) > count($applicantApplications) && count($applicantLanguages) > count($applicantMiscellaneous)){
                $iterations = count($applicantLanguages);
            }
            elseif(count($applicantApplications) > count($applicantLanguages) && count($applicantApplications) > count($applicantMiscellaneous)){
                $iterations = count($applicantApplications);
            }
            elseif(count($applicantMiscellaneous) > count($applicantLanguages) && count($applicantMiscellaneous) > count($applicantApplications)){
                $iterations = count($applicantMiscellaneous);
            }

            for($foo = 0; $foo<$iterations; $foo++){

                if(count($applicantLanguages) > 0 && count($expectedLanguages) > 0 && array_key_exists($foo, $applicantLanguages)){

                    if(in_array($applicantLanguages[$foo], $expectedLanguages)){

                        $rowData = array($row['ApplicantName'], $row['ApplicantEmail']); 
                        array_walk($rowData, 'filterData'); 
                        $excelData .= implode("\t", array_values($rowData)) . "\n";
                        break;
                    }
                }

                if(count($applicantApplications) > 0 && count($expectedApplications) > 0 && array_key_exists($foo, $applicantApplications)){

                    if(in_array($applicantApplications[$foo], $expectedApplications)){

                        $rowData = array($row['ApplicantName'], $row['ApplicantEmail']); 
                        array_walk($rowData, 'filterData'); 
                        $excelData .= implode("\t", array_values($rowData)) . "\n";
                        break;
                    }
                }

                if(count($applicantMiscellaneous) > 0 && count($expectedMiscellaneous) > 0 && array_key_exists($foo, $applicantMiscellaneous)){

                    if(in_array($applicantMiscellaneous[$foo], $expectedMiscellaneous)){

                        $rowData = array($row['ApplicantName'], $row['ApplicantEmail']); 
                        array_walk($rowData, 'filterData'); 
                        $excelData .= implode("\t", array_values($rowData)) . "\n";
                        break;
                    }
                }

            } 
        }
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
    
} 

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".$fileName);  

echo $excelData; 
   
?>