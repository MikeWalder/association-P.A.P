<?php
ob_start();
?>
<?= styleTitleLevel1("Modifier l'actualité", COLOR_TITLE_CONSEILS); ?>

<?php
/* echo "<pre>";
print_r($actuSelected);
echo "</pre>"; */

echo "<pre>";
print_r($imageUrlToDelete);
echo "</pre>";

?>

<form method="POST" action="" enctype="multipart/form-data" class="mt-2 mt-md-3 mt-lg-5">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="form-group col-md-6">
            <label for="titleActu" class="font-weight-bold">Titre de l'actualité</label>
            <input type="text" class="form-control" name="titleActu" id="titleActu" placeholder="<?= $actuSelected['libelle_actualite'] ?>" required>
        </div>
        <div class="form-group col-md-4">
            <label for="typeActu" class="font-weight-bold">Type (actuel : <?= $actuSelected['type_actualite'] ?>)</label>
            <select class="form-control" id="typeActu" name="typeActu">
                <option value=""></option>
                <?php for ($i = 0; $i < count($ada); $i++) : ?>
                    <option class="<?= $ada[$i] == $actuSelected['type_actualite'] ? 'text-info font-weight-bold' : '' ?>" value="<?= $ada[$i] ?>"><?= $ada[$i] ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-1"></div>
        <div class="form-group col-md-10">
            <label for="contentActu" class="font-weight-bold">Contenu </label>
            <textarea class="form-control" id="contentActu" name="contentActu" placeholder="<?= $actuSelected['contenu_actualite'] ?>" rows="5" required></textarea>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-1"></div>
        <div class="form-group col-md-5 pt-5">
            <label for="imageActu" class="font-weight-bold">Image</label>
            <input type="file" class="form-control-file" id="imageActu" name="imgActu">
        </div>
        <div class="form-group col-md-2 border border-secondary rounded p-0 text-center">
            <img class="img-fluid" src="<?= URL ?>public/content/images/website/<?= $imageActuSelected['url_image'] ?>" style="height: 250px;">
            <figcaption class="figure-caption text-center"><?= $actuSelected['libelle_actualite'] ?></figcaption>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-lg-2"></div>
        <input type="hidden" name="validateModifAdminNews" value="true">
        <input type="submit" class="btn btn-info col-md-10 col-lg-8 my-1 my-md-3 my-lg-5" value="Valider">
    </div>
</form>

<div class="row no-gutters">
    <?= empty($result) ? '' : $result ?>
</div>

<?php
$content = ob_get_clean();
require("views/template.php");
?>