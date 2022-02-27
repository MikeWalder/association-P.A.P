<?php
// Constantes permettant de fdéfinir chaque couleur des titres principaux
const COLOR_TITLE_ASSO = "perso_headerAsso";
const COLOR_TITLE_PENSIONNAIRES = "perso_headerPensionnaires";
const COLOR_TITLE_ACTUS = "perso_headerActus";
const COLOR_TITLE_CONSEILS = "perso_headerConseils";
const COLOR_TITLE_CONTACT = "perso_headerContacts";

//Statuts
const TO_ADOPT = "1";
const IS_ADOPTED = "2";
const FALD = "3";
const IS_DEAD = "4";

//Actualités
const TYPE_NEWS = "News";
const TYPE_ACTION = "Action";
const TYPE_EVENT = "Event";

define("URL", str_replace("index.php", "", (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
