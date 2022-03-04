<?php
ob_start();
?>
<?= styleTitleLevel1("Ajouter une actualité", COLOR_TITLE_CONSEILS); ?>

<form method="POST" action="" enctype="multipart/form-data" class="mt-2 mt-md-3 mt-lg-5">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="form-group col-md-6">
            <label for="titleActu" class="font-weight-bold">Titre de l'actualité</label>
            <input type="text" class="form-control" name="titleActu" id="titleActu" required>
        </div>
        <div class="form-group col-md-4">
            <label for="typeActu" class="font-weight-bold">Type</label>
            <select class="form-control" id="typeActu" name="typeActu">
                <?php for ($i = 0; $i < count($ada); $i++) : ?>
                    <option value="<?= $ada[$i] ?>"><?= $ada[$i] ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-1"></div>
        <div class="form-group col-md-10">
            <label for="contentActu" class="font-weight-bold">Contenu </label>
            <textarea class="form-control" id="contentActu" name="contentActu" rows="5" required></textarea>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-1"></div>
        <div class="form-group col-md-10">
            <label for="imageActu" class="font-weight-bold">Image</label>
            <input type="file" class="form-control-file" id="imageActu" name="imgActu">
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-lg-2"></div>
        <input type="hidden" name="validateAdminNews" value="true">
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