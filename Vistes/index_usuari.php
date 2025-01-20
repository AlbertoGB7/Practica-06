<?php
# Alberto González Benítez, 2n DAW, Pràctica 05 - Social Authentication & Miscel·lània

include '../Controlador/verificar_sessio.php';
include "../Vistes/navbar_view.php";

if (isset($_SESSION['usuari'])) {
    $usuari = $_SESSION['usuari'];
} else {
    $usuari = "Invitat";
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Pràctica 4</title>
    <link rel="stylesheet" type="text/css" href="../CSS/estils.css">
</head>

<body>
    <form method="POST" action="../Model/connexio.php">
        <h2>
            <p class="titol">Selecciona una opció</p>
            <br><br>

            <input type="submit" value="Insertar article" class="boto" name="insert" formaction="../Vistes/insertar.php">
            <input type="submit" value="Mostrar articles" class="boto" name="select" formaction="../Controlador/mostrar_usuari.php">
            <input type="submit" value="Modificar article" class="boto" name="modificar" formaction="../Vistes/modificar.php">
            <input type="submit" value="Eliminar article" class="boto" name="eliminar" formaction="../Vistes/eliminar.php">

            </form> <!-- Cierra el formulario principal -->

            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                <form method="POST" action="../Vistes/gestionar_usuaris.php" style="display:inline;">
                    <button type="submit" class="boto">Gestionar Usuaris</button>
                </form>
            <?php endif; ?>


        </h2>
    </form>

    <!-- Mostrem el missatge de benvinguda a l'usuari si esta la cookie -->
    <?php if (isset($_COOKIE['login_exitos'])): ?>
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <strong> <?php echo htmlspecialchars($usuari); ?></strong>, t'has loguejat amb èxit
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <!-- Eliminamos la cookie después de mostrar el mensaje -->
    <?php setcookie('login_exitos', '', time() - 3600, '/'); ?>
<?php endif; ?>

    
</body>

</html>
