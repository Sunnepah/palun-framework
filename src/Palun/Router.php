<?php
/**
 * Created by PhpStorm.
 * User: sunnepah
 * Date: 6/22/16
 * Time: 2:42 PM
 */
namespace Palun;

use Application\Controllers;
use RuntimeException;

trait Router
{
    protected $routes = [];
    
    /**
     * Register GET route
     * 
     * @param $path
     * @param $controllerAction
     */
    public function get($path, $controllerAction) {
        $this->registerRoute ('GET', $path, $controllerAction);
    }

    /**
     * Register routes
     * 
     * @param $httpVerb
     * @param $path
     * @param $action
     */
    public function registerRoute ($httpVerb, $path, $action) {

        $this->routes[$httpVerb . $path] = ['uri' => $path, 'method' => $httpVerb, 'action' => $action];
    }

    /**
     * @return array
     */
    protected function getRequestInfo() {
        return [$this->extractRequestMethod(), $this->extractRequestPathInfo()];
    }

    /**
     * @return string
     */
    public function extractRequestMethod() {
        return $this->getMethod();
    }

    /**
     * @return string
     */
    public function extractRequestPathInfo() {
        return $this->getPathInfo();
    }

    /**
     * Get the current HTTP request method.
     *
     * @return string
     */
    protected function getMethod()
    {
        if (isset($_POST['_method'])) {
            return strtoupper($_POST['_method']);
        } else {
            return $_SERVER['REQUEST_METHOD'];
        }
    }

    /**
     * Get the current HTTP path info.
     *
     * @return string
     */
    protected function getPathInfo()
    {
        $query = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';

        return '/'.trim(str_replace('?'.$query, '', $_SERVER['REQUEST_URI']), '/');
    }

    /**
     * @param $method
     * @param $pathInfo
     * @throws RuntimeException
     */
    protected function routeNotFound($method, $pathInfo)
    {
        throw new RuntimeException("Route not found - " . $method . " on uri " . $pathInfo . " not found");
    }

    /**
     * Resolves route action to Callable Controller class and method
     * @param $ControllerAction
     * @return mixed
     */
    public function handleRequest($ControllerAction) {
        
        list($controller, $action) = explode(":", $ControllerAction);
        
        $response = $this->callControllerAction($controller, $action);
        
        return $response;
    }

    /**
     * It instantiate Controller class and invoke method call 
     * @param $controller
     * @param $action
     * @return mixed
     */
    protected function callControllerAction($controller, $action)
    {
        $namespace = "\\Application\\Controllers\\";
        
        if (!method_exists($instance = $namespace.$controller, $action)) {
            throw new RuntimeException("Method " . $action . " does not exist!");
        }
        
        $controller = new $instance();
        
        return $controller->$action();
    }
}