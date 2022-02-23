<?php
ob_start();
?>

<?= styleTitleLevel1("Attention aux températures !", COLOR_TITLE_CONSEILS) ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-5 p-2">
            <img class="img-fluid img-thumbnail" src="public/content/images/Others/temperatures.jpg" alt="Image températures">
        </div>
        <div class="col-7 p-2">
            <p class="h4">
                Vu les températures que nous subissons actuellement je pense qu'il est bon de rappeler ceci :
            </p>
            <ul>
                <li>Toujours laisser le chien dans une pièce aérée</li>
                <li>Faire de l’exercice avec lui tôt le matin ou tard dans la soirée</li>
                <li>Réduire l’activité aux heures les plus chaudes de la journée</li>
                <li>Garder le chien à l’intérieur, volets clos quand le soleil tape dans la journée</li>
                <li>Limiter les expositions au soleil en milieu de journée</li>
                <li>Donner au chien de l’eau fraîche à volonté et la laisser dans un lieu ombragé</li>
                <li>Quand la chaleur augmente brusquement (changement de saison ou de lieu d’habitat)
                    adaptez les activités de votre chien en fonction de la température pour limiter les risques</li>
                <li>Multipliez les jeux d’eau avec le chien pour le rafraîchir</li>
                <li>Ne laissez <strong>JAMAIS</strong> sous aucun prétexte votre chien seul enfermé dans la voiture.</li>
            </ul>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once("views/template.php");
?>