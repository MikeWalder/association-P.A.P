<?php
require_once("bdd/functions.php");


function selectAllAnimals()
{
    $bdd = connectionPDO();
    $req = 'SELECT * FROM animal ORDER BY id_statut, id_animal';
    $stmt = $bdd->prepare($req);
    $stmt->execute();
    $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor(); // libère la connexion au serveur permettant ainsi à d'autres requêtes d'être exécutées
    return $animaux;
}

function countAnimalsByStatut()
{
    $bdd = connectionPDO();
    $req = 'SELECT COUNT(a.id_animal) as nbre FROM animal a RIGHT OUTER JOIN statut s ON a.id_statut = s.id_statut GROUP BY s.id_statut';
    $stmt = $bdd->prepare($req);
    $stmt->execute();
    $countStatut = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $countStatut;
}

function selectAnimalById($id_Animal)
{
    $bdd = connectionPDO();
    $req = '
    SELECT *
    FROM animal 
    WHERE id_animal = :idAnimal';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":idAnimal", $id_Animal, PDO::PARAM_INT);
    $stmt->execute();
    $selectedAnimal = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    if (!empty($selectedAnimal))
        return $selectedAnimal;
}

function selectImageById($idImage)
{
    $idImage = (int)$idImage;
    $bdd = connectionPDO();
    $req = '
    SELECT id_image, url_image
    FROM image
    WHERE id_image = :idImg';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":idImg", $idImage, PDO::PARAM_INT);
    $stmt->execute();
    $selectedImage = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    if (!empty($selectedImage))
        return $selectedImage;
}

function selectFirstImageFromIdAnimal($idAnimal)
{
    $bdd = connectionPDO();
    $stmt = $bdd->prepare('
    SELECT i.id_image, url_image, libelle_image, description_image 
    FROM image i 
    INNER JOIN contient c ON i.id_image = c.id_image 
    INNER JOIN animal a ON a.id_animal = c.id_animal 
    WHERE a.id_animal= :idAnimal
    LIMIT 1
    ');
    $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);
    $stmt->execute();
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $image;
}

function selectImagesFromIdAnimal($idAnimal)
{
    $bdd = connectionPDO();
    $stmt = $bdd->prepare('
    SELECT i.id_image, url_image, libelle_image, description_image, size_image 
    FROM image i 
    INNER JOIN contient c ON i.id_image = c.id_image 
    INNER JOIN animal a ON a.id_animal = c.id_animal 
    WHERE a.id_animal= :idAnimal
    ');
    $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);
    $stmt->execute();
    $image = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $image;
}

function selectImageBySizeAndDescription($size, $description)
{
    $size = (int)$size;
    $bdd = connectionPDO();
    $req = '
    SELECT url_image
    FROM image
    WHERE size = :sizeImg
    AND
    description_image = :descrImg';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":size", $size, PDO::PARAM_INT);
    $stmt->bindValue(":descrImg", $description, PDO::PARAM_STR_CHAR);
    $stmt->execute();
    $selectedImage = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    if (!empty($selectedImage))
        return $selectedImage;
}

function insertNewAnimalIntoTable($name, $type, $puce, $sexe, $birth, $adoptionDate, $amiChien, $amiChat, $amiEnfant, $descr, $descrAdopt, $descrLocal, $engagement, $idStatut)
{
    $bdd = connectionPDO();
    $req = '
    INSERT INTO animal(nom_animal, type_animal, puce_animal, sexe, date_naissance_animal, 
    date_adoption_animal, ami_chien, ami_chat, ami_enfant, description_animal, adoption_description_animal, 
    localisation_description_animal, engagement_description_animal, id_statut) 
    VALUES (:nom, :type, :puce, :sexe, :birth, :adopted, :amiChien, :amiChat, :amiEnfant, 
    :descr, :descrAdoption, :descrLocalisation, :engagement, :statut)
    ';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":nom", $name, PDO::PARAM_STR);
    $stmt->bindValue(":type", $type, PDO::PARAM_STR);
    $stmt->bindValue(":puce", $puce, PDO::PARAM_STR);
    $stmt->bindValue(":sexe", $sexe, PDO::PARAM_STR);
    $stmt->bindValue(":birth", $birth, PDO::PARAM_STR);
    $stmt->bindValue(":adopted", $adoptionDate, PDO::PARAM_STR);
    $stmt->bindValue(":amiChien", $amiChien, PDO::PARAM_STR);
    $stmt->bindValue(":amiChat", $amiChat, PDO::PARAM_STR);
    $stmt->bindValue(":amiEnfant", $amiEnfant, PDO::PARAM_STR);
    $stmt->bindValue(":descr", $descr, PDO::PARAM_STR);
    $stmt->bindValue(":descrAdoption", $descrAdopt, PDO::PARAM_STR);
    $stmt->bindValue(":descrLocalisation", $descrLocal, PDO::PARAM_STR);
    $stmt->bindValue(":engagement", $engagement, PDO::PARAM_STR);
    $stmt->bindValue(":statut", $idStatut, PDO::PARAM_INT);
    $res = $stmt->execute();
    $stmt->closeCursor();
    if ($res > 0) {
        return true;
    } else {
        return false;
    }
}

