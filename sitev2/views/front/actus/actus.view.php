<?php
ob_start();
?>

<?= styleTitleLevel1("Nouvelles des adoptés", COLOR_TITLE_ACTUS) ?>

<?= styleTitlePost("Posté le : <span class='" . COLOR_TITLE_ACTUS . "'>05 / 2018 </span>par <span class='" . COLOR_TITLE_ACTUS . "'>Framboise</span>") ?>

<div class="row no-gutters align-items-center" style="min-height: 280px;">
    <div class="col-12 col-md-3 text-center">
        <img src="public/content/images/Others/temperatures.jpg" class="img-fluid img-thumbnail" alt="Attention aux températures">
    </div>
    <div class="col-12 col-md-9 p-2 text-center h4">
        Faites attentions à vos animaux lors des canicules en été !<br>
        Hydratez-les régulièrement et mettez-les à l'abri du soleil.
    </div>
</div>

<hr>

<?= styleTitlePost("Posté le : <span class='" . COLOR_TITLE_ACTUS . "'>08 / 2018 </span>par <span class='" . COLOR_TITLE_ACTUS . "'>Anthony</span>") ?>

<div class="row no-gutters align-items-center" style="min-height: 280px;">
    <div class="col-12 col-md-3 text-center">
        <img src="public/content/images/Others/chocolat.jpg" class="img-fluid img-thumbnail" alt="Attention aux températures">
    </div>
    <div class="col-12 col-md-9 p-2 text-center h4">
        Ne donnez pas à manger de chocolat à vos animaux !<br>
        En effet, ces derniers peuvent présenter des symptômes plus ou moins graves en fonction de la quantité consommée.
    </div>
</div>

<?php
$content = ob_get_clean();
require_once("views/template.php");
?>