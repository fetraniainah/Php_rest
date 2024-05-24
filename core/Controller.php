<?php
namespace app\core;

class Controller {
    protected function jsonResponse($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    protected function input($key) {
        return $_REQUEST[$key] ?? null;
    }

    protected function content() {
        if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
            $jsonData = file_get_contents('php://input');
            return json_decode($jsonData, true);
        }
        return null;
    }

    protected function uploadFile($fileKey, $destination) {
        if ($_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
            return false;
        }
        move_uploaded_file($_FILES[$fileKey]['tmp_name'], $destination);
        return true;
    }
}
?>