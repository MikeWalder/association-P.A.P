<?php
ob_start();
?>
<?= styleTitleLevel1("Modifier le pensionnaire", COLOR_TITLE_CONSEILS); ?>

<?php
echo "<pre>";
empty($_FILES) ? '' : var_dump($_FILES);
echo "</pre>";

echo "<pre>";
empty($idImagesRelativeTable) ? var_dump($idImagesRelativeTable) : print_r($idImagesRelativeTable);
echo "</pre>";

echo "<pre>";
empty($imgDatas) ? '' : var_dump($imgDatas);
echo "</pre>";

echo "<pre>";
empty($datasImg) ? '' : var_dump($datasImg);
echo "</pre>";

echo $datasImg[0]['url_image'] . "<br>";
echo $datasImg[1]['url_image'] . "<br>";
//echo $datasImg[2]['url_image'] . "<br>";

echo "animals/" . displayNameAnimalStatutFileByIdStatut($infosAnimal['id_statut']) . "/" . $infosAnimal['nom_animal'] . "_" . $imgAnimal2['name'] . "<br>";
echo strlen($imgAnimal2['name']) . "<br>";
if (strcmp($datasImg[1]['url_image'], "animals/" . displayNameAnimalStatutFileByIdStatut($infosAnimal['id_statut']) . "/y" . $infosAnimal['nom_animal'] . "_" . $imgAnimal2['name']) == 0) {
    echo "les deux chaînes de caractères sont identiques !";
} else {
    echo "Les deux chaîunes sont différentes !";
}
?>

<div class="row no-gutters">
    <?= empty($result) ? '' : $result ?>
</div>

