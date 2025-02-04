<?php
# Alberto González Benítez, 2n DAW, Pràctica 06 - APIRest, Ajax i codis QR

session_start();


session_destroy();

// Establim la cookie
setcookie('logout_exitos', '1', time() + 3600, '/');

header("Location: ../index.php");

exit();
?>
