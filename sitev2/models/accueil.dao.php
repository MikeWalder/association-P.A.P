<?php
require_once("bdd/functions.php");

function selectAnimalsFromStatut($idStatut)
{
    $bdd = connectionPDO();
    $req = 'SELECT * FROM animal WHERE id_statut = :idstatut';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":idstatut", $idStatut, PDO::PARAM_INT);
    $stmt->execute();
    $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor(); // libère la connexion au serveur permettant ainsi à d'autres requêtes d'être exécutées
    return $animaux;
}

function selectImagesFromAnimal($idAnimal)
{
    $bdd = connectionPDO();
    $stmt = $bdd->prepare('
    SELECT i.id_image, url_image, libelle_image, description_image 
    FROM image i 
    INNER JOIN contient c ON i.id_image = c.id_image 
    INNER JOIN animal a ON a.id_animal = c.id_animal 
    WHERE a.id_animal= :idAnimal 
    ');
    $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);
    $stmt->execute();
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $images;
}

function getLastNewsPlusImageFromBDD()
{
    $bdd = connectionPDO();
    $stmt = $bdd->prepare('
    SELECT *
    FROM actualite a 
    INNER JOIN image i 
    ON a.id_image = i.id_image
    WHERE type_actualite = :typeActualite
    ORDER BY date_publication_actualite
    DESC
    LIMIT 1
    ');
    $stmt->bindValue(":typeActualite", TYPE_NEWS, PDO::PARAM_STR);
    $stmt->execute();
    $actuNews = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $actuNews;
}

function getLastActionOrEvent()
{
    $bdd = connectionPDO();
    $stmt = $bdd->prepare('
    SELECT *
    FROM actualite a 
    INNER JOIN image i 
    ON a.id_image = i.id_image
    WHERE type_actualite = :typeAction OR type_actualite = :typeEvent
    ORDER BY date_publication_actualite
    DESC
    ');
    $stmt->bindValue(":typeAction", TYPE_ACTION, PDO::PARAM_STR);
    $stmt->bindValue(":typeEvent", TYPE_EVENT, PDO::PARAM_STR);
    $stmt->execute();
    $lastActionOrEvent = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $lastActionOrEvent;
}
