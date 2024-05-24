<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Messages;
use Exception;

class MessagesController extends Controller {
    public function index() {
        $message = new Messages();
        $messages = $message->getAll();
        $this->jsonResponse($messages);
    }

    public function show($id) {
        $message = new Messages();
        $messageData = $message->get($id);
        if (!$messageData) {
            $this->jsonResponse(['error' => 'Message not found'], 404);
            return;
        }
        $this->jsonResponse($messageData);
    }

    public function store() {
        $message = new Messages();
        $data = $this->content();
        $newMessage = [
            'email' => $data["email"],
            'message' => $data["message"]
        ];
        try {
            $message->insert($newMessage);
            $this->jsonResponse(['message' => 'Message created']);
        } catch(Exception $e) {
            $this->jsonResponse(['error' => 'Failed to create message'], 400);
        }
    }
}
?>