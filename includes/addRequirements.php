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
            if($_POST['skillsLanguage'.$num] != NULL)
            {
                $skillsLanguages .= $_POST['skillsLanguage'.$num];
                $skillsLanguages .= $comma;
            }
        }

        $skillsApp = "";
        $totalApps = $_SESSION['appNumber'];
        for($i=1; $i<=$totalApps; $i++)
        {
            $num = strval($i);
            if($_POST['skillsApp'.$num] != NULL)
            {
                $skillsApp .= $_POST['skillsApp'.$num];
                $skillsApp .= $comma;
            }
        }

        $skillsMisc = "";
        $totalMisc = $_SESSION['miscNumber'];
        for($i=1; $i<=$totalMisc; $i++)
        {
            $num = strval($i);
            if($_POST['skillsMisc'.$num] != NULL)
            {
                $skillsMisc .= $_POST['skillsMisc'.$num];
                $skillsMisc .= $comma;
            }
        }
        
        $percentage10 = $_POST['percentage10'];
        $percentage12 = $_POST['percentage12'];
        $cgpa = $_POST['cgpa'];

        
        

        $query = "INSERT INTO requirements (Email, Duration, Languages, Applications, Miscellaneous, Percentage10, Percentage12, CGPA) 
                    VALUES ('$emailid', '$duration', '$skillsLanguages', '$skillsApp', '$skillsMisc', '$percentage10', '$percentage12', '$cgpa')";
        mysqli_query($con, $query) or die(mysqli_error($con));

        header('location: ../home/upload.php');
    }
}
else
{
    echo "<center>You have already added your requirements.<center>";
    sleep(3);
    header('location: ../home/upload.php');
}

?>