<?php

function styleTitleLevel1($title, $color)
{
    $txt = "<div class='h1 text-center my-3 perso_policeTitle perso_textShadow " . $color . "'>";
    $txt .= $title;
    $txt .= "</div>";
    return $txt;
}

function styleTitleLevel2($title, $color)
{
    $txt = "<div class='h2 text-center my-3 perso_policeTitle perso_textShadow " . $color . "'>";
    $txt .= $title;
    $txt .= "</div>";
    return $txt;
}

function styleTitleLevel3($title, $color, $position)
{
    $txt = "<div class='h3 " . $position . " my-3 perso_policeTitle perso_textShadow " . $color . "'>";
    $txt .= $title;
    $txt .= "</div>";
    return $txt;
}

function styleTitlePost($text)
{
    $txt = "<div class='h2 mt-5 mb-3 perso_policeTitle perso_textShadow border-bottom border-dark'>";
    $txt .= $text;
    $txt .= "</div>";
    return $txt;
}

function previewArticle($text, $number)
{

    $previewText = "";
    $text = strip_tags($text);
    $previewText = substr($text, 0, $number);
    return $previewText;
}

function displayAlert($text, $type)
{
    $txt = "<div class='col-12 spinner-border alert " . $type . " text-center' role='status'>";
    $txt .= "<span class='sr-only'>Loading...</span>" . $text . "</div>";
    return $txt;
}

function displayColorActuFromType($typeActu)
{
    switch ($typeActu) {
        case "Action":
            return "perso_bgGreen";
            break;
        case "Event":
            return "perso_bgPink";
            break;
        case "News":
            return "perso_bglightBlue";
            break;
        default:
            return "perso_bgGreen";
    }
}

function displayColorAnimalByStatut($statut)
{
    switch ((int)$statut) {
        case 1:
            return "perso_bgGreen";
            break;
        case 2:
            return "perso_bgPink";
            break;
        case 3:
            return "perso_bglightBlue";
            break;
        case 4:
            return "bg-secondary";
            break;
        default:
            return "perso_bgGreen";
    }
}
