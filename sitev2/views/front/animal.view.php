<?php
ob_start();
?>

<?= styleTitleLevel1($animal['nom_animal'], COLOR_TITLE_PENSIONNAIRES) ?>
<div class="row no-gutters align-items-center mt-3 border border-dark <?= $animal['sexe'] == 1 ? "perso_bglightBlue" : "perso_bgPink" ?>">

    <div class="col-4 col-md-3 text-center">

        <img class="img-fluid img-thumbnail" src="<?= URL ?>public/content/images/website/<?= $images[0]['url_image'] ?>" style="max-height: 220px;" alt="<?= $images[0]['libelle_image'] ?>">
    </div>

    <?php
    $iconeDog = "";
    if ($animal['ami_chien'] === "oui") $iconeDog = "dog";
    else if ($animal['ami_chien'] === "non") $iconeDog = "dogNot";
    else if ($animal['ami_chien'] === "N/A") $iconeDog = "dogQuest";
    $iconeCat = "";
    if ($animal['ami_chat'] === "oui") $iconeCat = "cat";
    else if ($animal['ami_chat'] === "non") $iconeCat = "catNot";
    else if ($animal['ami_chat'] === "N/A") $iconeCat = "catQuest";
    $iconeChild = "";
    if ($animal['ami_enfant'] === "oui") $iconeChild = "baby";
    else if ($animal['ami_enfant'] === "non") $iconeChild = "babyNot";
    else if ($animal['ami_enfant'] === "N/A") $iconeChild = "babyQuest";
    ?>
    <div class="col-2 col-md-1 border-left border-right border-dark text-center">
        <img src="<?= URL ?>public/content/images/Others/icons/<?= $iconeDog ?>.png" class="mb-2" style="height: 50px;" alt="Dog OK">
        <img src="<?= URL ?>public/content/images/Others/icons/<?= $iconeCat ?>.png" class="my-2" style="height: 50px;" alt="Cat OK">
        <img src="<?= URL ?>public/content/images/Others/icons/<?= $iconeChild ?>.png" class="mt-2" style="height: 50px;" alt="Baby OK">
    </div>

    <div class="col-4 col-md-3 text-center">
        <!-- informations -->
        <div class="font-weight-bold h3 mt-2">
            <?= $animal['nom_animal'] ?> (
            <?= $animal['sexe'] == 0 ? "<i class='fas fa-venus'></i>" : "<i class='fas fa-mars'></i>" ?>
            )
        </div>
        <div class="h5">
            Puce : <?= empty($animal['puce_animal']) ? "aucun" : date("d/m/Y", strtotime($animal['puce_animal'])) ?><br>
            Né le : <?= empty($animal['date_naissance_animal']) ? "non défini" : date("d/m/Y", strtotime($animal['date_naissance_animal'])) ?>
        </div>

        <div class="d-none d-sm-inline font-weight-bold h4">
            <?php foreach ($caracteres as $caractere) : ?>
                <div class="badge badge-warning">
                    <?= $animal['sexe'] == 0 ? $caractere['libelle_caractere_f'] : $caractere['libelle_caractere_m'] ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-12 col-md-4 mt-3 mt-md-0 ml-3 ml-lg-2">
        <?= $animal['description_animal'] ?>
    </div>
</div>

<div class="row no-gutters mt-3 align-items-center">
    <div class="col-12 col-lg-6">
        <div id="carouselAnimal" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php foreach ($images as $key => $image) : ?>
                    <li data-target="#carouselAnimal" data-slide-to="<?= $key ?>" class="<?= $key === 0 ? "active" : "" ?> bg-dark"></li>
                <?php endforeach; ?>
            </ol>
            <div class="carousel-inner">
                <?php foreach ($images as $key => $image) : ?>
                    <div class="carousel-item <?= $key === 0 ? "active" : "" ?>">
                        <img class="d-block w-80 p-3" src="<?= URL ?>public/content/images/website/<?= $image['url_image'] ?>" style="max-height: 600px;" alt="<?= $image['libelle_image'] ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carouselAnimal" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselAnimal" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <?= styleTitleLevel2("Qui suis-je ?", COLOR_TITLE_PENSIONNAIRES) ?>
        <p>
            <?= empty($animal['adoption_description_animal']) ? $animal['nom_animal'] : $animal['adoption_description_animal'] ?>
        </p>
        <hr>
        <div class="text-center">
            <?= styleTitleLevel2("<i class='fas fa-map-marked-alt mr-2 mr-lg-3'></i>Localisation", COLOR_TITLE_PENSIONNAIRES) ?>
        </div>
        <p>
            <?= $animal['localisation_description_animal'] ?>
        </p>
        <hr>
        <div class="text-center">
            <?= styleTitleLevel2("<i class='fas fa-file-contract mr-2 mr-lg-3'></i></i>Informations", COLOR_TITLE_PENSIONNAIRES) ?>
        </div>
        <p>
            <?= $animal['engagement_description_animal'] ?>
        </p>
    </div>

</div>
<?php
$content = ob_get_clean();
require_once("views/template.php");
?>