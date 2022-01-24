<?php

use App\Autoloader;
use App\core\Main;

define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
require_once(ROOT.'Autoloader.php');
require_once(ROOT.'/vendor/autoload.php');


/**Load .env files */
$dotenv = Dotenv\Dotenv::createImmutable(ROOT);
$dotenv->load();

//Execute Autoloader
Autoloader::register();


require_once(ROOT.'/Autoloader.php');
require_once(ROOT.'/vendor/autoload.php');


/**Load .env files */
$dotenv = Dotenv\Dotenv::createImmutable(ROOT);
$dotenv->load();

Autoloader::register();

$app = new Main();

$app->start();