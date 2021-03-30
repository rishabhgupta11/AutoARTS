<?php

require_once '../vendor/autoload.php';

if (!session_id())
{
    session_start();
}

$facebook = new \Facebook\Facebook([
  'app_id'      => '197160548504222',
  'app_secret'     => '35b0c0a7bc098690de3accc817c7ba98',
  'default_graph_version'  => 'v2.10'
]);

?>