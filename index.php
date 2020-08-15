<?php


ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
/**
 * Twig
 */
require_once dirname(__DIR__).'/buildmvc/vendor/twig/autoload.php';
/**
 * Autoloader function
 */

spl_autoload_register(function ($class){
     $root = dirname(__DIR__).'/buildmvc';
     if (empty($class)){
         $file = $root . '/Home.php';
     }else {
          $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
     }
    if (is_readable($file)){

        require  $root . '/'.str_replace('\\','/',$class).'.php';
    }
});

set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');
$router = new Core\Router();

//route for the home
// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/', ['controller' => 'Posts', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);


//echo "<pre>";
//var_dump($router->getParmas());
//echo "</pre>";
$url = $_SERVER["QUERY_STRING"];

$router->dispatch($url);
