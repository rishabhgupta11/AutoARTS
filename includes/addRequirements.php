<?php

include("../includes/connect.php");
include("../includes/connect2.php");

$emailid = $_SESSION['email'];

$query1 = "SELECT * FROM requirements WHERE Email='$emailid'";
$result1 = mysqli_query($con, $query1) or die(mysqli_error($con));

if(mysqli_num_rows($result1) == 0) 
{
    if(isset($_POST['addReq']) && isset($_SESSION['email']))
    {
        $duration = $_POST['duration'];

        $comma = ",";

        $skillsLanguages = "";
        $totalLanguages = $_SESSION['languageNumber'];
        for($i=1; $i<=$totalLanguages; $i++)
        {
            $num = strval($i);
            if($_POST['skillsLanguage'.$num] != "-- Select Language --")
            {
                $skillsLanguages .= $_POST['skillsLanguage'.$num];
                if( $i != $totalLanguages )
                {
                    $skillsLanguages .= $comma;
                }
            }
        }

        $skillsApp = "";
        $totalApps = $_SESSION['appNumber'];
        for($i=1; $i<=$totalApps; $i++)
        {
            $num = strval($i);
            if($_POST['skillsApp'.$num] != "-- Select Technology --")
            {
                $skillsApp .= $_POST['skillsApp'.$num];
                if( $i != $totalApps )
                {
                    $skillsApp .= $comma;
                }
            }
        }

        $skillsMisc = "";
        $totalMisc = $_SESSION['miscNumber'];
        for($i=1; $i<=$totalMisc; $i++)
        {
            $num = strval($i);
            if($_POST['skillsMisc'.$num] != "-- Select Skill --")
            {
                $skillsMisc .= $_POST['skillsMisc'.$num];
                if($i != $totalMisc)
                {
                    $skillsMisc .= $comma;
                }
            }
        }
        
        $percentage10 = $_POST['percentage10'];
        $percentage12 = $_POST['percentage12'];
        $cgpa = $_POST['cgpa'];

        
        

        $query = "INSERT INTO requirements (Email, Duration, Languages, Applications, Miscellaneous, Percentage10, Percentage12, CGPA) 
                    VALUES ('$emailid', '$duration', '$skillsLanguages', '$skillsApp', '$skillsMisc', '$percentage10', '$percentage12', '$cgpa')";
        mysqli_query($con, $query) or die(mysqli_error($con));

        header('location: ../home/manage.php');
    }
}
else
{
    echo "<center>You have already added your requirements.<center>";
    sleep(3);
    header('location: ../home/manage.php');
}

?>