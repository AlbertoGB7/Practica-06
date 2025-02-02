<?php

require 'vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
require_once '../Model/connexio.php';
require_once '../Model/ArticlesModel.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conectar a la base de datos y obtener el artículo
    $connexio = connectarBD();
    $article = obtenirArticlePerId($id, $connexio); // Asegúrate de que esta función obtiene los datos correctos

    if ($article) {
        // Crear un JSON con los datos
        $contenido = json_encode([
            'titol' => $article['titol'],
            'cos' => $article['cos']
        ]);

        // Crear el objeto QR
        $qr_Code = new QrCode($contenido);
        $qr_Code->setSize(300);

        // Crear el escritor PNG
        $writer = new PngWriter();
        $qrImage = $writer->write($qr_Code);

        // Definir el nombre del archivo para la descarga
        $file_name = md5(uniqid()) . '.png';

        // Configurar los encabezados para forzar la descarga
        header('Content-Type: image/png');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');

        // Enviar la imagen generada
        echo $qrImage->getString();
        exit;
    } else {
        echo "No se encontró el artículo.";
    }
} else {
    echo "No se han recibido los parámetros necesarios.";
}

?>
