<?php
require_once("../../views/header.php");
require_once("../../config/config.php");
require_once("../format.php");
?>

<?= styleTitleLevel1("Education canine", COLOR_TITLE_CONSEILS) ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-5 p-2">
            <img class="img-fluid img-thumbnail" src="../../content/images/Others/educateur_canin.jpg" alt="Educateur canin" title="Formation au dressage du chien">
        </div>
        <div class="col-7 p-2">
            <p class="h4">
                Nous connaissons des éducateurs canin employant l'éducation positive.<br>
                Vous pourrez ainsi apprendre à dresser correctement votre chien.
            </p>
            <a href="http://dev.nosamisnosanimaux.fr/global/contact.php" target="_blank" class="btn btn-block btn-primary mt-3">Contacter l'éducateur</a>
            <div class="row">
                <div class="col-auto text-center mx-auto mt-3">
                    <img class="img-fluid img-thumbnail" src="../../content/images/Others/icons/educateur_canin.png" alt="Educateur canin" style="height: 200px;">
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require_once("../../views/footer.php");
?>