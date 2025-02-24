<?php
# Alberto González Benítez, 2n DAW, Pràctica 06 - APIRest, Ajax i codis QR

require_once '../Controlador/lectura_api_controlador.php';

$controlador = new LecturaApiControlador();


$clanTag = '#2VL90JP0'; // tag clan
$playerTag = '#RJPYYL0V'; // tag player

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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Perfil Clash of Clans</h1>
    <a href="../Vistes/index_usuari.php">
        <button type="button" class="tornar" role="button">Anar enrere</button>
    </a>

    <div class="estil_lectura_api">
        <div class="estil_lectura_api_clan">
            <h2>Clan</h2>
            <?php if ($clanInfo): ?>
                <img alt="Clan Badge" src="<?= $clanInfo['badgeUrls']['large'] ?>">
                <p><strong>Nom:</strong> <?= $clanInfo['name'] ?></p>
                <p><strong>Nivell:</strong> <?= $clanInfo['clanLevel'] ?></p>
                <p><strong>Membres:</strong> <?= $clanInfo['members'] ?></p>
            <?php else: ?>
                <p class="error">No s'ha pogut obtenir la informació.</p>
            <?php endif; ?>
        </div>

        <div class="estil_lectura_api_jugador">
            <h2>Jugador</h2>
            <?php if ($playerInfo): ?>
                <img alt="Player League" src="https://api-assets.clashofclans.com/leagues/72/<?= $playerInfo['league']['id'] ?>.png">
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
