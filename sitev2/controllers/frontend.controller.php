<?php
require_once("config/config.php");
require_once("config/format.php");

function getPagePensionnaires()
{
    require_once("models/pensionnaires.dao.php");

    $title = "Page des pensionnaires";
    $description = "Affichage et description des pensionnaires de l'association P.A.P";
    if (isset($_GET['idstatut']) && !empty($_GET['idstatut'])) {
        $idStatut = Securite::secureHTML($_GET['idstatut']);
        $animaux = selectAnimalsFromStatut($idStatut);

        function mainTitlePensionnaire($val)
        {
            $mainTitle = "";
            if ($val === TO_ADOPT) {
                $mainTitle = "Ils cherchent une famille";
            } else if ($val === IS_ADOPTED) {
                $mainTitle = "Les anciens";
            } else if ($val === FALD) {
                $mainTitle = "Famille d'accueil longue durée";
            }
            return $mainTitle;
        }

        $text = mainTitlePensionnaire(Securite::secureHTML($_GET['idstatut']));

        foreach ($animaux as $key => $animal) {
            $image = selectFirstImageFromIdAnimal($animal['id_animal']);
            $animaux['image'] = $image;

            $caracteres = selectCaracteresFromIdAnimal($animal['id_animal']);
            $animaux[$key]['caracteres'] = $caracteres;
        }
        require_once("views/front/pensionnaires.view.php");
    } else {
        throw new Exception("Erreur ! L'id de statut n'est pas renseigné, vous ne pouvez donc pas accéder à la page.");
    }
}

function getPageAccueil()
{
    require_once("models/accueil.dao.php");

    $title = "Page d'accueil";
    $description = "Page d'accueil de l'association";

    $animaux = selectAnimalsFromStatut(TO_ADOPT);
    $lastNews = getLastNewsPlusImageFromBDD();


    foreach ($animaux as $key => $animal) {
        $images = selectImagesFromAnimal($animal['id_animal']);
        $animaux[$key]['image'] = $images;
        $lastNews = getLastNewsPlusImageFromBDD();
        $animaux[$key]['actuNews'] = $lastNews;
        $lastActionOrEvent = getLastActionOrEvent();
        $animaux[$key]['actuActionOrNews'] = $lastActionOrEvent;
    }
    require_once("views/front/accueil.view.php");
}

function getPageAssociation()
{
    $title = "Présentation de l'association";
    $description = "Description générale de l'association Pattes à Pouffes";
    require_once("views/front/association/association.view.php");
}

function getPagePartenaires()
{
    $title = "Nos partenaires";
    $description = "Partenaires en collaboration et en soutien de notre association.";
    require_once("views/front/association/partenaires.view.php");
}

function getPageActus()
{

    $title = "Actualités";
    $description = "Actualités de l'association Pattes à Pouffes";

    if (isset($_GET['type']) && !empty($_GET['type'])) {
        $typeActus = Securite::secureHTML($_GET['type']);
        require_once("models/actus.dao.php");
        $actualites = getActusFromBDD($typeActus);
        foreach ($actualites as $key => $actualite) {
            $image = getImageActualiteFromBDD($actualite['id_image']);
            $actualites[$key]['image'] = $image;
        }
    } else {
        throw new Exception("Le type d'acualité n'est pas renseigné, ous ne pouvez pas accéder à la page.");
    }
    require_once("views/front/actus/actus.view.php");
}

function getPageTemperature()
{
    $title = "Alerte températures";
    $description = "Les dangers de la températures sur les animaux de compagnie";
    require_once("views/front/articles/temperatures.view.php");
}

function getPageChocolat()
{
    $title = "Effets du chocolat";
    $description = "Les effets néfastes du chocolat sur la santé des animaux de compagnie";
    require_once("views/front/articles/chocolat.view.php");
}

function getPagePlantes()
{
    $title = "Les plantes nocives";
    $description = "Liste des plantes nocives à votre animal de compagnie";
    require_once("views/front/articles/plantes.view.php");
}

function getPageSterilisation()
{
    $title = "La stérilisation";
    $description = "Informations importantes et avantages de la stérilisation de vos animaux de compagnie";
    require_once("views/front/articles/sterilisation.view.php");
}

function getPageEducateur()
{
    $title = "Educateur canin";
    $description = "Informations utiles sur notre éducateur canin";
    require_once("views/front/articles/educateur.view.php");
}

function getPageContact()
{
    $title = "Nos contacts";
    $description = "Nos informations de contact permettant de nous trouver";
    require_once("views/front/contact/contact.view.php");
}

function getPageDons()
{
    $title = "Donnations";
    $description = "Notre page de soutien financier à l'association Pattes à Pouffes";
    require_once("views/front/contact/dons.view.php");
}

function getPageMentions()
{
    $title = "Mentions légales";
    $description = "Mentions légales du site web de l'association";
    require_once("views/front/contact/mentions.view.php");
}

function getPageAnimal()
{
    require_once("models/animal.dao.php");
    if (isset($_GET['id_animal']) && !empty($_GET['id_animal'])) {
        $idAnimal = Securite::secureHTML($_GET['id_animal']);
        $animal = getAnimalFromId($idAnimal);
        $title = "La page de " . $animal['nom_animal'];
        $description = "Descriptif de " . $animal['nom_animal'];
        $images = selectImagesFromAnimal(Securite::secureHTML($idAnimal));
        $caracteres = selectCaracteresFromAnimal(Securite::secureHTML($idAnimal));

        require_once("views/front/animal.view.php");
    } else {
        throw new Exception("Erreur ! L'id de l'animal n'est pas spécifié");
    }
}
