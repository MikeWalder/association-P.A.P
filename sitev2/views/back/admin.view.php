<?php
ob_start();
?>
<?= styleTitleLevel1("Administration", COLOR_TITLE_CONSEILS); ?>

<div class="row mt-2 mt-md-3 mt-lg-5">
    <div class="col text-center">
        <a href="generationPensionnaireAdmin" class="btn btn-primary">Gestion des pensionnaires</a>
    </div>
    <div class="col text-center">
        <a href="generationNewsAdmin" class="btn btn-primary">Gestion des News</a>
    </div>
    <div class="col text-center">
        <form method="POST" action="">
            <input type="hidden" name="deconnection" value="true">
            <input type="submit" class="btn btn-primary" value="Déconnection">
        </form>

    </div>
</div>

<?php
$content = ob_get_clean();
require("views/template.php");
?>