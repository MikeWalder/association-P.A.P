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
                    <div class="col-12 col-md-auto text-center">
                        <img src="public/content/images/website/<?= $animal['image']['url_image'] ?>" alt="<?= $animal['image'][$key]['libelle_image'] ?>" style="height: 300px;">
                    </div>
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="font-weight-bold"><?= $animal['nom_animal'] ?></h3>
                        <div><?= $animal['date_naissance_animal'] ?></div>
                        <p><?= $animal['image'][$key]['description_image'] ?></p>
                        <a href="" class="btn btn-primary">Visiter ma page</a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
        <!-- Fin de l'item -->
        <!-- Début de l'item -->

        <!-- Fin de l'item -->
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
    <div class="col-6 mt-3">
        <?= styleTitleLevel2("<i class='far fa-newspaper'></i> Nouvelles des adoptés", COLOR_TITLE_ACTUS) ?>
    </div>
    <div class="col-6 mt-3">
        <?= styleTitleLevel2("<i class='fas fa-location-arrow'></i> Evénements et actions", COLOR_TITLE_PENSIONNAIRES) ?>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <div class="row no-gutters border rounded mb-4">
            <div class="col-auto d-none d-lg-block">
                <img src="public/content/images/website/animals/chat1.jpg" alt="Chat 1" style="height: 180px;">
            </div>
            <div class="col p-3 d-flex flex-column position-static">
                <?= styleTitleLevel3("Doyenne Chipie", COLOR_TITLE_ACTUS, "text-center") ?>
                <p>
                    Un petit coucou de notre doyenne CHIPIE (20 ans) en famille d'accueil.<br>
                    La miss a un programme journalier assez chargé...
                </p>
                <a href="" class="btn btn-primary">Visiter sa page</a>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row no-gutters border rounded mb-4">
            <div class="col-auto d-none d-lg-block">
                <img src="<?= URL ?>public/content/images/website/animals/chat2.jpg" alt="Chat 2" style="height: 180px;">
            </div>
            <div class="col p-3 d-flex flex-column position-static">
                <?= styleTitleLevel3("Benjamine Mina", COLOR_TITLE_ASSO, "text-center") ?>
                <p>
                    Un petit coucou de notre benjamine MINA CHIPIE (1 an) disponible à l'adoption.<br>
                    <br>
                </p>
                <a href="" class="btn btn-primary">Visiter sa page</a>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require("views/template.php");
?>