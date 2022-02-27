<?php
ob_start();
?>

<?= styleTitleLevel1("Attention, le chocolat est très dangereux pour les chiens et chats !", COLOR_TITLE_CONSEILS) ?>
<div class="container">
    <div class="row">
        <div class="col-auto mx-auto text-center mt-3 ml-3">
            <img class="img-fluid img-thumbnail" src="<?= URL ?>public/content/images/website/articles/chocolat.jpg" alt="Danger chocolat" title="Dangers du chocolat">
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once("views/template.php");
?>