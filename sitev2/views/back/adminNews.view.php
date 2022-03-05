<?php
ob_start();
?>
<?= styleTitleLevel1("Gestion des News", COLOR_TITLE_CONSEILS); ?>

<?php
/* echo "<pre>";
print_r($lastActus);
echo "</pre>";

echo "<pre>";
print_r($imageActuUrl);
echo "</pre>"; */
?>

<div class="row mt-2 mt-md-3 mt-lg-5 text-center">
    <div class="col-12 col-md mb-1 mb-md-0 text-center">
        <a href="adminAddNews" class="btn btn-lg btn-primary p-1 p-md-2"><i class="fas fa-plus-circle"></i>&nbsp;Ajouter une actualité</a>
    </div>
</div>

<div class="row no-gutters mt-2 mt-md-3 mt-lg-5">
    <table class="d-none d-md-block table table-striped table-bordered align-items-center">
        <thead class="thead-dark text-center align-items-center">
            <tr class="h6">
                <th class="align-middle" scope="col">Titre </th>
                <th class="align-middle" scope="col">Date de publication</th>
                <th class="align-middle" scope="col">Extrait contenu</th>
                <th class="align-middle" scope="col">Type</th>
                <th class="align-middle" scope="col" class="col-md-2">Image liée</th>
                <th class="align-middle" colspan="2" scope="col" class="col-md-2"> Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lastActus as $actu) : ?>
                <tr class="text-center <?= $bgColorActu = displayColorActuFromType($actu['type_actualite']) ?>">
                    <td class="align-middle col-md-2 font-weight-bold"><?= $actu['libelle_actualite'] ?></td>
                    <td class="align-middle col-md-1"><?= date("d/m/Y", strtotime($actu['date_publication_actualite'])) ?></td>
                    <td class="align-middle col-md-5"><?= previewArticle($actu['contenu_actualite'], 50) . " [...]" ?></td>
                    <td class="align-middle col-md-1"><?= $actu['type_actualite'] ?></td>
                    <td class="align-middle col-md-1 m-0 p-1" style="max-height: 100px;">
                        <img src="public/content/images/website/<?= $actu['url']['url_image'] ?>" class="img-fluid img-thumbnail m-0" style="height:100px;">
                    </td>
                    <td class="align-middle">
                        <a href="<?= URL ?>adminModifNews&m=<?= $actu['id_actualite'] ?>" class="btn btn-block btn-warning btnHover" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td class="align-middle">
                        <a href="<?= URL ?>adminNews&d=<?= $actu['id_actualite'] ?>" class="btn btn-block btn-danger btnHover" title="Supprimer" data-toggle="modal" data-target="#modalDeleteActu">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDeleteActu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h6" id="exampleModalLabel">Confirmer la suppression de l'actualité sélectionné ? </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $actu['id_actualite'] ?>
            </div>
            <div class="modal-footer">
                <a href="adminNews?d=<?= $actu['id_actualite'] ?>" class="btn btn-lg btn-warning" title="Supprimer">
                    <i class="fas fa-trash-alt"></i>
                </a>
                <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require("views/template.php");
?>