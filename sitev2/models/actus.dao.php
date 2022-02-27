<?php

require_once("bdd/functions.php");

function getActusFromBDD($type)
{
    $bdd = connectionPDO();
    $stmt = $bdd->prepare('
    SELECT *
    FROM actualite
    WHERE type_actualite = :typeActualite
    ORDER BY date_publication_actualite
    DESC
    ');
    $stmt->bindValue(":typeActualite", $type, PDO::PARAM_STR);
    $stmt->execute();
    $actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
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
