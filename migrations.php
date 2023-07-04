<?php

require_once __DIR__ . '/core/init.php';
require_once __DIR__ . '/vendor/autoload.php';

use app\core\App;
$app = new App();

$app->db->applyMigrations();