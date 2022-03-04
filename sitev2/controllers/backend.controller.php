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

function getPageAdminNews()
{
    if (Securite::verificationAccessSession()) {
        Securite::generateSecuredCookie();

        $title = "Administration des News";
        $description = "Administration des News du site P.A.P";

        require_once("models/adminNews.dao.php");

        require_once("views/back/adminNews.view.php");
    }
}

function getPageAdminAddNews()
{
    if (Securite::verificationAccessSession()) {
        Securite::generateSecuredCookie();
        $title = "Administration des News";
        $description = "Administration des News du site P.A.P";

        require_once("models/adminNews.dao.php");

        $actuTypes = selectAllActuType();

        $ada = explode(",", $actuTypes['SUBSTRING(COLUMN_TYPE,5)']);
        $ada[0] = substr($ada[0], 1);
        $k = (count($ada) - 1);
        $ada[$k] = substr($ada[$k], 0, -1);

        for ($i = 0; $i < count($ada); $i++) {
            $ada[$i] = substr($ada[$i], 0, -1);
            $ada[$i] = substr($ada[$i], 1);
        }

        if (isset($_POST['validateAdminNews']) && !empty($_POST['validateAdminNews'])) {
            if (
                isset($_POST['titleActu']) && !empty($_POST['titleActu']) &&
                isset($_POST['typeActu']) && !empty($_POST['typeActu']) &&
                isset($_POST['contentActu']) && !empty($_POST['contentActu'])
            ) {
                $titleActu = Securite::secureHTML($_POST['titleActu']);
                $typeActu = Securite::secureHTML($_POST['typeActu']);
                $contentActu = Securite::secureHTML($_POST['contentActu']);
                /* echo "<pre";
                print_r($_FILES['imgActu']);
                echo "</pre>"; */
                $imgActu = $_FILES['imgActu'];
                $repertory = "public/content/images/website/news/";
                $date = date("Y-m-d H:i:s", time());

                try {
                    $name_ImgUploaded = verifyUploadedActuImage($imgActu, $repertory, $titleActu);
                    $idImage = insertImgActuUploadedIntoBD($name_ImgUploaded, "news/" . $name_ImgUploaded);
                    $idImg = selectIdImageLoaded($idImage);
                    if (insertActuIntoActuTable($titleActu, $typeActu, $contentActu, $date, $idImg['id_image'])) {

                        $result = displayAlert("Informations enregistrées avec succès !", "alert-success");
                    } else {
                        $result = displayAlert("Informations non enregistrées en BD", "alert-danger");
                    }
                } catch (Exception $e) {
                    $result = displayAlert("La création de l'actualité n'a pas pu fonctionner<br>" . $e->getMessage(), "alert-danger");
                }
            }
        }

        require_once("views/back/adminAddNews.view.php");
    } else {
        throw new Exception("Vous n'avez pas les accès requis pour cette page");
    }
}

function getPageAdminPensionnaire()
{
    if (Securite::verificationAccessSession()) {
        Securite::generateSecuredCookie();
        $title = "Administration des Pensionnaires";
        $description = "Administration des pensionnaires du site P.A.P";

        require_once("views/back/adminPensionnaire.view.php");
    } else {
        throw new Exception("Vous n'avez pas les accès requis pour cette page");
    }
}
