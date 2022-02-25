<?php

require_once("bdd/functions.php");

function getActusFromBDD()
{
    $bdd = connectionPDO();
    $req = $bdd->prepare('
    SELECT *
    FROM actualite
    ');

    $req->execute();
    $actualites = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $actualites;
}

function getImageActualiteFromBDD($idImage)
{
    $bdd = connectionPDO();
    $stmt = $bdd->prepare('
    SELECT *
    FROM image
    WHERE id_image = :idImage
    ');
    $stmt->bindValue(":idImage", $idImage, PDO::PARAM_INT);
    $stmt->execute();
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $image;
}
