<?php

require_once '../vendor/autoload.php';

$google_client = new Google_Client();

$google_client->setClientId('357670966951-09qd3dgu5290d370st55c9bsmb227s3g.apps.googleusercontent.com');

$google_client->setClientSecret('bzE7_fphwhgIM8mBNyHBrdiJ');

$google_client->setRedirectUri('http://localhost/AutoARTS/includes/google_signin.php');

$google_client->addScope('email');

$google_client->addScope('profile');

if(!isset($_SESSION)) 
{ 
    session_start();
}

?>