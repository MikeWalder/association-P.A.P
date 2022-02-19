<?php
require_once("../common/header.php");
require_once("../../use/config.php");
require_once("../../use/format.php");
?>

<?= styleTitleLevel1("Ils cherchent une famille", COLOR_TITLE_PENSIONNAIRES) ?>

<div class="row no-gutters">
    <div class="col-12 col-lg-6">
        <div class="row no-gutters align-items-center border border-dark rounded m-2 perso_bglightBlue perso_headerPensionnaires" style="height: 200px;">
            <div class="col p-2 text-center">
                <!-- image -->
                <img src="../../content/images/Animals/chat3.jpg" class="img-thumbnail" style="max-height: 190px;" alt="Félix">
            </div>
            <div class="col-2 border-left border-right border-dark text-center">
                <!-- icones -->
                <img src="../../content/images/Others/icons/dog.png" class="mb-2" style="height: 50px;" alt="Dog OK">
                <img src="../../content/images/Others/icons/cat.png" class="my-2" style="height: 50px;" alt="Cat OK">
                <img src="../../content/images/Others/icons/baby.png" class="mt-2" style="height: 50px;" alt="Baby OK">
            </div>
            <div class="col-6 text-center">
                <!-- informations -->
                <div class="font-weight-bold h3 mt-2">
                    Félix
                </div>
                <div class="h4">
                    02 / 12 / 2019
                </div>
                <div class="d-none d-sm-inline font-weight-bold h4">
                    <div class="badge badge-warning">Joueur</div>
                    <div class="badge badge-warning">Câlin</div>
                    <div class="badge badge-warning">Avenant</div>
                </div>
                <a href="animal.php" class="btn btn-primary mt-3">Visiter ma page</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6"></div>
</div>


<?php
require_once("../common/footer.php");
?>