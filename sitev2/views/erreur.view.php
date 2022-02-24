<?php
ob_start();
?>

<?= styleTitleLevel1("Erreur", COLOR_TITLE_PENSIONNAIRES); ?>

<div class="text-center alert alert-danger h3">
    <?= $errorMessage ?>
</div>


<?php
$title = "Erreur";
$description = "Gestion des erreurs";
$content = ob_get_clean();
require("views/template.php");
?>