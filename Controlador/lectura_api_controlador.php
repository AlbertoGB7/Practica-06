<?php
# Controlador/lectura_api_controlador.php

class LecturaApiControlador {
    private $apiKey;

    public function __construct() {
        $this->apiKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6ImU1NThmNzk1LWM2ZmItNDAzMS04ODRmLWM2NTQ1NDM2MjI4ZCIsImlhdCI6MTczODM0NzA5MSwic3ViIjoiZGV2ZWxvcGVyLzVmOGQ3MDhiLTlhYWQtMjhhOS01YzMwLWUzYjM1MjJlYzkyMiIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjk0LjEyNS45Ni4xMzciXSwidHlwZSI6ImNsaWVudCJ9XX0.yZmurWaTh1oHFPDkOOOZorUTnzPvYimFsoIjbaxb0Fpy9WFrTM3JmlZEbSoH1M9auFdwJlkA-KC9mk41Lq6fnw'; // Reemplaza con tu API Key
    }

    // Función para hacer solicitudes a la API de Clash of Clans
    private function hacerSolicitud($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Authorization: Bearer ' . $this->apiKey
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }

    // Obtener información de un clan
    public function obtenerInfoClan($clanTag) {
        $url = "https://api.clashofclans.com/v1/clans/" . urlencode($clanTag);
        return $this->hacerSolicitud($url);
    }

    // Obtener información de un jugador
    public function obtenerInfoJugador($playerTag) {
        $url = "https://api.clashofclans.com/v1/players/" . urlencode($playerTag);
        return $this->hacerSolicitud($url);
    }
}