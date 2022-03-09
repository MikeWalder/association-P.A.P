<?php
ob_start();
?>

<?php
/* echo "<pre>";
print_r($animaux);
echo "</pre>"; */
?>

<?= styleTitleLevel1($text, COLOR_TITLE_PENSIONNAIRES); ?>

<div class="row no-gutters mt-2">
    <?php foreach ($animaux as $key => $animal) : ?>
        <div class="col-12 col-lg-6">
            <div class="row no-gutters align-items-center border border-dark rounded m-2 perso_headerPensionnaires
            <?= $animal['sexe'] == 1 ? "perso_bglightBlue" : "perso_bgPink" ?>" style="height: 200px;">

                <div class="col p-2 text-center">
                    <img src="<?= URL ?>public/content/images/<?= empty($animal['image']['url_image']) ? "others/no-img.png" : "website/" . $animal['image']['url_image'] ?>" class="img-thumbnail" alt="<?= empty($animal['image']['libelle_image']) ? $animal['nom_animal'] : $animal['image']['libelle_image'] ?>" style="max-height: 190px;" alt="Félix">
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

                <div class="col-2 border-left border-right border-dark text-center">
                    <img src="<?= URL ?>public/content/images/Others/icons/<?= $iconeDog ?>.png" class="mb-2" style="height: 50px;" alt="Dog OK">
                    <img src="<?= URL ?>public/content/images/Others/icons/<?= $iconeCat ?>.png" class="my-2" style="height: 50px;" alt="Cat OK">
                    <img src="<?= URL ?>public/content/images/Others/icons/<?= $iconeChild ?>.png" class="mt-2" style="height: 50px;" alt="Baby OK">
                </div>

                <div class="col-6 text-center perso_textShadow">
                    <div class="font-weight-bold h3 mt-2">
                        <?= $animal['nom_animal'] ?> (
                        <?= $animal['sexe'] == 0 ? "<i class='fas fa-venus'></i>" : "<i class='fas fa-mars'></i>" ?>
                        )
                    </div>
                    <div class="h4">
                        Né le : <?= date("d/m/Y", strtotime($animal['date_naissance_animal'])) ?>
                    </div>
                    <div class="d-none d-sm-inline font-weight-bold h4">
                        <?php foreach ($animal['caracteres'] as $key => $caractere) : ?>
                            <div class="badge badge-warning">
                                <?= $animal['sexe'] == 0 ? $caractere['libelle_caractere_f'] : $caractere['libelle_caractere_m'] ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?= URL ?>animal&id_animal=<?= $animal['id_animal'] ?>" class="btn btn-primary mt-3">Visiter ma page</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
require("views/template.php");
