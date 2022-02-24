<?php
require_once("config/config.php");
require_once("config/format.php");

function getPagePensionnaires()
{
    require_once("models/pensionnaires.dao.php");

    $title = "Page des pensionnaires";
    $description = "Affichage et description des pensionnaires de l'association P.A.P";

    $animaux = selectAnimalsFromStatut($_GET['idstatut']);

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

    $text = mainTitlePensionnaire($_GET['idstatut']);

    foreach ($animaux as $key => $animal) {
        $image = selectFirstImageFromIdAnimal($animal['id_animal']);
        $animaux[$key]['image'] = $image;

        $caracteres = selectCaracteresFromIdAnimal($animal['id_animal']);
        $animaux[$key]['caracteres'] = $caracteres;
    }
    require_once("views/front/pensionnaires.view.php");
}

function getPageAccueil()
{
    $title = "Page d'accueil";
    $description = "Page d'accueil de l'association";

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

    $animal = getAnimalFromId($_GET['id_animal']);
    $title = "La page de " . $animal['nom_animal'];
    $description = "Descriptif de " . $animal['nom_animal'];
    $images = selectImagesFromAnimal($_GET['id_animal']);
    $caracteres = selectCaracteresFromAnimal($_GET['id_animal']);

    require_once("views/front/animal.view.php");
}