function insertImageIntoImageTable($libelle, $url, $description, $size)
{
    $bdd = connectionPDO();
    $req = '
    INSERT INTO image(libelle_image, url_image, description_image, size_image)
    VALUES (:libelle, :url, :description, :size) 
    ';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":libelle", $libelle, PDO::PARAM_STR);
    $stmt->bindValue(":url", $url, PDO::PARAM_STR);
    $stmt->bindValue(":description", $description, PDO::PARAM_STR);
    $stmt->bindValue(":size", $size, PDO::PARAM_INT);
    $res = $stmt->execute();
    $stmt->closeCursor();
    if ($res > 0) {
        return true;
    } else {
        return false;
    }
}

function obtainIdImageByUrlAndSizeFromTable($descr, $size)
{
    $bdd = connectionPDO();
    $req = '
    SELECT id_image 
    FROM image
    WHERE 
    description_image = :descrImg
    AND 
    size_image = :sizeImg
    ';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":descrImg", $descr, PDO::PARAM_STR);
    $stmt->bindValue(":sizeImg", $size, PDO::PARAM_STR);
    $stmt->execute();
    $idImage = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $idImage;
}

function obtainIdAnimalByUrlAndSizeFromTable($nom, $type, $sexe, $description)
{
    $bdd = connectionPDO();
    $req = '
    SELECT id_animal 
    FROM animal
    WHERE 
    nom_animal = :nom
    AND 
    type_animal = :type
    AND
    sexe = :sexe
    AND
    description_animal = :description
    ';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
    $stmt->bindValue(":type", $type, PDO::PARAM_STR);
    $stmt->bindValue(":sexe", $sexe, PDO::PARAM_STR);
    $stmt->bindValue(":description", $description, PDO::PARAM_STR);
    $stmt->execute();
    $idAnimal = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $idAnimal;
}

function insertRelativeTableContient($idAnimal, $idImg)
{
    $bdd = connectionPDO();
    $req = '
    INSERT INTO contient (id_animal, id_image)
    VALUES (:idAnimal, :idImg)
    ';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);
    $stmt->bindValue(":idImg", $idImg, PDO::PARAM_INT);
    $res = $stmt->execute();
    $stmt->closeCursor();
    if ($res > 0) {
        return true;
    } else {
        return false;
    }
}

