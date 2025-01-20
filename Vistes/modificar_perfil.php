<?php
# Alberto González Benítez, 2n DAW, Pràctica 05 - Social Authentication & Miscel·lània
session_start();
require_once '../Model/UsuariModel.php';


if (!isset($_SESSION['usuari'])) {
    header("Location: ../Login/login.php");
    exit();
}
$usuari = $_SESSION['usuari'];
$dadesUsuari = obtenirUsuariPerNom($usuari);

// Imatge de perfil per defecte
$imatgePerfil = $dadesUsuari['imatge'] ?? '../Imatges/def_user.jpeg';
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/estils.css">
    <title>Modificar Perfil</title>
</head>
<body class="fons_modificar_perfil">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="text-center mb-4">
                    <img src="<?= htmlspecialchars($imatgePerfil) ?>" alt="Avatar" class="rounded-circle" width="150" height="150">
                </div>
                <form action="../Controlador/modificar_perfil_cont.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nova_imatge" class="form-label">Canviar imatge de perfil</label>
                        <input type="file" name="nova_imatge" id="nova_imatge" class="form-control" accept=".png, .jpg, .jpeg, .webp">
                    </div>
                    <div class="mb-3">
                        <label for="nou_nom" class="form-label">Nom d'usuari</label>
                        <input type="text" name="nou_nom" id="nou_nom" class="form-control" value="<?= htmlspecialchars($dadesUsuari['usuari']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="correu" class="form-label">Correu electrònic</label>
                        <input type="email" id="correu" class="form-control" value="<?= htmlspecialchars($dadesUsuari['correo']) ?>" disabled>
                    </div>

                        <?php
                        // Mostrar mensajes de error o éxito si existen
                        if (isset($_SESSION['missatge'])) {
                            echo "<div class='alert alert-danger alert-custom' role='alert'>" . $_SESSION['missatge'] . "</div>";
                            unset($_SESSION['missatge']);
                        }

                        if (isset($_SESSION['missatge_exit'])) {
                            echo "<div class='alert alert-success alert-custom' role='alert'>" . $_SESSION['missatge_exit'] . "</div>";
                            unset($_SESSION['missatge_exit']);
                        }
                        ?>


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Modificar</button>
                        <a href="../Vistes/index_usuari.php">
                        <button type="button" class="btn btn-primary btn-lg btn-block" role="button">Anar enrere</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
