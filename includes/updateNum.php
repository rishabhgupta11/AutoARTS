<?php
require("../includes/connect.php");

if(isset($_POST['action1']) && isset($_POST['languageNumber']))
{
    $_SESSION['languageNumber'] = $_POST['languageNumber'];
    echo $_SESSION['languageNumber'];
}

if(isset($_POST['action2']) && isset($_POST['appNumber']))
{
    $_SESSION['appNumber'] = $_POST['appNumber'];
    echo $_SESSION['appNumber'];
}

if(isset($_POST['action3']) && isset($_POST['miscNumber']))
{
    $_SESSION['miscNumber'] = $_POST['miscNumber'];
    echo $_SESSION['miscNumber'];
}

?>