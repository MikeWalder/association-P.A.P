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

            if (deleteActuById($idActuDelete)) {
                deleteImageFromImageTable($imageUrlToDelete['id_image']);
                $result = displayAlert("Informations supprimées avec succès !<br>Rafraîchissement de la page en cours...", "alert-success");
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
    } else {
        throw new Exception("Vous n'avez pas les accès requis pour cette page");
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
                        $result = displayAlert("Informations enregistrées avec succès !<br>Redirection en cours...", "alert-success");
                    } else {
                        $result = displayAlert("Informations non enregistrées en BD", "alert-danger");
                    }
            ?>
                    <script>
                        window.setTimeout(function() {
                            window.location = 'adminNews';
                        }, 2500);
                    </script>
                    <?php
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
                                $result = displayAlert("Informations enregistrées avec succès !<br>Redirection en cours...", "alert-success");
                            } else {
                                $result = displayAlert("Informations non enregistrées en BD<br>Redirection en cours...", "alert-danger");
                            }
                    ?>
                            <script>
                                window.setTimeout(function() {
                                    window.location = 'adminNews';
                                }, 2500);
                            </script>
                <?php
                        } catch (Exception $e) {
                            $result = displayAlert("La modification de l'actualité n'a pas pu aboutir<br>" . $e->getMessage(), "alert-danger");
                        }
                    } else {
                        //$imgActu = $_FILES['imgActu'];
                        $date = date("Y-m-d H:i:s", time());
                        try {
                            if (updateActuTable($titleActu, $typeActu, $contentActu, $date, $modifIdActu)) {
                                $result = displayAlert("Informations enregistrées avec succès !<br>Redirection en cours...", "alert-success");
                            } else {
                                $result = displayAlert("Informations non enregistrées en BD<br>Redirection....", "alert-danger");
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
        $countAnimal = countAnimalsByStatut();
        foreach ($lastPensionnaires as $key => $pensionnaire) {
            $firstImg = selectFirstImageFromIdAnimal($pensionnaire['id_animal']);
            $lastPensionnaires[$key]['image'] = $firstImg;
        }
        if (isset($_GET['d']) && !empty($_GET['d'])) {
            $idAnimal = Securite::secureHTML($_GET['d']);

            $idImages = selectRelativeIdImagesbyIdAnimal($idAnimal);

            deleteRelativeTableContient($idAnimal);

            foreach ($idImages as $key => $idImage) {
                deleteImageByIdImage($idImage['id_image']);
            }

            if (deleteAnimalById($idAnimal)) {
                $result = displayAlert("Informations supprimées avec succès !<br>Rafraîchissement de la page en cours...", "alert-success");
            } else {
                $result = displayAlert("Informations non supprimées en BD", "alert-danger");
            }
            ?>
            <script>
                window.setTimeout(function() {
                    window.location = 'adminPensionnaire';
                }, 2500);
            </script>
            <?php
        }
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

        if (isset($_POST['validateAdminPensionnaire']) && !empty($_POST['validateAdminPensionnaire'])) {
            if (
                isset($_POST['nameAnimal']) && !empty($_POST['nameAnimal']) &&
                isset($_POST['typeAnimal']) && !empty($_POST['typeAnimal']) &&
                isset($_POST['sexe']) && !empty($_POST['sexe']) &&
                isset($_POST['statut']) && !empty($_POST['statut']) &&
                isset($_POST['description_animal']) && !empty($_POST['description_animal'])
            ) {
                //Sécurisation des champs
                $nameAnimal = Securite::secureHTML($_POST['nameAnimal']);
                $typeAnimal = Securite::secureHTML($_POST['typeAnimal']);
                $sexe = Securite::secureHTML($_POST['sexe']);
                $puce = Securite::secureHTML($_POST['puce']);
                $statut = Securite::secureHTML($_POST['statut']);
                $birth = Securite::secureHTML($_POST['birthDate']);
                $adoptionDate = Securite::secureHTML($_POST['adoptionDate']);
                $amiChien = Securite::secureHTML($_POST['amiChien']);
                $amiChat = Securite::secureHTML($_POST['amiChat']);
                $amiEnfant = Securite::secureHTML($_POST['amiEnfant']);
                $descrAnimal = Securite::secureHTML($_POST['description_animal']);
                $descrAnimalAdoption = Securite::secureHTML($_POST['description_animal_adoption']);
                $localisationAnimalAdoption = Securite::secureHTML($_POST['localisation']);
                $engagement = Securite::secureHTML($_POST['engagement']);

                $imgActu1 = $_FILES['imgAnimal1'];
                $imgActu2 = $_FILES['imgAnimal2'];
                $imgActu3 = $_FILES['imgAnimal3'];
                $imgActu = [];

                $nameStatut = displayNameAnimalStatutFileByIdStatut($statut);
                $repertory = "public/content/images/website/animals/" . $nameStatut . "/";

                try {
                    if (insertNewAnimalIntoTable($nameAnimal, $typeAnimal, $puce, $sexe, $birth, $adoptionDate, $amiChien, $amiChat, $amiEnfant, $descrAnimal, $descrAnimalAdoption, $localisationAnimalAdoption, $engagement, $statut)) {
                        for ($i = 1; $i <= 3; $i++) {
                            if (${"imgActu$i"}['error'] == 0) {
                                $imgActu['size'] = round(${"imgActu$i"}['size'] / 1024);
                                $imgActu['name'] = ${"imgActu$i"}['name'];
                                $imgActu['error'] = ${"imgActu$i"}['error'];
                                $imgActu['tmp_name'] = ${"imgActu$i"}['tmp_name'];

                                $name_ImgUploaded = verifyUploadedAnimalImage($imgActu, $repertory, $nameAnimal);

                                insertImageIntoImageTable($name_ImgUploaded, "animals/" . strtolower($nameStatut) . "/" . $nameAnimal . "_" . $imgActu['name'], $imgActu['name'], $imgActu['size']);
                                $idImage = obtainIdImageByUrlAndSizeFromTable("animals/" . strtolower($nameStatut) . "/" . $nameAnimal . "_" . $imgActu['name'], $imgActu['size']);
                                $idAnimal = obtainIdAnimalByUrlAndSizeFromTable($nameAnimal, $typeAnimal, $sexe, $descrAnimal);
                                insertRelativeTableContient($idAnimal['id_animal'], $idImage['id_image']);
                            }
                        }
                        $result = displayAlert("Informations enregistrées avec succès !<br>Redirection en cours...", "alert-success");
                    } else {
                        $result = displayAlert("Informations non enregistrées en BD", "alert-danger");
                    }
            ?>
                    <script>
                        window.setTimeout(function() {
                            window.location = 'adminPensionnaire';
                        }, 2500);
                    </script>
                    <?php
                } catch (Exception $e) {
                    $result = displayAlert("La création de l'actualité n'a pas pu fonctionner<br>" . $e->getMessage(), "alert-danger");
                }
            }
        }
        require_once("views/back/adminAddPensionnaire.view.php");
    }
}

function getPageAdminModifPensionnaire()
{
    if (isset($_GET['m']) && !empty($_GET['m'])) {
        $modifIdAnimal = Securite::secureHTML($_GET['m']);
        if (Securite::verificationAccessSession()) {
            Securite::generateSecuredCookie();
            $title = "Administration des Pensionnaires";
            $description = "Administration des pensionnaires du site P.A.P";
            require_once("models/adminPensionnaire.dao.php");

            $infosAnimal = selectAnimalById($modifIdAnimal);

            $datasImg = selectImagesFromIdAnimal($infosAnimal['id_animal']);
            foreach ($datasImg as $key => $dataImg) {
            }

            if (
                isset($_POST['validateAdminModifPensionnaire']) &&
                !empty($_POST['validateAdminModifPensionnaire'])
            ) {
                if (
                    isset($_POST['nameAnimal']) && !empty($_POST['nameAnimal']) &&
                    isset($_POST['typeAnimal']) && !empty($_POST['typeAnimal']) &&
                    isset($_POST['sexe']) && !empty($_POST['sexe']) &&
                    isset($_POST['statut']) && !empty($_POST['statut']) &&
                    isset($_POST['description_animal']) && !empty($_POST['description_animal'])
                ) {

                    //Sécurisation des champs
                    $nameAnimal = Securite::secureHTML($_POST['nameAnimal']);
                    $typeAnimal = Securite::secureHTML($_POST['typeAnimal']);
                    $sexe = Securite::secureHTML($_POST['sexe']);
                    $puce = Securite::secureHTML($_POST['puce']);
                    $nbreStatut = Securite::secureHTML($_POST['statut']);
                    $birth = Securite::secureHTML($_POST['birthDate']);
                    $adoptionDate = Securite::secureHTML($_POST['adoptionDate']);
                    $amiChien = Securite::secureHTML($_POST['amiChien']);
                    $amiChat = Securite::secureHTML($_POST['amiChat']);
                    $amiEnfant = Securite::secureHTML($_POST['amiEnfant']);
                    $descrAnimal = Securite::secureHTML($_POST['description_animal']);
                    $descrAnimalAdoption = Securite::secureHTML($_POST['description_animal_adoption']);
                    $localisationAnimalAdoption = Securite::secureHTML($_POST['localisation_animal_adoption']);
                    $engagement = Securite::secureHTML($_POST['engagement']);

                    $imgAnimal1 = $_FILES['imgAnimal1'];
                    $imgAnimal2 = $_FILES['imgAnimal2'];
                    $imgAnimal3 = $_FILES['imgAnimal3'];

                    $statut = displayNameAnimalStatutFileByIdStatut($nbreStatut);

                    $repertory = "public/content/images/website/animals/" . $statut . "/";
                    //echo "le statut actuel est de " . $nbreStatut . '<br>';

                    $idImagesRelativeTable = selectRelativeIdImagesbyIdAnimal($modifIdAnimal);

                    if (empty($idImagesRelativeTable)) {
                        for ($i = 1; $i <= 3; $i++) {
                            $idImagesRelativeTable[$i - 1]['id_image'] = '';
                            $imgDatas[$i] = selectImageById($idImagesRelativeTable[$i - 1]['id_image']);

                            if ($imgDatas[$i] == null && (${"imgAnimal$i"}['error'] == 0 && ${"imgAnimal$i"}['size'] > 0)) {
                                $imgAnimal['size'] = round(${"imgAnimal$i"}['size'] / 1024);
                                $imgAnimal['name'] = ${"imgAnimal$i"}['name'];
                                $imgAnimal['error'] = ${"imgAnimal$i"}['error'];
                                $imgAnimal['tmp_name'] = ${"imgAnimal$i"}['tmp_name'];

                                $name_ImgUploaded = verifyUploadedAnimalImage(${"imgAnimal$i"}, $repertory, $nameAnimal);

                                insertImageIntoImageTable($name_ImgUploaded, "animals/" . strtolower($statut) . "/" . $nameAnimal . "_" . $imgAnimal['name'], $imgAnimal['name'], $imgAnimal['size']);
                                $idImage = obtainIdImageByUrlAndSizeFromTable("animals/" . strtolower($statut) . "/" . $nameAnimal . "_" . $imgAnimal['name'], $imgAnimal['size']);
                                insertRelativeTableContient($infosAnimal['id_animal'], $idImage['id_image']);

                                if (updateAnimalIntoTable($infosAnimal['id_animal'], $nameAnimal, $typeAnimal, $puce, $sexe, $birth, $adoptionDate, $amiChien, $amiChat, $amiEnfant, $descrAnimal, $descrAnimalAdoption, $localisationAnimalAdoption, $engagement, $nbreStatut)) {
                                    $result = displayAlert("Informations enregistrées avec succès !<br>Redirection en cours...", "alert-success");
                                } else {
                                    $result = displayAlert("Informations non enregistrées en BD", "alert-danger");
                                }
                    ?>
                                <script>
                                    /* window.setTimeout(function() {
                                        window.location = 'adminPensionnaire';
                                    }, 2500); */
                                </script>
                                <?php
                            }
                        }
                    } else {
                        for ($i = 1; $i <= 3; $i++) {
                            if (!empty($datasImg[$i - 1]) && !empty(${"imgAnimal$i"}['name'])) {
                                $urlInputFile = "animals/" . displayNameAnimalStatutFileByIdStatut($infosAnimal['id_statut']) . "/" . $infosAnimal['nom_animal'] . "_" . ${"imgAnimal$i"}['name'];
                                if (($datasImg[$i - 1]['url_image'] === $urlInputFile) && $datasImg[$i - 1]['size_image'] == round(${"imgAnimal$i"}['size'] / 1024)) {
                                    $result = displayAlert("Les images sont identiques", "alert-danger");
                                    if (updateAnimalIntoTable($infosAnimal['id_animal'], $nameAnimal, $typeAnimal, $puce, $sexe, $birth, $adoptionDate, $amiChien, $amiChat, $amiEnfant, $descrAnimal, $descrAnimalAdoption, $localisationAnimalAdoption, $engagement, $nbreStatut)) {
                                        $result = displayAlert("Informations modifiées avec succès !<br>Redirection en cours...", "alert-success");
                                ?>
                                        <script>
                                            window.setTimeout(function() {
                                                window.location = 'adminPensionnaire';
                                            }, 2500);
                                        </script>
                                    <?php }
                                } else if (($datasImg[$i - 1]['url_image'] !== $urlInputFile) && $datasImg[$i - 1]['size_image'] !== 0) {
                                    // Ici traitement de l'upload de la nouvelle image :
                                    // 1) supprimer l'id image actuelle pour id animal du pensionnaire dans la table "contient"
                                    // 2) compter le nombre de fois où l'id de l'image actuelle est présente dans "contient" :
                                    // a) Si count(id) == 0 : supprimer l'image dans la table image (DELETE)
                                    // b) Sinon : ne rien faire
                                    // 3) vérifier si la nouvelle image n'est pas déjà présente dans la table image (size et description) :
                                    // a) si déjà présent : ne pas uploader, juste insérer un lien dans la table "contient"
                                    // b) si non présente : uploader l'image puis rajouter le lien dans la table "contient"

                                    echo "Cet id image numéro : " . $datasImg[$i - 1]['id_image'] . ' est à supprimer du pensionnaire ' . $infosAnimal['id_animal'] . '<br>';
                                    removeRelativeTableContientDatas($infosAnimal['id_animal'], $datasImg[$i - 1]['id_image']);
                                    $countImg = countNbreIdAnimalLinksByIdImage($datasImg[$i - 1]['id_image']);

                                    print_r($countImg[0]['nbre']);
                                    if ($countImg[0]['nbre'] == 0) {
                                        deleteImageByIdImage($datasImg[$i - 1]['id_image']);
                                        insertImageIntoImageTable($datasImg[$i - 1]['libelle_image'], $datasImg[$i - 1]['url_image'], $datasImg[$i - 1]['description_image'], $datasImg[$i - 1]['size_image']);
                                    }
                                    // ici vérification si la nouvelle image n'est pas déjà présente (à venir) 


                                    if (updateAnimalIntoTable($infosAnimal['id_animal'], $nameAnimal, $typeAnimal, $puce, $sexe, $birth, $adoptionDate, $amiChien, $amiChat, $amiEnfant, $descrAnimal, $descrAnimalAdoption, $localisationAnimalAdoption, $engagement, $nbreStatut)) {
                                        echo "tout est updaté";
                                    }
                                    echo "Les deux fichiers sont différents donc l'upload est en cours...<br>";
                                    //echo $datasImg[$i - 1]['url_image'] . ' - ' . $urlInputFile . '<br>';
                                }
                            } else if (empty($datasImg[$i - 1]) && !empty(${"imgAnimal$i"}['name'])) {

                                echo "Nous allons uploader cette image dans ce champ vide<br>";
                                echo '<h3>' . ${"imgAnimal$i"}['name'] . '</h3>';
                                $test = obtainIdImageByUrlAndSizeFromTable(${"imgAnimal$i"}['name'], round(${"imgAnimal$i"}['size'] / 1024));
                                print_r($test);
                                if ($test[0]['id_image'] == 0) {
                                    insertImageIntoImageTable($name_ImgUploaded, "animals/" . strtolower($statut) . "/" . $nameAnimal . "_" . ${"imgAnimal$i"}['name'], ${"imgAnimal$i"}['name'], ${"imgAnimal$i"}['size']);
                                    $idNewImage = obtainIdImageByUrlAndSizeFromTable(${"imgAnimal$i"}['name'], round(${"imgAnimal$i"}['size'] / 1024));
                                    insertRelativeTableContient((int)$modifIdAnimal, $idNewImage['id_image']);
                                }
                            } else if (!empty($datasImg[$i - 1]) && empty(${"imgAnimal$i"}['name'])) {
                                echo "Aucun fichier n'est à uploader <br>";
                                $isImageInTable = obtainIdImageByUrlAndSizeFromTable($datasImg[$i - 1]['description_image'], $datasImg[$i - 1]['size_image']);
                                if (empty($isImageInTable)) {
                                    insertImageIntoImageTable($datasImg[$i - 1]['libelle_image'], $datasImg[$i - 1]['url_image'], $datasImg[$i - 1]['description_image'], round(${"imgAnimal$i"}['size'] / 1024));
                                }
                                if (updateAnimalIntoTable($infosAnimal['id_animal'], $nameAnimal, $typeAnimal, $puce, $sexe, $birth, $adoptionDate, $amiChien, $amiChat, $amiEnfant, $descrAnimal, $descrAnimalAdoption, $localisationAnimalAdoption, $engagement, $nbreStatut)) {
                                    $result = displayAlert("Informations modifiées avec succès !<br>Redirection en cours...", "alert-success");
                                    ?>
                                    <script>
                                        /* window.setTimeout(function() {
                                            window.location = 'adminPensionnaire';
                                        }, 2500); */
                                    </script>
<?php
                                }
                            }
                        }
                    }
                }
            }
            require_once("views/back/adminModifPensionnaire.view.php");
        }
    }
}
