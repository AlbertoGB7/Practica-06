<?php
# Alberto González Benítez, 2n DAW, Pràctica 06 - APIRest, Ajax i codis QR
include '../Controlador/verificar_sessio.php';
include 'navbar_view.php';
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pujar QR</title>
    <link rel="stylesheet" href="../CSS/estils.css">
</head>
<body>
    <div class="container">
        <br><br><br><h3 class="titol_canvi_pass">Pujar QR</h3>

        <form action="../Controlador/procesar_qr.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="file" name="qr_file" id="qr_file" class="form-control" accept=".png, .jpg, .jpeg">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Leer QR</button>
            </div>

            
        </form>

        <a href="vistaAjax.php">
            <button type="button" class="tornar">Ver artículos compartidos</button>
        </a>
    </div>
</body>
</html>