function updateAnimalIntoTable($idAnimal, $name, $type, $puce, $sexe, $birth, $adoptionDate, $amiChien, $amiChat, $amiEnfant, $descr, $descrAdopt, $descrLocal, $engagement, $idStatut)
{
    $idAnimal = (int)$idAnimal;
    $bdd = connectionPDO();
    $req = '
    UPDATE animal 
    SET nom_animal = :nom, 
    type_animal = :type, 
    puce_animal = :puce, 
    sexe = :sexe,
    date_naissance_animal = :birth,
    date_adoption_animal = :adoptionDate,
    ami_chien = :amiChien,
    ami_chat = :amiChat,
    ami_enfant = :amiEnfant,
    description_animal = :description,
    adoption_description_animal = :descrAdoption,
    localisation_description_animal = :descrLocalisation,
    engagement_description_animal = :engagement,
    id_statut = :idStatut
    WHERE id_animal = ' . (int)$idAnimal;
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":nom", $name, PDO::PARAM_STR);
    $stmt->bindValue(":type", $type, PDO::PARAM_STR);
    $stmt->bindValue(":puce", $puce, PDO::PARAM_STR);
    $stmt->bindValue(":sexe", $sexe, PDO::PARAM_STR);
    $stmt->bindValue(":birth", $birth, PDO::PARAM_STR);
    $stmt->bindValue(":adoptionDate", $adoptionDate, PDO::PARAM_STR);
    $stmt->bindValue(":amiChien", $amiChien, PDO::PARAM_STR);
    $stmt->bindValue(":amiChat", $amiChat, PDO::PARAM_STR);
    $stmt->bindValue(":amiEnfant", $amiEnfant, PDO::PARAM_STR);
    $stmt->bindValue(":description", $descr, PDO::PARAM_STR);
    $stmt->bindValue(":descrAdoption", $descrAdopt, PDO::PARAM_STR);
    $stmt->bindValue(":descrLocalisation", $descrLocal, PDO::PARAM_STR);
    $stmt->bindValue(":engagement", $engagement, PDO::PARAM_STR);
    $stmt->bindValue(":idStatut", $idStatut, PDO::PARAM_INT);
    $res = $stmt->execute();
    $stmt->closeCursor();
    if ($res > 0) {
        return true;
    } else {
        return false;
    }
}

function deleteAnimalById($idAnimal)
{
    $idAnimal = (int)$idAnimal;
    $bdd = connectionPDO();
    $req = '
    DELETE FROM animal
    WHERE id_animal = :idAnimal';
    $request = $bdd->prepare($req);
    $request->execute(array(
        'idAnimal' => $idAnimal
    ));
    return true;
}

function deleteRelativeTableContient($idAnimal)
{
    $bdd = connectionPDO();
    $req = '
    DELETE FROM contient
    WHERE
    id_animal = :idAnimal
    ';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);
    $res = $stmt->execute();
    $stmt->closeCursor();
    if ($res > 0) {
        return true;
    } else {
        return false;
    }
}

function selectRelativeIdImagesbyIdAnimal($idAnimal)
{
    $idAnimal = (int)$idAnimal;
    $bdd = connectionPDO();
    $req = '
    SELECT *
    FROM contient
    WHERE
    id_animal = :idAnimal
    ';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);
    $stmt->execute();
    $idImageRelative = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $idImageRelative;
}

function deleteImageByIdImage($idImage)
{
    $idImage = (int)$idImage;
    $bdd = connectionPDO();
    $req = '
    DELETE FROM image
    WHERE 
    id_image = :idImage
    ';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":idImage", $idImage, PDO::PARAM_INT);
    $res = $stmt->execute();
    $stmt->closeCursor();
    if ($res > 0) {
        return true;
    } else {
        return false;
    }
}

function removeRelativeTableContientDatas($idAnimal, $idImg)
{
    $idAnimal = (int)$idAnimal;
    $idImg = (int)$idImg;
    $bdd = connectionPDO();
    $req = '
    DELETE FROM contient
    WHERE 
    id_animal = :idAnimal
    AND
    id_image = :idImage
    ';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);
    $stmt->bindValue(":idImage", $idImg, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
}

function countNbreIdAnimalLinksByIdImage($idImage)
{
    $idImage = (int)$idImage;
    $bdd = connectionPDO();
    $req = '
    SELECT COUNT(id_animal) as nbre 
    FROM contient
    WHERE 
    id_image = :idImage
    ';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":idImage", $idImage, PDO::PARAM_INT);
    $stmt->execute();
    $number = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $number;
}

function verifyUploadedAnimalImage($file, $dir, $name)
{
    if (!file_exists($dir)) mkdir($dir, 0777);

    empty($file['tmp_name']) ? $file['tmp_name'] = $file : $file['tmp_name'];

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    // echo "<br>" . $extension . "<br>";
    $target_file = $dir . $name . "_" . $file['name'];
    // echo "<br>" . $target_file . "<br>";

    if (!getimagesize($file['tmp_name'])) {
        throw new Exception("Ce fichier n'est pas une image");
    }
    if (
        $extension !== "jpg" && $extension !== "JPG" && $extension !== "jpeg" && $extension !== "JPEG" &&
        $extension !== "png" && $extension !== "PNG" && $extension !== "gif" && $extension !== "GIF"
    ) {
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
