<?php
namespace app\middlewares;

use app\core\Middleware;

class AuthMiddleware implements Middleware {
    public function handle() {
        
       
        $token = $_SERVER['HTTP_AUTHORIZATION'];
       
            http_response_code(201);
            echo json_encode(['token' => $token]);
    }
}
?>