<?php
require_once("bdd/functions.php");

function getAnimalFromId($idAnimal)
{
    $bdd = connectionPDO();
    $req = 'SELECT * FROM animal WHERE id_animal = :idAnimal';

    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);
    $stmt->execute();
    $animal = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $animal;
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

function selectCaracteresFromAnimal($idAnimal)
{
    $bdd = connectionPDO();
    $stmt = $bdd->prepare('
    SELECT c.libelle_caractere_m, c.libelle_caractere_f 
    FROM caractere c 
    INNER JOIN dispose d ON d.id_caractere = c.id_caractere 
    INNER JOIN animal a ON a.id_animal = d.id_animal 
    WHERE a.id_animal = :idAnimal 
    ');
    $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);
    $stmt->execute();
    $caracteres = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $caracteres;
}
