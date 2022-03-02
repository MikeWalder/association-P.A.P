<?php
require_once("config/config.php");
require_once("config/format.php");

function getPageLogin()
{
    $title = "Login administrateur";
    $description = "Formulaire de connection à la partie administrative du site.";

    require_once("models/login.dao.php");

    if (Securite::verificationAccessSession() && Securite::cookieVerification()) {
        header("Location: admin");
    }

    $alert = "";

    if (Securite::verificationLoginAndPassword()) {
        $login = Securite::secureHTML($_POST['login']);
        $password = Securite::secureHTML($_POST['password']);

        if (isConnexionValidated($login, $password)) {
            $_SESSION['access'] = "admin";
            Securite::generateSecuredCookie();
            header("Location: admin");
        } else {
            $alert = "Accès refusé";
        }
    }

    require_once("views/back/login.view.php");
}

function getPageAdmin()
{
    if (isset($_POST['deconnection']) && $_POST['deconnection'] == "true") {
        session_destroy();
        header("Location: accueil");
    }

    if (Securite::verificationAccessSession()) {
        Securite::generateSecuredCookie();
        $title = "Partie administrateur";
        $description = "Administration du site P.A.P";
        require_once("views/back/admin.view.php");
    } else {
        throw new Exception("Vous n'avez pas les accès requis pour cette page");
    }
}
