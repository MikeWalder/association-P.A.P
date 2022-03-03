<?php
ob_start();
?>
<?= styleTitleLevel1("Login partie administrateur", COLOR_TITLE_CONTACT); ?>

<div class="m-3 m-md-5">
    <form action="" method="POST">
        <div class="form-group no-gutters row align-items-center">
            <div class="col-md-3"></div>
            <label for="login" class="col-3 col-md-2">Login : </label>
            <input type="text" class="col-6 col-md-4 col-lg-4 pl-2 form-control" id="login" name="login" required>
        </div>
        <div class="form-group no-gutters row align-items-center">
            <div class="col-md-3"></div>
            <label for="password" class="col-3 col-md-2">Password : </label>
            <input type="password" class="col-6 col-md-4 col-lg-4 pl-2 form-control" id="password" name="password" required>
        </div>
        <div class="row no-gutters">
            <div class="col-md-2 col-lg-3"></div>
            <input type="submit" class="btn btn-primary btn-block col-md-6 col-md-8 col-lg-6" value="Valider">
        </div>
    </form>
</div>

<?php
if (!empty($alert)) {
?>
    <div class="alert- alert-danger text-center p-3" role="alert">
        <?= $alert ?>
    </div>
<?php
}
?>


<?php
$content = ob_get_clean();
require("views/template.php");
?>