<?php
// procesar_qr.php
include '../Controlador/verificar_sessio.php';
require_once "../Model/connexio.php";
require_once "../Model/ArticlesModel.php";
require_once '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['qr_file'])) {
    // Recibir archivo QR
    $qr_file = $_FILES['qr_file'];

    // Verificar que el archivo sea de tipo imagen
    if ($qr_file['error'] == 0 && in_array($qr_file['type'], ['image/png', 'image/jpeg'])) {
        // Procesar QR
        $qr_content = leerQR($qr_file['tmp_name']);

        if ($qr_content && isset($qr_content['titol']) && isset($qr_content['cos'])) {
            // Insertar artículo en la base de datos
            $connexio = connectarBD();
            $usuari_id = $_SESSION['user_id'];  // Suponiendo que tienes el ID de usuario en la sesión

            $insertado = inserirArticleCompartit($qr_content['titol'], $qr_content['cos'], $usuari_id, $connexio);

            if ($insertado) {
                $_SESSION['missatge_exit'] = "Artículo añadido correctamente desde el QR.";
            } else {
                $_SESSION['missatge'] = "Error al añadir el artículo.";
            }
        } else {
            $_SESSION['missatge'] = "QR inválido: no contiene los campos requeridos.";
        }
    } else {
        $_SESSION['missatge'] = "Archivo no válido.";
    }

    // Redirigir a vistaAjax.php
    header("Location: ../Vistes/vistaAjax.php");
    exit();
}

function leerQR($filePath) {
    // Cargar la librería ZXing
    require_once '../vendor/autoload.php';  // Ajusta la ruta si es necesario

    // Crear una instancia del lector de QR
    $reader = new \Zxing\QrReader($filePath);
    
    // Leer el código QR
    $decodedData = $reader->text();
    
    // Verificar si se logró leer el código QR
    if ($decodedData !== null) {
        // Decodificar los datos (asumimos que están en formato JSON)
        $data = json_decode($decodedData, true);
        
        // Comprobar si el QR contiene los campos 'titol' y 'cos'
        if (isset($data['titol']) && isset($data['cos'])) {
            return [
                'titol' => $data['titol'],
                'cos' => $data['cos']
            ];
        } else {
            // Si el QR no contiene los campos necesarios
            return null;
        }
    } else {
        // Si no se puede leer el QR
        return null;
    }
}


?>
