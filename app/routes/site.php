<?php

use app\controllers\Home;
use app\controllers\Login;

// $app->add(new \Slim\HttpCache\Cache('public', 10));

$app->get('/', Home::class . ':index');
$app->get('/login', Login::class . ':index');
$app->post('/login', Login::class . ':store');
$app->get('/logout', Login::class . ':destroy');
