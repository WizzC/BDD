<?php ob_start()
?>

<form method="POST" action="<?= URL ?>livres/av" enctype="multipart/form-data">
<!-- enctype="multipart/form-data" obliger de le mettre quand on charge un fichier -->
    <div class="form-group">
        <label for="Titre">Titre :</label>
        <input type="text" class="form-control" id="Titre" name="Titre">
        <!-- id sert pour js et css -->
    </div>
    <div class="form-group">
        <label for="nbPages">Nombre de pages :</label>
        <input type="number" class="form-control" id="nbPages" name="nbPages">
    </div>
    <div class="form-group">
        <label for="image" class="form-label">Image :</label>
        <input class="form-control-file" type="file" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php
$content = ob_get_clean();
$titre = "Ajout d'un livre";
require "template.php";
?>