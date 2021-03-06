<?php
include('google_config.php');
require("../includes/connect.php");
require("../vendor/autoload.php");

$login_button = '';
$firstname = '';
$lastname = '';
$emailid = '';
$space = ' ';

if(isset($_GET["code"]))
{
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if(!isset($token['error']))
    {
        $google_client->setAccessToken($token['access_token']);

        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);

        $data = $google_service->userinfo->get();

        if(!empty($data['given_name']))
        {
            $firstname = $data['given_name'];
        }

        if(!empty($data['family_name']))
        {
            $lastname = $data['family_name'];
        }

        if(!empty($data['email']))
        {
            $emailid = $data['email'];
        }
        
        $user_check_query = "SELECT * FROM user WHERE email='$emailid' LIMIT 1";
        $name = $firstname.$space.$lastname;
        $result = mysqli_query($con, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if (!$user) 
        {
            $query = "INSERT INTO user (Name, Email) VALUES('$name', '$emailid')";
            mysqli_query($con, $query);
            $_SESSION['email'] = $emailid;
            header('location: ../home/addRequirements.php');
        }
        else
        {
            $_SESSION['email'] = $emailid;
            header('location: ../home/upload.php');
        }
    }
}

if(!isset($_SESSION['access_token']))
{
    $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="../images/google-signin.png" style="width:50px;"></a>';
}

?>