<?php
namespace app\controllers;

use app\core\Controller;
use app\models\User;
use Exception;

class UserController extends Controller {
    public function index() {
        $user = new User();
        $users = $user->getAll();
        $this->jsonResponse($users);
    }

    public function show($id) {
        $user = new User();
        $userData = $user->get($id);
        if (!$userData) {
            $this->jsonResponse(['error' => 'User not found'], 404);
            return;
        }
        $this->jsonResponse($userData);
    }

    public function login(){
        $data = $this->content();
        $user = new User();
        $res = $user->where('email', $data["email"]);
        if ($res) {
            if (password_verify($data["password"], $res["password"])) {
                return $this->jsonResponse(["message" => "Authentification réussie"], 200);
            } else {
                return $this->jsonResponse(["error" => "Mot de passe incorrect"], 401);
            }
        } else {
            return $this->jsonResponse(["message" => "Utilisateur non trouvé"], 404);
        } 
    }

    public function store() {
        $user = new User();
        $data = $this->content();
        $newUser = [
            'name' => $data["name"],
            'email' => $data["email"],
            'password' => password_hash($data["password"], PASSWORD_BCRYPT)
        ];
        try{
            $user->insert($newUser);
            $this->jsonResponse(['message' => 'User created']);
        }catch(Exception $e){
            $this->jsonResponse($newUser,400);
        }
    }

   

}
?>