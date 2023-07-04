<?php

use app\core\App;
use app\controllers\HomeController;
use app\controllers\AuthController;

$app = new App();

$app->router->get('/', [new HomeController(), 'index']);

$app->router->get('/register', [new AuthController(), 'index']);
$app->router->post('/register', [new AuthController(), 'store']);