<?php
ob_start();
?>

<?= styleTitleLevel1("Contact", COLOR_TITLE_CONTACT) ?>

<div class="ml-2">
    <?= styleTitleLevel3("Suivez nous", COLOR_TITLE_CONTACT, "text-left") ?>
</div>
<p class="ml-2">
    Suivez-nous sur facebook et participez à l'aventure de Pattes à Pouffes
</p>
<div class="row">
    <div class="col-6 mt-2">
        <div class="mx-auto text-center">
            <a href="facebook.fr" target="_blank" class="btn btn-info">
                <i class="fab fa-facebook"></i>&nbsp;Notre Facebook
            </a>
        </div>
    </div>
</div>

<div class="ml-2">
    <?= styleTitleLevel3("Contactez nous ", COLOR_TITLE_CONTACT, "text-left") ?>
</div>
<div class="ml-2">
    <i class="fas fa-envelope-open-text fa-lg"></i>&nbsp; Par courrier : P.A.P. - Centre Alsace - 67600 Ebersheim, Bas-Rhin, France<br><br>
    <i class="fas fa-mail-bulk fa-lg"></i>&nbsp; Par mail : <a href="accueil.pap@gmail.com" target="_blank">Pattes à Pouffes</a><br><br>
    <i class="fas fa-mobile-alt fa-lg"></i>&nbsp;&nbsp; Par téléphone : 06 10 59 94 71<br>
</div>

<div class="ml-2">
    <?= styleTitleLevel3("Formulaire de contact", COLOR_TITLE_CONTACT, "text-left") ?>
</div>

<form action="#" method="POST" class="ml-2">
    <div class="form-group row no-gutters align-items-center">
        <label for="nom" class="col-2">Nom :</label>
        <input type="text" name="nom" id="nom" class="form-control col" placeholder="nom" required>
    </div>
    <div class="form-group row no-gutters align-items-center">
        <label for="email" class="col-2">Email :</label>
        <input type="email" name="email" id="email" class="form-control col" placeholder="nom@exemple.com" required>
    </div>
    <div class="form-group row no-gutters align-items-center">
        <label for="objet" class="col-2">Objet :</label>
        <select class="form-control col" id="objet" name="objet">
            <option value="question">Question</option>
            <option value="adoption">Adoption</option>
            <option value="donnation">Donnation</option>
            <option value="autre">Autre</option>
        </select>
    </div>
    <div class="form-group no-gutters">
        <label for="message">Message :</label>
        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
    </div>
    <div class="form-group no-gutters align-items-center">
        <label for="verif">Combien font 4 + 4 :</label>
        <input type="number" name="verif" id="verif" class="form-control col" required>
    </div>
    <input type="submit" class="btn btn-primary btn-lg mx-auto d-block my-3" value="Valider">
</form>

<?php
// Traitement formulaire de contact

if (
    isset($_POST['nom']) && !empty($_POST['nom']) &&
    isset($_POST['email']) && !empty($_POST['email']) &&
    isset($_POST['objet']) && !empty($_POST['objet']) &&
    isset($_POST['message']) && !empty($_POST['message']) &&
    isset($_POST['verif']) && !empty($_POST['verif'])
) {
    $captcha = (int)$_POST['verif'];

    if ($captcha === 8) {
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $objet = htmlspecialchars($_POST['objet']);
        $message = htmlspecialchars($_POST['message']);

        $dest = "mike_walder@hotmail.fr";
        mail($dest, $objet . " - " . $nom,  "Mail : " . $email . "Message : " . $message);

        echo "<div class='alert alert-success text-center my-2'>Formulaire bien posté !</div>";
    } else {
        echo "<div class='alert alert-danger text-center my-2'>Captcha invalide !</div>";
    }
}
?>

<?php
$content = ob_get_clean();
require_once("views/template.php");
?>