<?php
ob_start();
if(!empty($_SESSION['alert'])):
?>
<div class="alert alert-<?=$_SESSION['alert']['type']?>" role="alert">
<?=$_SESSION['alert']['msg']?>
</div>
<?php 
unset($_SESSION['alert']);
endif;?>
<table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Titre</th>
        <th>Nombre de pages</th>
        <!-- Permet d'avoir 2 colonnes en une -->
        <th colspan="2">Actions</th>
    </tr>
    <!-- Va chercher dans la classe Livre, l'attribut livres (tableau des livres)  en faisant Livre::livres-->
    <?php 
    for($i=0;$i<count($livres);$i++): ?>
    <tr>
        <td class="align-middle"><img src="public/images/<?= $livres[$i]-> getImage() ?>" width="60px"></td>
        <td class="align-middle"><a href="<?=URL ?>livres/l/<?= $livres[$i]-> getId() ?>"><?= $livres[$i]-> getTitre() ?></td>
        <td class="align-middle"><?= $livres[$i]-> getNbPages() ?></td>
        <td class="align-middle"><a href="<?= URL ?>livres/m/<?= $livres[$i]->getId() ?>" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle"> 
            <!-- onSubmit pour confirmer la suprresion -->
            <form action="<?= URL ?>livres/s/<?= $livres[$i]->getId() ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer le livre ?')" method="POST">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    <?php endfor ?>
</table>
<a href="<?= URL ?>livres/a" class="btn btn-success d-block">Ajouter</a>

<?php
$content=ob_get_clean();
$titre="Les livres de la bibliothèque";
require "template.php";
?>