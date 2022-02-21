<?php
require_once("config.php");
//-----------------------------------

function connectionPDO()
{
    try {
        $bdd = new PDO("mysql:host=" . HOST_NAME . ";dbname=" . DB_NAME . ";charset=utf8;port=3308", "" . USER_NAME . "", "" . PWD . "");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        return $bdd;
    } catch (PDOException $e) {
        $message = "Erreur de connexion PDO : " . $e->getMessage();
        die($message);
    }
}

function mainTitlePensionnaire($val)
{
    $mainTitle = "";
    if ($val === TO_ADOPT) {
        $mainTitle = "Ils cherchent une famille";
    } else if ($val === IS_ADOPTED) {
        $mainTitle = "Les anciens";
    } else if ($val === FALD) {
        $mainTitle = "Famille d'accueil longue durée";
    }
    return $mainTitle;
}
