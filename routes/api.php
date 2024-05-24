<?php

use app\controllers\MessagesController;
use app\controllers\SkillsController;
use app\core\Router;
use app\controllers\UserController;
use app\middlewares\AuthMiddleware;
use app\middlewares\DebugMiddleware;

$router = new Router();

$authMiddleware = new AuthMiddleware();
$debugMiddleware = new DebugMiddleware();

$router->get('/api/users', function() {
    $controller = new UserController();
    $controller->index();
});

$router->post('/api/users', function(){
    $controller = new UserController();
    $controller->store();
});

$router->post('/api/login', function(){
    $controller = new UserController();
    $controller->login();
});


$router->get('/api/skills', function() {
    $controller = new SkillsController();
    $controller->index();
});

$router->post('/api/skills', function(){
    $controller = new SkillsController();
    $controller->store();
});

$router->get('/api/skills/{id}', function($id){
    $controller = new SkillsController();
    $controller->show($id);
});

$router->put('/api/skills/{id}', function($id){
    $controller = new SkillsController();
    $controller->update($id);
});

$router->delete('/api/skills/{id}', function($id){
    $controller = new SkillsController();
    $controller->destroy($id);
});

$router->get('/api/messages', function() {
    $controller = new MessagesController();
    $controller->index();
});

$router->post('/api/messages', function(){
    $controller = new MessagesController();
    $controller->store();
});

$router->get('/api/messages/{id}', function($id){
    $controller = new MessagesController();
    $controller->show($id);
});


$router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
?>