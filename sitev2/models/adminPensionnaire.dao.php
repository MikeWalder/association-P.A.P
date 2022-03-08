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
    return $selectedAnimal;
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
    WHERE id_animal = ' . $idAnimal;
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
