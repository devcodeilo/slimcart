<?php

use Cart\App;
use Slim\Views\Twig;
use Braintree_Configuration as BTConfig;
use Illuminate\Database\Capsule\Manager as Capsule;

session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new App;

$container = $app->getContainer();

$capsule = new Capsule();
$capsule->addConnection([
	'driver' => 'mysql',
	'host' => 'localhost',
	'database' => 'slim_slimcart',
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix' => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

BTConfig::environment('sandbox');
BTConfig::merchantId('pw5rnz9fmxzq87cc');
BTConfig::publicKey('6qj3rcqmd5hzbvp4');
BTConfig::privateKey('61bccd47b9adfd82e6bebc4dabcd202b');

require __DIR__ . '/../app/routes.php';

$app->add(new \Cart\Middleware\ValidationErrorsMiddleware($container->get(Twig::class)));
$app->add(new \Cart\Middleware\OldInputMiddleware($container->get(Twig::class)));
