<?php

use app\core\App;
use app\controllers\HomeController;
use app\controllers\AuthController;

$app = new App();

$app->router->get('/', [new HomeController(), 'index']);

$app->router->get('/register', [new AuthController(), 'registerView']);
$app->router->post('/register', [new AuthController(), 'store']);

$app->router->get('/login', [new AuthController(), 'loginView']);
$app->router->post('/login', [new AuthController(), 'login']);
$app->router->get('/logout', [new AuthController(), 'logout']);