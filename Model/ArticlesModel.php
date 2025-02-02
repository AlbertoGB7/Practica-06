<?php
# Alberto González Benítez, 2n DAW, Pràctica 04 - Inici d'usuaris i registre de sessions

//eliminar.php

// Funció per buscar un article per ID i usuari
function buscarArticlePerUsuari($id, $user_id, $connexio) {
    $select = $connexio->prepare('SELECT * FROM articles WHERE id = ? AND usuari_id = ?');
    $select->execute([$id, $user_id]);
    return $select->fetch();
}

// Funció per verificar si l'usuari és propietari de l'article
function verificarPropietatArticle($id, $user_id, $connexio) {
    $checkOwnership = $connexio->prepare('SELECT * FROM articles WHERE id = ? AND usuari_id = ?');
    $checkOwnership->execute([$id, $user_id]);
    return $checkOwnership->rowCount() > 0;
}

// Funció per eliminar un article
function eliminarArticle($id, $connexio) {
    $delete = $connexio->prepare('DELETE FROM articles WHERE id = ?');
    return $delete->execute([$id]);
}

// Funció per eliminar un article de la taula "articles_compartits"
function eliminarArticleCompartit($id, $connexio) {
    $delete = $connexio->prepare('DELETE FROM articles_compartits WHERE id = ?');
    return $delete->execute([$id]);
}


// insertar.php

// Funció per verificar si l'article ja existeix
function verificarArticle($titol, $cos, $connexio) {
    $select = $connexio->prepare('SELECT * FROM articles WHERE titol = ? AND cos = ?');
    $select->execute([$titol, $cos]);
    return $select->rowCount() > 0;
}

// Funció per inserir un article
function inserirArticle($titol, $cos, $usuari_id, $connexio) {
    $insert = $connexio->prepare("INSERT INTO articles(titol, cos, usuari_id) VALUES (?, ?, ?)");
    return $insert->execute([$titol, $cos, $usuari_id]);
}

// Funció per verificar si un article existeix segons ID i usuari
function obtenirArticlePerIDiUsuari($id, $usuari_id, $connexio) {
    $select = $connexio->prepare('SELECT * FROM articles WHERE id = ? AND usuari_id = ?');
    $select->execute([$id, $usuari_id]);
    return $select->fetch(PDO::FETCH_ASSOC);
}

// Funció per actualitzar un camp d'un article
function modificarArticle($id, $usuari_id, $nou_valor, $camp, $connexio) {
    $update = $connexio->prepare("UPDATE articles SET $camp = ? WHERE id = ? AND usuari_id = ?");
    return $update->execute([$nou_valor, $id, $usuari_id]);
}

// modificar.php

