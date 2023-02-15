<?php ob_start()?>

<div class="row">
    <div class="col-6">
        <img src="<?=URL ?>public/images/<?= $livre->getImage() ?>">
    </div>
    <div class="col-6">
        <p>Titre : <?= $livre->getTitre() ?></p>
        <p>Nombre de pages : <?= $livre->getNbPages() ?></p>
    </div>
</div>

<?php
    $titre=$livre->getTitre();
    $content=ob_get_clean();
    require "template.php";
?>