<form method="POST" action="" enctype="multipart/form-data" class="mt-2 mt-md-3 mt-lg-5">
    <div class="row mt-2">
        <div class="col-lg-1"></div>
        <div class="form-group col-md-4 col-lg-2">
            <label for="nameAnimal" class="font-weight-bold">Nom de l'animal (*)</label><br>
            &nbsp;
            <input type="text" class="form-control" placeholder="<?= $infosAnimal['nom_animal'] ?>" name="nameAnimal" id="nameAnimal" required>
        </div>
        <div class="form-group col-md-4 col-lg-2">
            <label for="typeAnimal" class="font-weight-bold">Type (*)</label><br>
            <small>(actuel : <?= $infosAnimal['type_animal'] ?>)</small>
            <select class="form-control" id="typeAnimal" name="typeAnimal">
                <option class="<?= $infosAnimal['type_animal'] == "Chat" ? 'text-info font-weight-bold' : 'text-dark' ?>" value="Chat">Chat</option>
                <option class="<?= $infosAnimal['type_animal'] == "Chien" ? 'text-primary font-weight-bold' : 'text-dark' ?>" value="Chien">Chien</option>
            </select>
        </div>
        <div class="form-group col-md-4 col-lg-2">
            <label for="sexe" class="font-weight-bold">Sexe (*)</label><br>
            <small>(actuel : <?= $infosAnimal['sexe'] == "1" ? "mâle" : "femelle" ?>)</small>
            <select class="form-control" id="sexe" name="sexe">
                <option class="<?= $infosAnimal['sexe'] == "1" ? 'text-info font-weight-bold' : 'text-dark' ?>" value="1">Mâle</option>
                <option class="<?= $infosAnimal['sexe'] == "0" ? 'text-primary font-weight-bold' : 'text-dark' ?>" value="0">Femelle</option>
            </select>
        </div>
        <div class="form-group col-md-4 col-lg-2">
            <label for="puce" class="font-weight-bold">Pucé ?</label><br>
            <small>(actuel : <?= empty($infosAnimal['puce_animal']) ? "Indéfini" : $infosAnimal['puce_animal'] ?>)</small>
            <select class="form-control" id="puce" name="puce">
                <option class="<?= $infosAnimal['puce_animal'] == "" ? 'text-info font-weight-bold' : 'text-dark' ?>" value="">Indéfini</option>
                <option class="<?= $infosAnimal['puce_animal'] == "oui" ? 'text-info font-weight-bold' : 'text-dark' ?>" value="oui">Oui</option>
                <option class="<?= $infosAnimal['puce_animal'] == "non" ? 'text-info font-weight-bold' : 'text-dark' ?>" value="non">Non</option>
            </select>
        </div>
        <div class="form-group col-md-4 col-lg-2">
            <label for="statut" class="font-weight-bold">Statut</label><br>
            <small>(actuel : <?= displayNameAnimalStatutByIdStatut($infosAnimal['id_statut']) ?>)</small>
            <select class="form-control" id="statut" name="statut">
                <option class="<?= $infosAnimal['id_statut'] == "1" ? 'text-info font-weight-bold' : 'text-dark' ?>" value="1">A l'adoption</option>
                <option class="<?= $infosAnimal['id_statut'] == "2" ? 'text-success font-weight-bold' : 'text-dark' ?>" value="2">Adopté</option>
                <option class="<?= $infosAnimal['id_statut'] == "3" ? 'text-warning font-weight-bold' : 'text-dark' ?>" value="3">F.A.L.D</option>
                <option class="<?= $infosAnimal['id_statut'] == "4" ? 'text-danger font-weight-bold' : 'text-dark' ?>" value="4">Décédé</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="row mt-lg-4">
        <div class="col-lg-1"></div>
        <div class="form-group col-md-4 col-lg-2">
            <label for="birthDate" class="font-weight-bold">Date naissance</label><br>
            &nbsp;
            <input placeholder="<?= empty($infosAnimal['date_naissance_animal']) ? 'Indéfini' : date("d/m/Y", strtotime($infosAnimal['date_naissance_animal'])) ?>" type="text" onfocus="(this.type='date')" class="form-control" name="birthDate" id="birthDate">
        </div>
        <div class="form-group col-md-4 col-lg-2">
            <label for="adoptionDate" class="font-weight-bold">Date adoption</label><br>
            &nbsp;
            <input placeholder="<?= empty($infosAnimal['date_adoption_animal']) ? 'Indéfini' : date("d/m/Y", strtotime($infosAnimal['date_adoption_animal'])) ?>" type="text" onfocus="(this.type='date')" class="form-control" name="adoptionDate" id="adoptionDate">
        </div>
        <div class="form-group col-md-4 col-lg-2">
            <label for="amiChien" class="font-weight-bold">Ami chien ?</label><br>
            <small>(actuel : <?= $infosAnimal['ami_chien'] ?>)</small>
            <select class="form-control" id="amiChien" name="amiChien">
                <option class="<?= $infosAnimal['ami_chien'] == "N/A" ? 'text-warning font-weight-bold' : 'text-dark' ?>" value="N/A">Indéfini (N/A)</option>
                <option class="<?= $infosAnimal['ami_chien'] == "oui" ? 'text-success font-weight-bold' : 'text-dark' ?>" value="oui">Oui</option>
                <option class="<?= $infosAnimal['ami_chien'] == "non" ? 'text-danger font-weight-bold' : 'text-dark' ?>" value="non">Non</option>
            </select>
        </div>
        <div class="form-group col-md-4 col-lg-2">
            <label for="amiChat" class="font-weight-bold">Ami chat ?</label><br>
            <small>(actuel : <?= $infosAnimal['ami_chat'] ?>)</small>
            <select class="form-control" id="amiChat" name="amiChat">
                <option class="<?= $infosAnimal['ami_chat'] == "N/A" ? 'text-warning font-weight-bold' : 'text-dark' ?>" value="N/A">Indéfini (N/A)</option>
                <option class="<?= $infosAnimal['ami_chat'] == "oui" ? 'text-success font-weight-bold' : 'text-dark' ?>" value="oui">Oui</option>
                <option class="<?= $infosAnimal['ami_chat'] == "non" ? 'text-danger font-weight-bold' : 'text-dark' ?>" value="non">Non</option>
            </select>
        </div>
        <div class="form-group col-md-4 col-lg-2">
            <label for="amiEnfant" class="font-weight-bold">Ami enfant ?</label><br>
            <small>(actuel : <?= $infosAnimal['ami_enfant'] ?>)</small>
            <select class="form-control" id="amiEnfant" name="amiEnfant">
                <option class="<?= $infosAnimal['ami_enfant'] == "N/A" ? 'text-warning font-weight-bold' : 'text-dark' ?>" value="N/A">Indéfini (N/A)</option>
                <option class="<?= $infosAnimal['ami_enfant'] == "oui" ? 'text-success font-weight-bold' : 'text-dark' ?>" value="oui">Oui</option>
                <option class="<?= $infosAnimal['ami_enfant'] == "non" ? 'text-danger font-weight-bold' : 'text-dark' ?>" value="non">Non</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="row no-gutters mt-2">
        <div class="col-md-1"></div>
        <div class="form-group col-md-10">
            <label for="description_animal" class="font-weight-bold">Description du pensionnaire (*)</label>
            <textarea class="form-control" id="description_animal" name="description_animal" rows="3" required><?= $infosAnimal['description_animal'] ?></textarea>
        </div>
    </div>
    <hr>
    <div class="row mt-2">
        <div class="col-md-1"></div>
        <div class="form-group col-md-10">
            <label for="description_animal_adoption" class="font-weight-bold">Description du pensionnaire pour l'adoption</label>
            <textarea class="form-control" id="description_animal_adoption" name="description_animal_adoption" rows="3"><?= empty($infosAnimal['localisation_description_animal']) ? 'Aucune information' : $infosAnimal['localisation_description_animal'] ?></textarea>
        </div>
    </div>
    <hr>
    <div class="row mt-2">
        <div class="col-md-1"></div>
        <div class="form-group col-md-10">
            <label for="localisation_animal_adoption" class="font-weight-bold">Localisation du pensionnaire pour l'adoption</label>
            <textarea class="form-control" id="localisation_animal_adoption" name="localisation_animal_adoption" rows="3"><?= empty($infosAnimal['adoption_description_animal']) ? 'Aucune information' : $infosAnimal['adoption_description_animal'] ?></textarea>
        </div>
    </div>
    <hr>
    <div class="row mt-2">
        <div class="col-md-1"></div>
        <div class="form-group col-md-10">
            <label for="engagement" class="font-weight-bold">Engagement</label>
            <textarea class="form-control" id="engagement" name="engagement" rows="3"><?= empty($infosAnimal['engagement']) ? 'Aucune information' : $infosAnimal['engagement'] ?></textarea>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-1"></div>
        <div class="form-group col-md-4">
            <label for="imageAnimal1" class="font-weight-bold">Image(s)</label>
            <input type="file" class="form-control-file" id="imageAnimal1" name="imgAnimal1" accept="image/*"><br>
            <input type="file" class="form-control-file" id="imageAnimal2" name="imgAnimal2" accept="image/*"><br>
            <input type="file" class="form-control-file" id="imageAnimal3" name="imgAnimal3" accept="image/*">
        </div>

        <div class="form-group col-md-3">
            <label class="font-weight-bold">Actuelles</label>
            <?php foreach ($datasImg as $key => $img) : ?>
                <input type="text" class="form-control mb-1" placeholder="<?= empty($img['description_image']) ? 'Vide' : $img['description_image'] ?>">
            <?php endforeach; ?>
        </div>

        <div class="form-group d-none d-md-block col-md-3 col-lg-3 border border-secondary rounded p-0 text-center">

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php foreach ($imagesAnimal as $key => $imageAnimal) : ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?= $key ?>" class="<?= $key == 0 ? 'active' : '' ?>"></li>
                    <?php endforeach; ?>
                </ol>

                <div class="carousel-inner">
                    <?php foreach ($imagesAnimal as $key => $imageAnimal) : ?>
                        <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
                            <img class="d-block w-100" src="<?= URL ?>public/content/images/website/<?= $imageAnimal['url_image'] ?>" alt="<?= $imageAnimal['url_image'] ?>" style="height: 220px;">
                        </div>
                    <?php endforeach; ?>
                </div>
                <figcaption>Images actuelles</figcaption>

                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-1"></div>
        <input type="hidden" name="validateAdminModifPensionnaire" value="true">
        <input type="submit" class="btn btn-info col-10 my-2 my-md-3 my-lg-5" value="Valider">
    </div>
</form>

<?php
$content = ob_get_clean();
require("views/template.php");
?>