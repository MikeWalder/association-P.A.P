<?php
ob_start();
?>
<?= styleTitleLevel1("Ajouter un pensionnaire", COLOR_TITLE_CONSEILS); ?>

<div class="row no-gutters">
    <?= empty($result) ? '' : $result ?>
</div>

<form method="POST" action="" enctype="multipart/form-data" class="mt-2 mt-md-3 mt-lg-5">
    <div class="row mt-2">
        <div class="col-md-1"></div>
        <div class="form-group col-md-2">
            <label for="nameAnimal" class="font-weight-bold">Nom de l'animal (*)</label>
            <input type="text" class="form-control" name="nameAnimal" id="nameAnimal" required>
        </div>
        <div class="form-group col-md-2">
            <label for="typeAnimal" class="font-weight-bold">Type (*)</label>
            <select class="form-control" id="typeAnimal" name="typeAnimal">
                <option value="Chat">Chat</option>
                <option value="Chien">Chien</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="sexe" class="font-weight-bold">Sexe (*)</label>
            <select class="form-control" id="sexe" name="sexe">
                <option value="1">Mâle</option>
                <option value="0">Femelle</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="puce" class="font-weight-bold">Pucé ?</label>
            <select class="form-control" id="puce" name="puce">
                <option value="">Indéfini</option>
                <option value="oui">Oui</option>
                <option value="non">Non</option>
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-1"></div>
        <div class="form-group col-md-2">
            <label for="birthDate" class="font-weight-bold">Date de naissance</label>
            <input type="date" class="form-control" name="birthDate" id="birthDate">
        </div>
        <div class="form-group col-md-2">
            <label for="adoptionDate" class="font-weight-bold">Date d'adoption</label>
            <input type="date" class="form-control" name="adoptionDate" id="adoptionDate">
        </div>
        <div class="form-group col-md-2">
            <label for="amiChien" class="font-weight-bold">Ami chien ?</label>
            <select class="form-control" id="amiChien" name="amiChien">
                <option value="N/A">Indéfini</option>
                <option value="oui">Oui</option>
                <option value="non">Non</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="amiChat" class="font-weight-bold">Ami chat ?</label>
            <select class="form-control" id="amiChat" name="amiChat">
                <option value="N/A">Indéfini</option>
                <option value="oui">Oui</option>
                <option value="non">Non</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="amiEnfant" class="font-weight-bold">Ami enfant ?</label>
            <select class="form-control" id="amiEnfant" name="amiEnfant">
                <option value="N/A">Indéfini</option>
                <option value="oui">Oui</option>
                <option value="non">Non</option>
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-1"></div>
        <div class="form-group col-md-10">
            <label for="description_animal" class="font-weight-bold">Description du pensionnaire (*)</label>
            <textarea class="form-control" id="description_animal" name="description_animal" rows="3" required></textarea>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-1"></div>
        <div class="form-group col-md-10">
            <label for="description_animal_adoption" class="font-weight-bold">Description du pensionnaire pour l'adoption</label>
            <textarea class="form-control" id="description_animal_adoption" name="description_animal_adoption" rows="3"></textarea>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-1"></div>
        <div class="form-group col-md-10">
            <label for="localisation_animal_adoption" class="font-weight-bold">Localisation du pensionnaire pour l'adoption</label>
            <textarea class="form-control" id="localisation_animal_adoption" name="localisation_animal_adoption" rows="3"></textarea>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-1"></div>
        <div class="form-group col-md-10">
            <label for="imageAnimal" class="font-weight-bold">Image(s)</label>
            <input type="file" class="form-control-file" id="imageAnimal" name="imgAnimal" multiple>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-1"></div>
        <input type="hidden" name="validateAdminNews" value="true">
        <input type="submit" class="btn btn-info col-10 my-2 my-md-3 my-lg-5" value="Valider">
    </div>
</form>

<?php
$content = ob_get_clean();
require("views/template.php");
?>