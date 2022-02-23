<?php
ob_start();
?>

<?= styleTitleLevel1("Informations sur la stérilisation des chats", COLOR_TITLE_CONSEILS) ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-5 p-2">
            <img class="img-fluid img-thumbnail" src="public/content/images/Others/sterilisation_chat.jpg" alt="Stérilisation chats">
        </div>
        <div class="col-7 p-2">
            <p class="h4 mb-3">
                Pourquoi la stérilisation est-elle un acte responsable ?
            </p>
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Par manque d’information ou victime d’idées reçues, vous vous interrogez encore sur l’intérêt de
            stériliser votre chat.<br>
            La stérilisation est l’une des solutions pour prévenir certains problèmes de santé, réduire des
            troubles comportementaux du chat et de la chatte et multiplier par deux leur espérance de vie. <br>
            Elle est un enjeu global de protection animale et gage de nombreux bénéfices tant pour la sérénité
            du propriétaire que pour la santé et le bien-être de son compagnon.<br>
            <br>
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Les chats stérilisés vivent 2 fois plus longtemps et se sociabilisent plus facilement.<br>
            En évitant les fugues et les bagarres, ils limitent les risques d’infection et la transmission
            de maladies graves.<br>
            <br>
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;L’espérance de vie du chat entier est plus courte que celle du
            chat castré. Lors des bagarres, l’animal peut contracter le virus de la leucose féline (FeLV) ou
            du sida du chat (FIV) à l’occasion de morsures ou de griffures.<br>
            <br>

        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once("views/template.php");
?>