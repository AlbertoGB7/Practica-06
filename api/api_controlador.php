<?php
# Alberto González Benítez, 2n DAW, Pràctica 06 - APIRest, Ajax i codis QR

require_once '../Model/ArticlesModel.php';

class ApiControlador {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // GET Articles
    public function getArticles($request) {
        $user_id = isset($request[1]) ? $request[1] : null;
        $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

        if ($user_id) {
            $articles = obtenirArticlesPaginats($user_id, $offset, $limit, $this->db);
        } else {
            $articles = obtenirArticlesPaginatsSU($offset, $limit, $this->db);
        }

        return $articles;
    }

    // POST Articles
    public function postArticles($request) {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['titol'], $data['cos'], $data['usuari_id'])) {
            $result = inserirArticle($data['titol'], $data['cos'], $data['usuari_id'], $this->db);
            return ["success" => $result];
        } else {
            http_response_code(400);
            return ["error" => "Datos incompletos"];
        }
    }

    // PUT Articles
    public function putArticles($request) {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id'], $data['usuari_id'], $data['nou_valor'], $data['camp'])) {
            $result = modificarArticle($data['id'], $data['usuari_id'], $data['nou_valor'], $data['camp'], $this->db);
            return ["success" => $result];
        } else {
            http_response_code(400);
            return ["error" => "Datos incompletos"];
        }
    }

    // DELETE Articles
    public function deleteArticles($request) {
        $id = isset($request[1]) ? $request[1] : null;
        $user_id = isset($request[2]) ? $request[2] : null;

        if ($id && $user_id) {
            if (verificarPropietatArticle($id, $user_id, $this->db)) {
                $result = eliminarArticle($id, $this->db);
                return ["success" => $result];
            } else {
                http_response_code(403);
                return ["error" => "No tienes permiso para eliminar este artículo"];
            }
        } else {
            http_response_code(400);
            return ["error" => "Datos incompletos"];
        }
    }
}