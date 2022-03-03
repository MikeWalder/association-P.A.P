<?php
require_once("bdd/functions.php");

function selectAllActuType()
{
    $bdd = connectionPDO();
    $req = "SELECT SUBSTRING(COLUMN_TYPE,5)
    FROM information_schema.COLUMNS 
    WHERE TABLE_SCHEMA='papsite' 
    AND TABLE_NAME='actualite' 
    AND COLUMN_NAME='type_actualite'";
    $stmt = $bdd->prepare($req);
    $stmt->execute();
    $actusTypes = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor(); // libère la connexion au serveur permettant ainsi à d'autres requêtes d'être exécutées
    return $actusTypes;
}

function insertActuIntoActuTable($titleActu, $typeActu, $contentActu, $date, $imgFile)
{
    $bdd = connectionPDO();
    $req = 'INSERT INTO actualite (libelle_actualite, contenu_actualite, date_publication_actualite, type_actualite, id_image)
    VALUES (:titre, :contenu, :date_ajout, :type_actu, :img)';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":titre", $titleActu, PDO::PARAM_STR);
    $stmt->bindValue(":contenu", $contentActu, PDO::PARAM_STR);
    $stmt->bindValue(":date_ajout", $date, PDO::PARAM_STR);
    $stmt->bindValue(":type_actu", $typeActu, PDO::PARAM_STR);
    $stmt->bindValue(":img", $imgFile, PDO::PARAM_INT);
    $res = $stmt->execute();
    $stmt->closeCursor();
    if ($res > 0) {
        return true;
    } else {
        return false;
    }
}

function addAndVerifyImage($file, $dir, $name)
{
    if (!file_exists($dir)) mkdir($dir, 0777);

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) .
        $target_file = $dir . $name . "_" . $file['name'];

    if (!getimagesize($file['tmp_name'])) {
        throw new Exception("Fichier trop volumineux");
    }
    if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extenson !== "gif") {
        throw new Exception("Extension de fichier non reconnu");
    }
    if (file_exists($target_file))
        throw new Exception("Le fichier existe déjà");
    if ($file['size'] > 500000)
        throw new Exception("Fichier trop volumineux ( > 500Ko)");
    if (!move_uploaded_file($file['tmp_name'], $target_file))
        throw new Exception("L'image n'a pas pu être ajoutée");
}
