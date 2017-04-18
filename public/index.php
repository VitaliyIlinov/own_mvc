<?php
error_reporting(-1);
use vendor\core\Router;

$uri = trim($_SERVER['REQUEST_URI'], '/');

define('DS',DIRECTORY_SEPARATOR);
define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('CORE', ROOT . DS. 'vendor'.DS.'core');
define('APP', ROOT . DS. 'app');
define('LAYOUT', 'default');

require "../vendor/libs/functions.php";

spl_autoload_register(function ($class) {
    $file=ROOT.DS. str_replace('\\','/',$class) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page','action'=>'view']);

#default roots
Router::add('^$', ['controller' => 'main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($uri);