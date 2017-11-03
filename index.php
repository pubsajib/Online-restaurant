<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/4/17
 * Time: 2:31 PM
 */
require_once 'route.php';
require_once 'config.php';

if (BASE_URL == '') {
    $uri = $_SERVER['REQUEST_URI'];
} else {
    $uri = str_replace(BASE_URL, '', $_SERVER['REQUEST_URI']);
}

if (strpos($uri, '?') !== false) {
    $uri = substr($uri, 0, strpos($uri, '?'));
}

//to use autoload
$loader = require 'vendor/autoload.php';
$loader->add('App\\', __DIR__.'/');

class Index
{
    function route($route, $uri) {
        try {
            //if uri is / then skip trimming the uri by '/'
            if($uri != '/') {
                $uri = trim($uri, '/');
            }

            //check if route exists or route method matched
            $this->checkRoute($uri, $route);
            /*if (!array_key_exists($uri, $route)) {
                echo 'No route found';
                return;
            }
            if ($_SERVER['REQUEST_METHOD'] !== strtoupper($route[$uri][2])) {
                echo "Method not found";
                return;
            }*/

            //loading the controller
            //require_once 'controller/'.$route[$uri][0].'.php';

            $className = 'App\controller\\'.$route[$uri][0];
            $class = new $className;
            // die($className);
            // die($route[$uri][1]);
            $class->{$route[$uri][1]}();
        } catch (\Exception $exception) {
            echo $exception;
        }
    }

    protected function checkRoute($uri, $route)
    {
        if (!array_key_exists($uri, $route)) {
            //echo 'No route found';
            $_SESSION['errorMsg'] = 'Something Went Wrong';
            $commonController = new \App\controller\CommonController();
            $commonController->commonErrorMessage();
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] !== strtoupper($route[$uri][2])) {
            //echo "Method not found";
            $_SESSION['errorMsg'] = 'Something Went Wrong';
            $commonController = new \App\controller\CommonController();
            $commonController->commonErrorMessage();
            exit();
        }
    }
}

$index = new Index();

$index->route($route, $uri);