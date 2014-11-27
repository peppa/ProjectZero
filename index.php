<?php


require_once 'config/autoload.inc.php';
require_once 'config/config.inc.php';
/*
require_once "./Classes/Controller/CClinica.php";
require_once "./Classes/Utility/USingleton.php";

$clinica= USingleton::getInstance('CClinica');
*/

$CHome= USingleton::getInstance('CHome');
$CHome->start(); 
?>