<?php
function getPensionnaires() {
    require_once("models/pensionnaires.dao.php");
    
    $animaux = selectAnimalsFromStatut($_GET['idstatut']);
    
    function mainTitlePensionnaire($val)
    {
        $mainTitle = "";
        if ($val === TO_ADOPT) {
            $mainTitle = "Ils cherchent une famille";
        } else if ($val === IS_ADOPTED) {
            $mainTitle = "Les anciens";
        } else if ($val === FALD) {
            $mainTitle = "Famille d'accueil longue durée";
        }
        return $mainTitle;
    }
    
    $text = mainTitlePensionnaire($_GET['idstatut']);
    
    foreach ($animaux as $key => $animal) {
        $image = selectFirstImageFromIdAnimal($animal['id_animal']);
        $animaux[$key]['image'] = $image;
    
        $caracteres = selectCaracteresFromIdAnimal($animal['id_animal']);
        $animaux[$key]['caracteres'] = $caracteres;
    }

    require_once("views/pensionnaires.view.php");
}
