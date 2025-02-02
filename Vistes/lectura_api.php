<?php
# Vistes/lectura_api.php

require_once '../Controlador/lectura_api_controlador.php';

$controlador = new LecturaApiControlador();

// Obtener datos de la API
$clanTag = '#2VL90JP0'; // Ejemplo de tag de clan
$playerTag = '#RJPYYL0V'; // Ejemplo de tag de jugador

$clanInfo = $controlador->obtenerInfoClan($clanTag);
$playerInfo = $controlador->obtenerInfoJugador($playerTag);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clash of Clans API</title>
    <link rel="stylesheet" href="../CSS/estils.css">
</head>
<body>
    <h1>Perfil Clash of Clans</h1>
    <a href="../Vistes/index_usuari.php">
                <button type="button" class="tornar" role="button">Anar enrere</button>
            </a>
    <div class="container">
        <!-- Sección Clanes -->
        <div class="card">
            <h2>Clan</h2>
            <?php if ($clanInfo): ?>
                <img src="<?= $clanInfo['badgeUrls']['large'] ?>" alt="Clan Badge">
                <p><strong>Nom:</strong> <?= $clanInfo['name'] ?></p>
                <p><strong>Nivell:</strong> <?= $clanInfo['clanLevel'] ?></p>
                <p><strong>Membres:</strong> <?= $clanInfo['members'] ?></p>
            <?php else: ?>
                <p class="error">No s'ha pogut obtenir la informació.</p>
            <?php endif; ?>
        </div>

        <!-- Sección Jugadores -->
        <div class="card">
            <h2>Jugador</h2>
            <?php if ($playerInfo): ?>
                <img src="https://api-assets.clashofclans.com/leagues/72/<?= $playerInfo['league']['id'] ?>.png" alt="Player League">
                <p><strong>Nom:</strong> <?= $playerInfo['name'] ?></p>
                <p><strong>Nivell:</strong> <?= $playerInfo['expLevel'] ?></p>
                <p><strong>Copes:</strong> <?= $playerInfo['trophies'] ?></p>
            <?php else: ?>
                <p class="error">No s'ha pogut obtenir la informació.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>