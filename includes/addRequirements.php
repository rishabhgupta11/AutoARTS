<?php

include("../includes/connect.php");
include("../includes/connect2.php");

if(isset($_POST['addReq'])){
    $duration = $_POST['duration'];
    $skillsLanguages = "";
    $totalLanguages = $_SESSION['languageNumber'];
    $comma = ",";
    for($i = 1; $i<=$totalLanguages; $i++ ){
        $x = strval($i);
        $skillsLanguages .= $_POST['skillsLanguage'.$x];
        if( $i != $totalLanguages ){
            $skillsLanguages .= $comma;
        }
    }

    $skillsApp = "";
    $totalApps = $_SESSION['appNumber'];
    for($i = 1; $i<=$totalApps; $i++ ){
        $x = strval($i);
        $skillsApp .= $_POST['skillsApp'.$x];
        if( $i != $skillsApp ){
            $skillsApp .= $comma;
        }
    }

    $skillsMisc = "";
    $totalMisc = $_SESSION['miscNumber'];
    for($i = 1; $i<=$totalMisc; $i++ ){
        $x = strval($i);
        $skillsMisc .= $_POST['skillsMisc'.$x];
        if( $i != $totalMisc ){
            $skillsMisc .= $comma;
        }
    }
    
    $percentage10 = $_POST['percentage10'];
    $percentage12 = $_POST['percentage12'];
    $cgpa = $_POST['cgpa'];

    $emailid=  $_SESSION['email'];


    $query = "INSERT INTO requirements (Email, Duration, Languages, Applications, Miscellaneous, Percentage10, Percentage12, CGPA )
              VALUES( '$emailid','$duration','$skillsLanguages','$skillsApp','$skillsMisc','$percentage10','$percentage12','$cgpa')";
    
    mysqli_query($con, $query);




    


}

?>