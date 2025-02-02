<?php
require_once "../Model/connexio.php";
require_once "../Model/ArticlesModel.php";
include 'verificar_sessio.php';

$connexio = connectarBD();

if (isset($_GET['action']) && $_GET['action'] === 'obtenir_articles') {
    $articles = obtenirArticlesCompartits($connexio);
    header('Content-Type: application/json');
    echo json_encode($articles);
    exit();
}

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
                $_SESSION['missatge_exit'] = "Article compartit exitosament!";
            } else {
                $_SESSION['missatge'] = "Hi ha hagut un error al compartir l'article.";
            }
        } else {
            $_SESSION['missatge'] = "Aquest article ja ha sigut compartit.";
        }
    } else {
        $_SESSION['missatge'] = "No tens permís per compartir aquest article.";
    }

    // Redirigir a la vista principal de artículos
    header("Location: ../Controlador/mostrar_usuari.php");
    exit();
}

// Verifica si l'acció és copiar article
if (isset($_POST['action']) && $_POST['action'] === 'copiar_article') {
    $article_id = intval($_POST['article_id']);
    $titol = trim($_POST['titol']);
    $cos = trim($_POST['cos']);
    $usuari_id = $_SESSION['user_id']; // ID del usuario en sesión

    // Elimina la verificación de propiedad del artículo
    // Ahora, cualquier usuario puede copiar el artículo
    if (copiarArticle($article_id, $usuari_id, $connexio)) {
        // Eliminar el artículo de la tabla "articles_compartits" después de copiarlo
        if (eliminarArticleCompartit($article_id, $connexio)) {
            $_SESSION['missatge_exit'] = "Article copiat i eliminat correctament!";
        } else {
            $_SESSION['missatge'] = "Error al eliminar l'article de la taula 'articles_compartits'.";
        }
    } else {
        $_SESSION['missatge'] = "Error al copiar l'article.";
    }

    // Redirigir a la vista principal
    header("Location: ../Vistes/vistaAjax.php");
    exit();
}


?>
