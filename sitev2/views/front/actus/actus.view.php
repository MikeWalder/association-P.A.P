<?php
ob_start();
?>

<?= styleTitleLevel1("Nouvelles des adoptés", COLOR_TITLE_ACTUS) ?>

<?php foreach ($actualites as $actualite) : ?>

    <?= styleTitlePost("Posté le : <span class='" . COLOR_TITLE_ACTUS . "'>" . $actualite['date_publication_actualite'] . " </span>par 
    <span class='" . COLOR_TITLE_ACTUS . "'>" . $actualite['libelle_actualite'] . "</span>") ?>

    <div class="row no-gutters align-items-center" style="min-height: 280px;">
        <div class="col-12 col-md-3 text-center">
            <img src="<?= URL ?>public/content/images/Animals/<?= $actualite['image']['url_image'] ?>" class="img-fluid img-thumbnail" alt="<?= $actualite['libelle_actualite'] ?>">
        </div>
        <div class="col-12 col-md-9 p-2 text-center h4">
            <?= $actualite['contenu_actualite'] ?>
        </div>
    </div>

    <hr>
<?php endforeach; ?>

<?php
$content = ob_get_clean();
require_once("views/template.php");
?>