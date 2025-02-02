<?php
# api.php

require_once '../Model/connexio.php';
require_once 'api_controlador.php';

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

$db = connectarBD();
$controller = new ApiControlador($db);

$action = strtolower($method) . ucfirst($request[0]);

if (method_exists($controller, $action)) {
    echo json_encode($controller->$action($request));
} else {
    http_response_code(404);
    echo json_encode(["error" => "Endpoint no encontrado"]);
}