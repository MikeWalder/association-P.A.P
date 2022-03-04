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

function selectIdImageLoaded($url_Img)
{
    $bdd = connectionPDO();
    $req = '
    SELECT id_image
    FROM image
    WHERE url_image = :urlImg
    ';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":urlImg", $url_Img, PDO::PARAM_STR);
    $stmt->execute();
    $idImg = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $idImg;
}

function insertActuIntoActuTable($titleActu, $typeActu, $contentActu, $date, $idImg)
{
    $bdd = connectionPDO();
    $req = 'INSERT INTO actualite (libelle_actualite, contenu_actualite, date_publication_actualite, type_actualite, id_image)
    VALUES (:titre, :contenu, :date_ajout, :type_actu, :img)';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":titre", $titleActu, PDO::PARAM_STR);
    $stmt->bindValue(":contenu", $contentActu, PDO::PARAM_STR);
    $stmt->bindValue(":date_ajout", $date, PDO::PARAM_STR);
    $stmt->bindValue(":type_actu", $typeActu, PDO::PARAM_STR);
    $stmt->bindValue(":img", $idImg, PDO::PARAM_INT);
    $res = $stmt->execute();
    $stmt->closeCursor();
    if ($res > 0) {
        return true;
    } else {
        return false;
    }
}

function verifyUploadedActuImage($file, $dir, $name)
{
    if (!file_exists($dir)) mkdir($dir, 0777);

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    // echo "<br>" . $extension . "<br>";
    $target_file = $dir . $name . "_" . $file['name'];
    // echo "<br>" . $target_file . "<br>";

    if (!getimagesize($file['tmp_name'])) {
        throw new Exception("Ce fichier n'est pas une image");
    }
    if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif") {
        throw new Exception("Extension de fichier non reconnu");
    }
    if (file_exists($target_file))
        throw new Exception("Le fichier existe déjà");
    if ($file['size'] > 5000000)
        throw new Exception("Fichier trop volumineux ( > 5 Mo)");
    if (!move_uploaded_file($file['tmp_name'], $target_file))
        throw new Exception("L'image n'a pas pu être ajoutée");
    else
        return ($name . "_" . $file['name']);
}

function insertImgActuUploadedIntoBD($nameImage, $urlImage)
{
    $bdd = connectionPDO();
    $req = '
    INSERT INTO image (libelle_image, url_image, description_image)
    VALUES (:nomImg, :urlImg, :descriptionImg)
    ';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":nomImg", $nameImage, PDO::PARAM_STR);
    $stmt->bindValue(":urlImg", $urlImage, PDO::PARAM_STR);
    $stmt->bindValue(":descriptionImg", $nameImage, PDO::PARAM_STR);
    $res = $stmt->execute();
    $stmt->closeCursor();
    if ($res > 0) {
        return $urlImage;
    } else {
        return false;
    }
}

function selectLastActusFromTable()
{
}
