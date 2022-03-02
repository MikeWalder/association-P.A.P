<?php
session_start();
require_once("controllers/frontend.controller.php");
require_once("controllers/backend.controller.php");
require_once("config/Securite.class.php");

try {
    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $page = Securite::secureHTML($_GET['page']);
        switch ($page) {
            case "accueil":
                getPageAccueil();
                break;
            case "pensionnaires":
                getPagePensionnaires();
                break;
            case "association":
                getPageAssociation();
                break;
            case "partenaires":
                getPagePartenaires();
                break;
            case "actus":
                getPageActus();
                break;
            case "temperatures":
                getPageTemperature();
                break;
            case "chocolat":
                getPageChocolat();
                break;
            case "plantes":
                getPagePlantes();
                break;
            case "sterilisation":
                getPageSterilisation();
                break;
            case "educateur":
                getPageEducateur();
                break;
            case "contact":
                getPageContact();
                break;
            case "dons":
                getPageDons();
                break;
            case "mentions":
                getPageMentions();
                break;
            case "animal":
                getPageAnimal();
                break;
            case "login":
                getPageLogin();
                break;
            case "admin":
                getPageAdmin();
                break;
            case "error301":
            case "error302":
            case "error400":
            case "error401":
            case "error402":
            case "error405":
            case "error500":
            case "error505":
                throw new Exception("Erreur de type : " . $page);
                break;
            case "error403":
                throw new Exception("Vous n'avez pas le droit d'accéder à ce dossier");
                break;
            case "error404":
            default:
                throw new Exception("La page demandée n'existe pas");
        }
    } else {
        getPageAccueil();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require_once("views/erreur.view.php");
}
