<?php
ob_start();
?>

<?= styleTitleLevel1("Ils ont besoin de vous !", COLOR_TITLE_ASSO) ?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php for ($i = 0; $i < count($animaux); $i++) : ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<? $i ?>" class="bg-dark <?= $i === 0 ? 'active' : '' ?>"></li>
        <?php endfor; ?>
    </ol>

    <div class="carousel-inner">
        <!-- Début de l'item -->
        <?php foreach ($animaux as $key => $animal) : ?>
            <div class="carousel-item <?= $key === 0 ? 'active' : '' ?>">
                <div class="row no-gutters border rounded overflow-hidden mb-4">
                    <?php foreach ($animal['image'] as $image) : ?>
                        <div class="col-12 col-md-auto text-center">
                            <img src="public/content/images/website/<?= $image['url_image'] ?>" alt="<?= $image['libelle_image'] ?>" style="height: 300px;">
                        </div>
                        <div class="col p-4 d-flex flex-column position-static">
                            <h3 class="font-weight-bold"><?= $animal['nom_animal'] ?></h3>
                            <div><?= "Date de naissance : " . date("d/m/Y", strtotime($animal['date_naissance_animal'])) ?></div>
                            <p><?= previewArticle($animal['description_animal'], 250) . " - <span class='h6 text-info'>Lire la suite</span>" ?></p>
                            <a href="animal&id_animal= <?= $animal['id_animal'] ?>" class="btn btn-primary">Visiter ma page</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="row">
    <div class="col-6">
        <?= styleTitleLevel2("<i class='far fa-newspaper'></i> Nouvelles des adoptés", COLOR_TITLE_ACTUS) ?>
        <div class="row no-gutters border rounded mb-4">
            <div class="col-auto d-none d-lg-block">
                <img src="public/content/images/website/<?= $lastNews['url_image'] ?>" title="<?= $lastNews['libelle_image'] ?>" alt="<?= $lastNews['libelle_image'] ?>" style="height: 180px;">
            </div>
            <div class="col p-3 d-flex flex-column position-static">
                <?= styleTitleLevel3($lastNews['libelle_actualite'], COLOR_TITLE_ACTUS, "text-center") ?>
                <p style="min-height: 100px;">
                    <?= previewArticle($lastNews['contenu_actualite'], 250) . " - <span class='h6 text-info'>Lire la suite</span>" ?>
                </p>
                <a href="actus&type=News" class="btn btn-primary">Voir plus</a>
            </div>
        </div>
    </div>
    <div class="col-6">
        <?= styleTitleLevel2("<i class='fas fa-location-arrow'></i> Evénements et actions", COLOR_TITLE_ACTUS) ?>
        <div class="row no-gutters border rounded mb-4">
            <div class="col-auto d-none d-lg-block">
                <img src="<?= URL ?>public/content/images/website/<?= $lastActionOrEvent['url_image'] ?>" alt="<?= $lastActionOrEvent['libelle_actualite'] ?>" style="height: 180px;">
            </div>
            <div class="col p-3 d-flex flex-column position-static">
                <?= styleTitleLevel3($lastActionOrEvent['libelle_actualite'], COLOR_TITLE_ACTUS, "text-center") ?>
                <p style="min-height: 100px;">
                    <?= previewArticle($lastActionOrEvent['contenu_actualite'], 250) . " - <span class='h6 text-info'>Lire la suite</span>" ?>
                </p>
                <a href="actus&type=<?= $lastActionOrEvent['type_actualite'] ?>" class="btn btn-primary">Voir plus</a>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require("views/template.php");
?>