<?php
require_once("configBDD.php");
//-----------------------------------

function connectionPDO()
{
    $bdd = new PDO("mysql:host=" . HOST_NAME . ";dbname=" . DB_NAME . ";charset=utf8;port=3308", "" . USER_NAME . "", "" . PWD . "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    return $bdd;
}
