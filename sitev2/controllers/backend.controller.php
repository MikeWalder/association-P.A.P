<?php
require_once("config/config.php");
require_once("config/format.php");
//require_once("public/js/main.js");

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
        $lastActus = selectLastActusFromTable();
        foreach ($lastActus as $key => $actu) {
            $imageActuUrl = selectImagefromIdImage($actu['id_image']);
            $lastActus[$key]['url'] = $imageActuUrl;
        }

        if (isset($_GET['d']) && !empty($_GET['d'])) {
            $idActuDelete = Securite::secureHTML($_GET['d']);

            $imageUrlToDelete = selectImagefromIdActu($idActuDelete);
            $imgUrl = $imageUrlToDelete['url_image'];
            $repertory = 'public/content/images/website/' . $imgUrl;
            unlink($repertory);

            //$imgActu = getImageActualiteFromBDD($idActuDelete);

            if (deleteActuById($idActuDelete)) {
                deleteImageFromImageTable($imageUrlToDelete['id_image']);
                $result = displayAlert("Informations supprimées avec succès !", "alert-success");
            } else {
                $result = displayAlert("Informations non supprimées en BD", "alert-danger");
            }
?>
            <script>
                window.setTimeout(function() {
                    window.location = 'adminNews';
                }, 2500);
            </script>
            <?php
        }

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

                $imgActu = $_FILES['imgActu'];
                $repertory = "public/content/images/website/news/";
                $date = date("Y-m-d H:i:s", time());
                $imgSize = round((int)$_FILES['imgActu']['size'] / 1024);

                try {
                    $name_ImgUploaded = verifyUploadedActuImage($imgActu, $repertory, $titleActu);
                    $idImage = insertImgActuUploadedIntoBD($name_ImgUploaded, "news/" . $name_ImgUploaded, $imgSize);
                    $idImg = selectIdImageLoaded($idImage);
                    if (insertActuIntoActuTable($titleActu, $typeActu, $contentActu, $date, $idImg['id_image'])) {
                        $result = displayAlert("Informations enregistrées avec succès !", "alert-success");
            ?>
                        <script>
                            window.setTimeout(function() {
                                window.location = 'adminNews';
                            }, 5000);
                        </script>
                <?php
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

function getPageAdminModifNews()
{
    if (isset($_GET['m']) && !empty($_GET['m'])) {
        $modifIdActu = Securite::secureHTML($_GET['m']);
        if (Securite::verificationAccessSession()) {
            Securite::generateSecuredCookie();

            $title = "Modification d'une News";
            $description = "Administration des News du site P.A.P";
            require_once("models/adminNews.dao.php");

            $actuSelected = selectActuById((int)$modifIdActu);
            $imageActuSelected = getImageActualiteFromBDD((int)$modifIdActu);
            $actuTypes = selectAllActuType();

            $ada = explode(",", $actuTypes['SUBSTRING(COLUMN_TYPE,5)']);
            $ada[0] = substr($ada[0], 1);
            $k = (count($ada) - 1);
            $ada[$k] = substr($ada[$k], 0, -1);

            for ($i = 0; $i < count($ada); $i++) {
                $ada[$i] = substr($ada[$i], 0, -1);
                $ada[$i] = substr($ada[$i], 1);
            }

            if (isset($_POST['validateModifAdminNews']) && !empty($_POST['validateModifAdminNews'])) {
                if (isset($_POST['titleActu']) && isset($_POST['typeActu']) && isset($_POST['contentActu'])) {

                    $titleActu = Securite::secureHTML($_POST['titleActu']);
                    $typeActu = Securite::secureHTML($_POST['typeActu']);
                    $contentActu = Securite::secureHTML($_POST['contentActu']);

                    empty($titleActu) ? $actuSelected['libelle_actualite'] : $_POST['titleActu'];
                    empty($typeActu) ? $actuSelected['type_actualite'] : $_POST['typeActu'];
                    empty($contentActu) ? $actuSelected['contenu_actualite'] : $_POST['contentActu'];

                    if (isset($_FILES['imgActu']) && ($_FILES['imgActu']['size'] > 0)) {

                        $imgActu = $_FILES['imgActu'];
                        $repertory = "public/content/images/website/news/";
                        $date = date("Y-m-d H:i:s", time());

                        try {
                            deleteImageFromImageTable($actuSelected['id_image']);

                            $name_ImgUploaded = verifyUploadedActuImage($imgActu, $repertory, $titleActu);
                            $sizeImg = round($_FILES['imgActu']['size'] / 1024); // récuper la taille du fichier en Ko
                            $idImage = insertImgActuUploadedIntoBD($name_ImgUploaded, "news/" . $name_ImgUploaded, $sizeImg);
                            $idImg = selectIdImageLoaded($idImage);

                            if (insertActuIntoActuTable($titleActu, $typeActu, $contentActu, $date, $idImg['id_image'], (int)$modifIdActu)) {
                                $result = displayAlert("Informations enregistrées avec succès !", "alert-success");
                            } else {
                                $result = displayAlert("Informations non enregistrées en BD", "alert-danger");
                            }
                        } catch (Exception $e) {
                            $result = displayAlert("La modification de l'actualité n'a pas pu aboutir<br>" . $e->getMessage(), "alert-danger");
                        }
                    } else {
                        //$imgActu = $_FILES['imgActu'];
                        $date = date("Y-m-d H:i:s", time());
                        try {
                            if (updateActuTable($titleActu, $typeActu, $contentActu, $date, $modifIdActu)) {
                                $result = displayAlert("Informations enregistrées avec succès !", "alert-success");
                            } else {
                                $result = displayAlert("Informations non enregistrées en BD", "alert-danger");
                            }
                        } catch (Exception $e) {
                            $result = displayAlert("La modification de l'actualité n'a pas pu aboutir<br>" . $e->getMessage(), "alert-danger");
                        }
                    }
                }
                ?>
                <script>
                    displayResultAndRedirect(50000)
                </script>
<?php
            }
            require_once("views/back/adminModifNews.view.php");
        } else {
            throw new Exception("Vous n'avez pas les accès requis pour cette page");
        }
    }
}

function getPageAdminPensionnaire()
{
    if (Securite::verificationAccessSession()) {
        Securite::generateSecuredCookie();
        $title = "Administration des Pensionnaires";
        $description = "Administration des pensionnaires du site P.A.P";

        require_once("models/adminPensionnaire.dao.php");
        $lastPensionnaires = selectAllAnimals();

        require_once("views/back/adminPensionnaire.view.php");
    } else {
        throw new Exception("Vous n'avez pas les accès requis pour cette page");
    }
}

function getPageAdminAddPensionnaire()
{
    if (Securite::verificationAccessSession()) {
        Securite::generateSecuredCookie();
        $title = "Administration des Pensionnaires";
        $description = "Administration des pensionnaires du site P.A.P";

        require_once("models/adminPensionnaire.dao.php");

        require_once("views/back/adminAddPensionnaire.view.php");
    }
}

function getPageAdminModifPensionnaire()
{
    if (Securite::verificationAccessSession()) {
        Securite::generateSecuredCookie();
        $title = "Administration des Pensionnaires";
        $description = "Administration des pensionnaires du site P.A.P";

        require_once("adminPensionnaire.dao.php");
    }
}
