<?php
include '../Controlador/verificar_sessio.php';
include 'navbar_view.php';
require_once "../Model/connexio.php";
require_once "../Model/ArticlesModel.php";

$connexio = connectarBD();
$articles_compartits = obtenirArticlesCompartits($connexio);

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles Compartits</title>
    <link rel="stylesheet" href="../CSS/estils.css">
</head>
<body>
    <div class="container"><br><br>
        <h1>Articles Compartits</h1>
        <?php
        // Missatges d'èxit o error
        if (isset($_SESSION['missatge_exit'])) {
            echo "<p style='color: green; font-family: \"Calligraffitti\", cursive;'>" . ($_SESSION['missatge_exit']) . "</p>";
            unset($_SESSION['missatge_exit']);
        } elseif (isset($_SESSION['missatge'])) {
            echo "<p style='color: red; font-family: \"Calligraffitti\", cursive;'>" . ($_SESSION['missatge']) . "</p>";
            unset($_SESSION['missatge']);
        }
        ?>

<div class='table-wrapper'>
    <table class='fl-table'>
        <thead>
            <tr>
                <th>Usuari</th>
                <th>Títol</th>
                <th>Cos</th>
                <th>Acció</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles_compartits as $article): ?>
                <tr>
                    <td><?= htmlspecialchars($article['usuari']) ?></td>
                    <td><?= htmlspecialchars($article['titol']) ?></td>
                    <td><?= htmlspecialchars($article['cos']) ?></td>
                    <td>
                        <a href="../Controlador/controladorAjax.php?action=copiar_article&article_id=<?= $article['id'] ?>">
                            <img src="../Imatges/copiar.png" alt="Copiar" style="width:24px; height:24px;">
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


        <div>
            <a href="index_usuari.php">
                <button type="button" class="tornar" role="button">Anar enrere</button>
            </a>
        </div>
    </div>
</body>
</html>
