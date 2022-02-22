<?php
require_once("../../views/header.php");
require_once("../../config/config.php");
require_once("format.php");
?>

<?= styleTitleLevel1("Association Pattes à Pouffes (P.A.P.)<br>Centre Alsace", COLOR_TITLE_ASSO) ?>

<div class="row align-items-center mt-3 mt-lg-5">
    <div class="col-12 col-lg-3 text-center">
        <img class="img-fluid" src="../../content/images/Animals/loulou.jpg" alt="Loulou">
    </div>
    <div class="col-12 col-lg-9 h4">
        Notre association recueille des animaux placés en adoption au sein de familles d'accueil.<br>
        Ils bénéficient de tous les soins nécessaires jusqu'à leur adoption.<br>
        Nous mettons aussi en place des actions de stérilisation féline pour limiter leur population.
    </div>
</div>

<hr>

<?= styleTitleLevel2("Notre équipe", COLOR_TITLE_ASSO) ?>

<div class="row align-items-center mt-3 mb-3">
    <div class="col-12 col-lg-3 text-center">
        <img class="img-fluid" src="../../content/images/Others/team.jpg" alt="Loulou">
    </div>
    <div class="col-12 col-lg-9">
        <span class="badge badge-primary">Directeur</span> : Franck Pierrat<br>
        <span class="badge badge-success">Trésorier</span> : Patrick Ladurret<br>
        <span class="badge badge-warning">Secrétaire</span> : Louise Genest<br>
        <span class="badge badge-danger">Secrétaire adjoint</span> : Mike Werlat<br>
        <span class="badge badge-info">Educatrice canin</span> : Floriane Calmet<br>
        <br>
        <span class="badge badge-danger">Mascotte</span> : Thanos<br>
    </div>
</div>

<?php
require_once("../../views/footer.php");
?>