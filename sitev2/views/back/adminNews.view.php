<?php
ob_start();
?>
<?= styleTitleLevel1("Gestion des News", COLOR_TITLE_CONSEILS); ?>

<div class="row mt-2 mt-md-3 mt-lg-5 text-center">
    <div class="col-12 col-md mb-1 mb-md-0 text-center">
        <a href="adminAddNews" class="btn btn-lg btn-primary p-1 p-md-2">Ajouter une actualité</a>
    </div>
</div>

<div class="row no-gutters mt-2 mt-md-3 mt-lg-5 mx-auto">
    <table class="d-none d-md-block table table-striped table-bordered">
        <thead class="thead-dark text-center">
            <tr class="h5">
                <th scope="col">Titre </th>
                <th scope="col">Date de publication</th>
                <th scope="col">Extrait contenu</th>
                <th scope="col">Type</th>
                <th scope="col">Image liée</th>
                <th colspan="2" scope="col" class="col-md-2"> Actions</th>
            </tr>
        </thead>
        <tbody class="">
            <tr class="text-center h6">
                <td>Titre 1 assez simplissime</td>
                <td>02/04/2022</td>
                <td>Un simple petit extrait de la new</td>
                <td>Type 1</td>
                <td>Image liée 1</td>
                <td><a href="" class="btn btn-block btn-warning pt-0 pb-0" title="Modify"><i class="fas fa-edit"></i></a></td>
                <td><a href="" class="btn btn-block btn-danger pt-0 pb-0" title="Delete"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
require("views/template.php");
?>