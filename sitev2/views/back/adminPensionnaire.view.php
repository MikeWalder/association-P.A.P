<?php
ob_start();
?>
<?= styleTitleLevel1("Gestion des pensionnaires", COLOR_TITLE_CONSEILS); ?>

<?php
/* echo "<pre>";
print_r($lastPensionnaires);
echo "</pre>"; */


/* echo "<pre>";
print_r($firstImg);
echo "</pre>"; */
?>

<div class="row no-gutters">
    <?= empty($result) ? '' : $result ?>
</div>

<div class="row mt-2 mt-md-3 mt-lg-4 text-center">
    <div class="col-12 col-md mb-1 mb-md-0 text-center">
        <a href="adminAddPensionnaire" class="btn btn-lg btn-primary p-1 p-md-2"><i class="fas fa-plus-circle"></i>&nbsp;Ajouter un pensionnaire</a>
    </div>
</div>

<div class="row mt-2 mt-md-4">
    <div class="col-2"></div>
    <button type="button" class="btn perso_bgGreen d-none d-md-block col-2 mx-1">
        À l'adoption
        <span class="badge badge-light h3"><?= empty($countAnimal[0]['nbre']) ? '0' : $countAnimal[0]['nbre'] ?></span>
    </button>
    <button type="button" class="btn perso_bgPink d-none d-md-block col-2 mx-1">
        Adopté
        <span class="badge badge-light"><?= empty($countAnimal[1]['nbre']) ? '0' : $countAnimal[1]['nbre'] ?></span>
    </button>
    <button type="button" class="btn perso_bglightBlue d-none d-md-block col-2 mx-1">
        En F.A.L.D *
        <span class="badge badge-light"><?= empty($countAnimal[2]['nbre']) ? '0' : $countAnimal[2]['nbre'] ?></span>
    </button>
    <button type="button" class="btn bg-light d-none d-md-block col-2 mx-1">
        Décédé
        <span class="badge badge-light"><?= empty($countAnimal[3]['nbre']) ? '0' : $countAnimal[3]['nbre'] ?></span>
    </button>
</div>
<div class="row d-none d-md-block text-center">
    <small>F.A.L.D. = Famille d'Accueil Longue Durée</small>
</div>

<div class="row no-gutters mt-2 mt-md-3">
    <table class="d-none d-md-block table table-striped table-bordered align-items-center">
        <thead class="thead-dark text-center align-items-center">
            <tr class="h6">
                <th class="align-middle" scope="col">Nom </th>
                <th class="align-middle" scope="col">Type</th>
                <th class="align-middle" scope="col">Sexe</th>
                <th class="align-middle" scope="col">Description</th>
                <th class="align-middle" scope="col" class="col-md-2">Image liée</th>
                <th class="align-middle" colspan="2" scope="col" class="col-md-2"> Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lastPensionnaires as $key => $pensionnaire) : ?>
                <tr class="text-center <?= $bgColorActu = displayColorAnimalByStatut($pensionnaire['id_statut']) ?>">
                    <td class="align-middle col-md-2 font-weight-bold"><?= $pensionnaire['nom_animal'] ?></td>
                    <td class="align-middle col-md-1"><?= $pensionnaire['type_animal'] ?></td>
                    <td class="align-middle col-md-1"><?= $pensionnaire['sexe'] == 1 ? "Mâle" : "Femelle" ?></td>
                    <td class="align-middle col-md-5"><?= previewArticle($pensionnaire['description_animal'], 50) . " [...]" ?></td>
                    <td class="align-middle col-md-1 m-0 p-1" style="max-height: 100px;">
                        <img src="public/content/images/<?= empty($pensionnaire['image']['url_image']) ? "others/no-img.png" : "website/" . $pensionnaire['image']['url_image'] ?>" class="img-fluid img-thumbnail m-0" style="height:100px;">
                    </td>
                    <td class="align-middle">
                        <a href="<?= URL ?>adminModifPensionnaire&m=<?= $pensionnaire['id_animal'] ?>" class="btn btn-block btn-warning btnHover" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td class="align-middle">
                        <a href="<?= URL ?>adminPensionnaire&d=<?= $pensionnaire['id_animal'] ?>" class="btn btn-block btn-danger btnHover" title="Supprimer">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
require("views/template.php");
?>