<?php
# Alberto González Benítez, 2n DAW, Pràctica 06 - APIRest, Ajax i codis QR
include '../Controlador/verificar_sessio.php';
require_once "../Model/connexio.php";
require_once "../Model/ArticlesModel.php";

$connexio = connectarBD();

if (isset($_GET['article_id'])) {
    $article_id = intval($_GET['article_id']);

    // Obtener el artículo desde la tabla "articles_compartits"
    $article = obtenirArticleCompartit($article_id, $connexio);

    if (!$article) {
        die("No s'ha trobat l'article.");
    }
} else {
    die("Falta l'ID de l'article.");
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copiar Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/estils.css">
    <link rel="stylesheet" href="../CSS/estil_formulari.css"> <!-- Enlace al segundo archivo CSS -->
</head>
<body style="background: #6868AC">
    <form method="POST" action="../Controlador/controladorAjax.php">
        <div class="form">
            <div class="title">Copiar Article</div>
            <div class="subtitle">Modifica el títol i el cos de l'article</div>

            <input type="hidden" name="action" value="copiar_article">
            <input type="hidden" name="article_id" value="<?= htmlspecialchars($article_id) ?>">

            <div class="input-container ic2">
                <input name="titol" id="titol" class="input" type="text" placeholder=" " value="<?= htmlspecialchars($article['titol']) ?>" required />
                <div class="cut"></div>
                <label for="titol" class="placeholder">Títol</label>
            </div>
            <div class="input-container ic2">
                <textarea name="cos" id="cos" class="input textarea" placeholder=" " required><?= htmlspecialchars($article['cos']) ?></textarea>
                <div class="cut cut-short"></div>
                <label for="cos" class="placeholder">Cos</label>
            </div>

            <button type="submit" class="insertar">Copiar</button>
        </div>
    </form>

    <div>
        <a href="../Vistes/index_usuari.php">
            <button type="button" class="tornar" role="button">Anar enrere</button>
        </a>
    </div>
</body>
</html>