function obtenirTotalArticlesUsuari($usuari_id, $connexio) {
    $stmt = $connexio->prepare('SELECT COUNT(*) FROM articles WHERE usuari_id = :usuari_id');
    $stmt->bindValue(':usuari_id', $usuari_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function obtenirArticlesPaginats($usuari_id, $offset, $articles_per_pagina, $connexio) {
    $stmt = $connexio->prepare("SELECT ID, titol, cos, data FROM articles WHERE usuari_id = :usuari_id LIMIT :offset, :articles_per_pagina");
    $stmt->bindValue(':usuari_id', $usuari_id, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':articles_per_pagina', $articles_per_pagina, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// mostrar.php:

function obtenirTotalArticles($connexio) {
    // Obtener el número total de artículos
    $query = 'SELECT COUNT(*) FROM articles';
    $stmt = $connexio->query($query);
    return $stmt->fetchColumn();
}

// SU: senseUsuari

function obtenirArticlesPaginatsSU($offset, $articles_per_pagina, $connexio) {
    $stmt = $connexio->prepare("SELECT * FROM articles LIMIT :offset, :articles_per_pagina");
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':articles_per_pagina', $articles_per_pagina, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Usar FETCH_ASSOC
}

// ORDENAR:

// Ordenar Articles:

// Función para obtener artículos ordenados por título ascendente
function obtenirArticlesOrdenatsPerTitolAsc($offset, $limit, $connexio) {
    $sql = "SELECT * FROM articles ORDER BY titol ASC LIMIT :offset, :limit";
    $stmt = $connexio->prepare($sql);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener artículos ordenados por título descendente
function obtenirArticlesOrdenatsPerTitolDesc($offset, $limit, $connexio) {
    $sql = "SELECT * FROM articles ORDER BY titol DESC LIMIT :offset, :limit";
    $stmt = $connexio->prepare($sql);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener artículos ordenados por fecha ascendente
function obtenirArticlesOrdenatsPerDataAsc($offset, $limit, $connexio) {
    $sql = "SELECT * FROM articles ORDER BY data ASC LIMIT :offset, :limit";
    $stmt = $connexio->prepare($sql);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener artículos ordenados por fecha descendente
function obtenirArticlesOrdenatsPerDataDesc($offset, $limit, $connexio) {
    $sql = "SELECT * FROM articles ORDER BY data DESC LIMIT :offset, :limit";
    $stmt = $connexio->prepare($sql);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Funció per obtenir el total d'articles

function cercarArticles($terme, $connexio) {
    $sql = "SELECT * FROM articles WHERE titol LIKE :terme";
    $stmt = $connexio->prepare($sql);
    $stmt->bindValue(':terme', '%' . $terme . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Funció per obtenir el total d'articles per un usuari amb cerca

function obtenirTotalArticlesUsuariCercar($usuari_id, $terme, $connexio) {
    $sql = "SELECT COUNT(*) 
            FROM articles 
            WHERE usuari_id = :usuari_id 
              AND (titol LIKE :terme)";
    $stmt = $connexio->prepare($sql);
    $stmt->bindValue(':usuari_id', $usuari_id, PDO::PARAM_INT);
    $stmt->bindValue(':terme', '%' . $terme . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
}

// Funció per obtenir els articles paginats amb cerca
function obtenirArticlesPaginatsCercar($usuari_id, $offset, $articles_per_pagina, $terme, $connexio) {
    $sql = "SELECT * 
            FROM articles 
            WHERE usuari_id = :usuari_id 
              AND (titol LIKE :terme) 
            LIMIT :offset, :articles_per_pagina";
    $stmt = $connexio->prepare($sql);
    $stmt->bindValue(':usuari_id', $usuari_id, PDO::PARAM_INT);
    $stmt->bindValue(':terme', '%' . $terme . '%', PDO::PARAM_STR);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':articles_per_pagina', $articles_per_pagina, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ARTICLES COMPARTITS:

function obtenirArticlesCompartits($connexio) {
    $sql = "SELECT ac.id, ac.titol, ac.cos, ac.font_origen, u.usuari
            FROM articles_compartits ac
            JOIN usuaris u ON ac.usuari_id = u.id
            ORDER BY ac.font_origen ASC";
    $stmt = $connexio->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



function comprovarArticleCompartit($article_id, $connexio) {
    $sql = "SELECT COUNT(*) FROM articles_compartits WHERE id = ?";
    $stmt = $connexio->prepare($sql);
    $stmt->execute([$article_id]);
    return $stmt->fetchColumn() > 0;
}

function compartirArticle($article_id, $usuari_id, $connexio) {
    // Obtener los datos del artículo original
    $sql = "SELECT titol, cos FROM articles WHERE ID = ?";
    $stmt = $connexio->prepare($sql);
    $stmt->execute([$article_id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($article) {
        // Insertar el artículo en la tabla de artículos compartidos
        $sql = "INSERT INTO articles_compartits (article_id, usuari_id, titol, cos, data_compartit) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $connexio->prepare($sql);
        return $stmt->execute([$article_id, $usuari_id, $article['titol'], $article['cos']]);
    }

    return false; // Si el artículo original no existe
}


function copiarArticle($article_id, $user_id, $connexio) {
    // Obtenemos los datos del artículo compartido
    $sql = "SELECT titol, cos FROM articles_compartits WHERE id = ?";
    $stmt = $connexio->prepare($sql);
    $stmt->execute([$article_id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($article) {
        // Obtenemos los datos modificados del formulario (si existen)
        $titol_modificat = isset($_POST['titol']) ? $_POST['titol'] : $article['titol'];
        $cos_modificat = isset($_POST['cos']) ? $_POST['cos'] : $article['cos'];

        // Insertamos el artículo con los datos modificados
        return inserirArticle($titol_modificat, $cos_modificat, $user_id, $connexio);
    }

    return false; // Si no encontramos el artículo
}



function verificarArticleCompartit($article_id, $connexio) {
    $sql = "SELECT COUNT(*) FROM articles_compartits WHERE article_id = ?";
    $stmt = $connexio->prepare($sql);
    $stmt->execute([$article_id]);
    return $stmt->fetchColumn() > 0; // Devuelve true si ya existe
}

function obtenirArticleCompartit($article_id, $connexio) {
    $sql = "SELECT titol, cos FROM articles_compartits WHERE id = :article_id";
    $stmt = $connexio->prepare($sql);
    $stmt->bindValue(':article_id', $article_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function obtenirArticlePerId($id, $connexio) {
    $stmt = $connexio->prepare('SELECT * FROM articles WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function inserirArticleCompartit($titol, $cos, $usuari_id, $connexio) {
    $sql = "INSERT INTO articles_compartits (usuari_id, titol, cos, data_compartit, font_origen) VALUES (?, ?, ?, NOW(), 'qr')";
    $stmt = $connexio->prepare($sql);
    return $stmt->execute([$usuari_id, $titol, $cos]);
}



?>
