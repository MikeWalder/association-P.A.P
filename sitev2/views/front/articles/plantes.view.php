<?php
ob_start();
?>

<?= styleTitleLevel1("Attention aux plantes toxiques pour les chats !", COLOR_TITLE_CONSEILS) ?>

<div class="container">
    <div class="row">
        <div class="col-auto mx-auto text-center mt-3 ml-3">
            <p>
                Pour en savoir plus, consultez
                <a href="https://www.saphirbleucarlin.com/information-m%C3%A9dical/" target="_blank" class="btn btn-info mb-1"> ce site.</a>
            </p>
            <img class="img-fluid img-thumbnail" src="<?= URL ?>public/content/images/website/articles/plantes_toxiques.jpg" alt="Plantes toxiques" title="Les plantes toxiques pour chats et chiens">
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once("views/template.php");
?>