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
    //$txt = "<div class='alert " . $type . "' text-center 
    $txt = "<div class='col-12 alert " . $type . " text-center'>" . $text . "</div>";
    return $txt;
}
