<?php
ob_start();
?>
<?= styleTitleLevel1("Administration", COLOR_TITLE_CONSEILS); ?>

<div class="row mt-2 mt-md-3 mt-lg-5 text-center">
    <div class="col-12 col-md mb-1 mb-md-0">
        <a href="adminPensionnaire" class="btn btn-lg btn-primary p-1 p-md-2">Gestion des pensionnaires</a>
    </div>
    <div class="col-12 col-md mb-1 mb-md-0 text-center">
        <a href="adminNews" class="btn btn-lg btn-primary p-1 p-md-2">Gestion des News</a>
    </div>
    <div class="col-12 col-md mb-1 mb-md-0 text-center">
        <form method="POST" action="">
            <input type="hidden" name="deconnection" value="true">
            <input type="submit" class="btn btn-lg btn-primary p-1 p-md-2" value="Déconnection">
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
require("views/template.php");
?>