<?php

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/app/functions.php';

define('APP_ROOT', dirname(__DIR__));
define('VIEWS_PATH', APP_ROOT . '/views/');

use App\App;
use App\Config;
use App\Controllers\HomeController;
use App\Controllers\CustomerController;

$app = new App();

// add routes
$app->addRoute('/', HomeController::class, 'index');
// ****challenge solution***
$app->addRoute('/customers/add', CustomerController::class, 'add');
$app->addRoute('/customers/save', CustomerController::class, 'save');
$app->addRoute('/customers/edit/{id}', CustomerController::class, 'edit');
$app->addRoute('/customers/delete/{id}', CustomerController::class, 'delete');
$app->addRoute('/login', HomeController::class, 'login');
$app->addRoute('/auth', HomeController::class, 'auth');
$app->addRoute('/createUser', HomeController::class, 'createUser');
$app->addRoute('/logout', HomeController::class, 'logout');



// run app
$app->run();
