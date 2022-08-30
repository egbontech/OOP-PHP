<?php
session_start();

include "init.php";

$session = new Session();

if($session->exists('Auth'))
{
    $session->destroy('Auth');
}


header("Location: login.php");
die();