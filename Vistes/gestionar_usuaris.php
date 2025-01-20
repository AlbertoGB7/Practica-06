<?php
# Alberto González Benítez, 2n DAW, Pràctica 05 - Social Authentication & Miscel·lània
session_start();
require_once "../Model/UsuariModel.php";
include "navbar_view.php";

if (!isset($_SESSION['usuari']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index_usuari.php");
    exit();
}

$usuaris = obtenirTotsElsUsuaris(); // Recuperar tots els usuaris de la BD
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../CSS/estils.css">
    <title>Gestionar Usuaris</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="titol_elim_usuaris">Gestió d'Usuaris</h1>

    <!-- Mostrar el missatge de èxit si s'ha eliminat un usuari -->
    <?php if (isset($_SESSION['missatge_exit'])): ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['missatge_exit'] ?>
        </div>
        <?php unset($_SESSION['missatge_exit']); // Eliminar el missatge després de mostrar-lo ?>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom d'Usuari</th>
                <th>Correu</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuaris as $usuari): ?>
                <tr>
                    <td><?= htmlspecialchars($usuari['usuari']) ?></td>
                    <td><?= htmlspecialchars($usuari['correo']) ?></td>
                    <td>
                        <?php if ($usuari['rol'] !== 'admin'): ?>
                            <form method="POST" action="../Controlador/eliminar_usuari.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $usuari['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        <?php else: ?>
                            <span class="text-muted">No es pot eliminar</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div>
    <a href="../Vistes/index_usuari.php">
        <button type="button" class="tornar" role="button">Anar enrere</button>
    </a>
</div>

</body>
</html>
