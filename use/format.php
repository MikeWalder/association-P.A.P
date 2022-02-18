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

function styleTitleLevel3($title, $color)
{
    $txt = "<div class='h3 text-center my-3 perso_policeTitle perso_textShadow " . $color . "'>";
    $txt .= $title;
    $txt .= "</div>";
    return $txt;
}
