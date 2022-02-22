<?php
require_once("../../views/header.php");
require_once("../../config/config.php");
require_once("../format.php");
?>

<?= styleTitleLevel1("Donnations", COLOR_TITLE_CONTACT) ?>

<?= styleTitleLevel3("Pourquoi faire un don ?", COLOR_TITLE_CONTACT, "text-left") ?>
<span class="mt-3 font-weight-bold">Les dons nous permettent de réaliser de nombreuses actions :</span><br><br>
<ul>
    <li>
        prendre en charge des animaux abandonnés/maltraités/trouvés : chiens, chats,
        ou tous autres types d'animaux au fur et à mesure de l'évolution de l'association ;
    </li>
    <li>
        aider à la réorientation vers différentes associations pour d'autres espèces ;
    </li>
    <li>
        accueillir au sein de familles d'accueil, en pension ou en refuge « ami » ;
    </li>
    <li>
        prendre en charge leur mise à jour, leurs soins et leur rééducation si nécessaire ;
    </li>
    <li>
        rechercher des adoptants et suivre les animaux dans leurs futurs foyers ;
    </li>
    <li>
        pouvoir contracter des partenariats fourrière ;
    </li>
    <li>
        amener une aide en faveur des animaux des personnes les plus démunies ;
    </li>
    <li>
        partciper à la sensibilisaton de la cause animale auprès de l'opinion publique et du jeune public ;
    </li>
    <li>
        organiser des manifestatons en rapport avec le but de l'association ;
    </li>
    <li>
        soutenir et conduire toute action visant au respect et à la défense des animaux ;
    </li>
    <li>
        regrouper et fédérer des individus, associations ou refuges oeuvrant dans ces buts ;
    </li>
    <li>
        travailler en collaboration avec les vétérinaires et les municipalités / collectivités pour l’éducaton citoyenne
        à la stérilisation, l’identification, la nourriture des chats libres, et la protection des animaux ;
    </li>
    <li>
        organiser des campagnes de stérilisation pour les chats errants, marquage des chats sauvages
        puis les relâcher dans leur environnement en assurant ensuite le suivi sanitaire.
    </li>
</ul>

<hr>

<?= styleTitleLevel3("Faire un don à l'association", COLOR_TITLE_CONTACT, "text-left") ?>
<div class="alert alert-warning">
    Les donations faites directement via le site internet ne sont pas encore disponibles.
</div>
<div class="ml-3 my-2">
    Pour faire une <span class="badge badge-warning">donation de bien</span>, vous pouvez utiliser le
    <span class="badge badge-primary">formulaiure de contact</span> pour nous contacter.
    <br><br>
    Pour une <span class="badge badge-warning">donation financière</span>, vous pouvez nous adresser un chèque à l'association :
    <div class="text-center">
        Association Pattes A Pouffes<br>
        Centre Alsace<br>
        67600 Ebersheim, Bas-Rhin, France<br>
    </div>
    Vous avez une <span class="badge badge-warning">question</span>, contactez-nous par téléphone ou par mail :
    <div class="row align-items-center">
        <div class="col-6 text-center">
            <span class="font-weight-bold"><i class="fas fa-phone"></i>&nbsp;06 24 12 03 35</span>
        </div>
        <div class="col-6 text-center">
            <div class="btn btn-success btn-lg">
                <i class="fas fa-at"></i>&nbsp;Nous contacter
            </div>
        </div>
    </div>
</div>

<?php
require_once("../../views/footer.php");
?>