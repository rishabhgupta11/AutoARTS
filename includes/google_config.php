<?php

require_once '../vendor/autoload.php';

$google_client = new Google_Client();

$google_client->setClientId('YOUR_CLIENT_ID');

$google_client->setClientSecret('YOUR_CLIENT_SECRET');

$google_client->setRedirectUri('http://localhost/AutoARTS/includes/google_signin.php');

$google_client->addScope('email');

$google_client->addScope('profile');

if(!isset($_SESSION)) 
{ 
    session_start();
}

?>