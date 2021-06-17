<?php

require_once '../vendor/autoload.php';

if (!session_id())
{
    session_start();
}

$facebook = new \Facebook\Facebook([
  'app_id'      => 'YOUR_APP_ID',
  'app_secret'     => 'YOUR_APP_SECRET',
  'default_graph_version'  => 'v5.0'
]);

?>