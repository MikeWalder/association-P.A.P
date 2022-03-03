<?php
ob_start();
?>
<?= styleTitleLevel1("Gestion des pensionnaires", COLOR_TITLE_CONSEILS); ?>



<?php
$content = ob_get_clean();
require("views/template.php");
?>