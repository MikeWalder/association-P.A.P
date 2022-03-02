<?php
require_once("bdd/functions.php");

function getPasswordFromLogin($login)
{
    $bdd = connectionPDO();
    $req = '
    SELECT * 
    FROM administration 
    WHERE login = :login';
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":login", $login, PDO::PARAM_STR);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor(); // libère la connexion au serveur permettant ainsi à d'autres requêtes d'être exécutées
    return $admin;
}


function isConnexionValidated($user, $password)
{
    $admin = getPasswordFromLogin($user);
    if (!empty($admin)) {

        if (password_verify($password, $admin['password'])) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
