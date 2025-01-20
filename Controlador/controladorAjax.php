<?php
require_once "../Model/connexio.php";
require_once "../Model/ArticlesModel.php";
include 'verificar_sessio.php';

$connexio = connectarBD();

// Verifica si l'acció és compartir article
if (isset($_GET['action']) && $_GET['action'] === 'compartir_article' && isset($_GET['article_id'])) {
    $article_id = intval($_GET['article_id']);
    $usuari_id = $_SESSION['user_id']; // ID del usuario en sesión

    // Verifica que el usuario es propietario del artículo
    if (verificarPropietatArticle($article_id, $usuari_id, $connexio)) {
        // Comprueba si el artículo ya ha sido compartido
        if (!verificarArticleCompartit($article_id, $connexio)) {
            // Comparte el artículo
            if (compartirArticle($article_id, $usuari_id, $connexio)) {
                $_SESSION['missatge_exit'] = "¡El artículo se ha compartido exitosamente!";
            } else {
                $_SESSION['missatge'] = "Hubo un error al compartir el artículo.";
            }
        } else {
            $_SESSION['missatge'] = "Este artículo ya ha sido compartido.";
        }
    } else {
        $_SESSION['missatge'] = "No tienes permiso para compartir este artículo.";
    }

    // Redirigir a la vista principal de artículos
    header("Location: ../Controlador/mostrar_usuari.php");
    exit();
}


?>
