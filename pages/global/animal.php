<?php
require_once("../common/header.php");
require_once("../../use/config.php");
require_once("../../use/format.php");
?>

<?= styleTitleLevel1("Félix", COLOR_TITLE_PENSIONNAIRES) ?>
<div class="row no-gutters align-items-center mt-3 border border-dark">
    <div class="col-4 col-md-3">
        <img class="img-fluid img-thumbnail" src="../../content/images/Animals/chat3.jpg" style="max-height: 220px;">
    </div>
    <div class="col-2 col-md-1 border-left border-right border-dark text-center">
        <!-- icones -->
        <img src="../../content/images/Others/icons/dog.png" class="mb-2" style="height: 50px;" alt="Dog OK">
        <img src="../../content/images/Others/icons/cat.png" class="my-2" style="height: 50px;" alt="Cat OK">
        <img src="../../content/images/Others/icons/baby.png" class="mt-2" style="height: 50px;" alt="Baby OK">
    </div>
    <div class="col-4col-md-3 text-center">
        <!-- informations -->
        <div class="font-weight-bold h3 mt-2">
            Félix
        </div>
        <div class="h4">
            02 / 12 / 2019
        </div>
        <div class="d-none d-sm-inline font-weight-bold h4 ml-3">
            <div class="badge badge-warning">Joueur</div>
            <div class="badge badge-warning">Câlin</div>
            <div class="badge badge-warning">Avenant</div>
        </div>
    </div>
    <div class="d-none d-lg-block col-lg-1"></div>
    <div class="col-12 col-md-4 mt-3 mt-md-0">
        En général les frais d'adoption sont les suivants :<br>
        Frais d'adoption : 65€ + 35€ (vaccins, sur demande)<br>
        Pour plus d'information, voir la section dédiée, présente plus bas.
    </div>
</div>

<div class="row no-gutters mt-3">
    <div class="col-12 col-lg-6">
        <img class="img-fluid img-thumbnail" src="../../content/images/Animals/chat3.jpg" style="max-height: 600px;">
    </div>
    <div class="col-12 col-lg-6">
        <?= styleTitleLevel2("Qui suis-je ?", COLOR_TITLE_PENSIONNAIRES) ?>
        <p>FELIX, mâle tigré abandonné en pleine rue et recueilli il y a 3 semaines.<br>
            Est stérilisé et pucé. Est très affectueux et sociable. </p>
    </div>
</div>
<?php
require_once("../common/footer.php");
?>