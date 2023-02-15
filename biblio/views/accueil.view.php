<?php ob_start()
?>

Ici page acc

<?php
$content=ob_get_clean();
$titre="Bibliothèque MGA";
require "template.php";
?>