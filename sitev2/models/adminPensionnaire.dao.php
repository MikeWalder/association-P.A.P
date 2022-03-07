<?php
require_once("bdd/functions.php");


function selectAllAnimals()
{
    $bdd = connectionPDO();
    $req = 'SELECT * FROM animal';
    $stmt = $bdd->prepare($req);
    $stmt->execute();
    $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor(); // libère la connexion au serveur permettant ainsi à d'autres requêtes d'être exécutées
    return $animaux;
}
