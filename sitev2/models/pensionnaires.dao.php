<?php
require_once("bdd/functions.php");

function selectAnimalsFromStatut($idStatut)
{
    $bdd = connectionPDO();
    $req = 'SELECT * FROM animal WHERE id_statut = :idstatut';
    if ($_GET['idstatut'] === IS_ADOPTED) {
        $req .= ' OR id_statut = ' . IS_DEAD;
    }
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":idstatut", $idStatut, PDO::PARAM_INT);
    $stmt->execute();
    $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor(); // libère la connexion au serveur permettant ainsi à d'autres requêtes d'être exécutées
    return $animaux;
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

function selectCaracteresFromIdAnimal($idAnimal)
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
