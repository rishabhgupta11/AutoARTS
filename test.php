<?php

require("includes/connect.php");
$query1 = "SELECT * FROM requirements WHERE Email='rishabh.gupta18@vit.edu'";
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
    }

    $expectedLanguages = explode(',', $expectedLanguages);
    array_splice($expectedLanguages, count($expectedLanguages) - 1, 1); 
    var_dump($expectedLanguages);
    $expectedApplications = explode(',', $expectedApplications);
    array_splice($expectedApplications, count($expectedApplications) - 1, 1); 
    var_dump($expectedApplications);
    $expectedMiscellaneous = explode(',', $expectedMiscellaneous);
    array_splice($expectedMiscellaneous, count($expectedMiscellaneous) - 1, 1); 
    var_dump($expectedMiscellaneous);
    
    echo count($expectedLanguages);
    echo count($expectedApplications);
    echo count($expectedMiscellaneous);

?>