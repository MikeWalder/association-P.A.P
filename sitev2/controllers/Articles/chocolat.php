<?php
require_once("../../views/header.php");
require_once("../../config/config.php");
require_once("../format.php");
?>

<?= styleTitleLevel1("Attention, le chocolat est très dangereux pour les chiens et chats !", COLOR_TITLE_CONSEILS) ?>
<div class="container">
    <div class="row">
        <div class="col-auto mx-auto text-center mt-3 ml-3">
            <img class="img-fluid img-thumbnail" src="../../content/images/Others/chocolat.jpg" alt="Danger chocolat" title="Dangers du chocolat">
        </div>
    </div>
</div>

<?php
require_once("../../views/footer.php");
?>