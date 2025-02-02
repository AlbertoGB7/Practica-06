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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Función para cargar los artículos de forma automática
            function carregarArticles() {
                fetch('../Controlador/controladorAjax.php?action=obtenir_articles')
                    .then(response => {
                        if (!response.ok) throw new Error("Error en la resposta del servidor.");
                        return response.json();
                    })
                    .then(articles => {
                        const tbody = document.querySelector(".fl-table tbody");
                        tbody.innerHTML = ""; // Limpia el contenido actual de la tabla
                        articles.forEach(article => {
                            const row = document.createElement("tr");
                            row.innerHTML = `
                                <td>${article.usuari}</td>
                                <td>${article.titol}</td>
                                <td>${article.cos}</td>
                                <td>${article.font_origen}</td>
                                <td>
                                    <a href="copiarAjax.php?article_id=${article.id}">
                                        <img src="../Imatges/copiar.png" alt="Copiar" style="width:24px; height:24px;">
                                    </a>
                                </td>
                            `;
                            tbody.appendChild(row);
                        });
                    })
                    .catch(error => console.error("Error carregant els articles:", error));
            }

            // Cargar los artículos automáticamente al cargar la página
            carregarArticles();
        });
    </script>

</head>
<body>
    <div class="container"><br><br>
    <h3 class="titol_canvi_pass">Articles Compartits</h3>
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
                <th>Font</th>
                <th>Acció</th>
            </tr>
        </thead>
        <tbody>

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
