<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$baseUrl = "http://localhost/referral-system";

// setup the autoloading
require_once __DIR__.'/vendor/autoload.php';

// setup Propel
require_once __DIR__.'/generated-conf/config.php';

Twig_Autoloader::register();

// http://www.lornajane.net/posts/2012/building-a-restful-php-server-routing-the-request
spl_autoload_register('apiAutoload');
function apiAutoload($classname)
{
    if (preg_match('/([a-zA-Z]?)+Controller$/', $classname)) {
        include __DIR__ . '/controllers/' . $classname . '.php';
        return true;
    } elseif (preg_match('/([a-zA-Z]?)+View$/', $classname)) {
        include __DIR__ . '/views/' . $classname . '.php';
        return true;
    }
}

$userController = new UserController();
$userController->create();
$userController->login(2);

//$review = new Review();
//$review->setStatus(0);
//echo "<pre>".print_r($review->toArray(),1)."</pre>";

// route the request to the right place
// http://www.lornajane.net/posts/2012/building-a-restful-php-server-routing-the-request
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$request = parse_url($url);
$verb = htmlspecialchars($_SERVER['REQUEST_METHOD']);
$paths = array();
if(isset($request['path'])) {
    $paths = explode('/', $request['path']);
}

if(isset($paths[2])) {
    
    $controller_name = ucfirst($paths[2]) . 'Controller';
    if (class_exists($controller_name)) {
        $controller = new $controller_name();
        $action_name = strtolower($verb) . 'Action';
        $result = $controller->$action_name();
    } else {
        echo "class ".$controller_name." does not exist";
    }

}