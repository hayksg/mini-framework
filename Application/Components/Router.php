<?php

class Router 
{
    const ROUTES_PATH = ROOT . 'config/routes.php';
    private $routes;
    
    public function __construct() {
        $this->routes = include(self::ROUTES_PATH);
    }
    
    private function getURI()
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (! empty($uri)) {
            return trim(filter_var($uri, FILTER_SANITIZE_URL), '/');
        }
    }

    public function run()
    {
        // Get uri
        $uri = $this->getURI();
        
        foreach ($this->routes as $uriPattern => $path) {
            
            // Check is request exists in routes.php
            $pattern = "~^$uriPattern(?![\w\s])~";
            
            if (preg_match($pattern, $uri)) {
                // If exists parameters get them
                $internalRoute = preg_replace($pattern, $path, $uri);
  
                // If exists get Controller name and action name
                $segments = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($segments)) . 'Controller';
                $actionName = array_shift($segments) . 'Action';
                $parameters = $segments;
                        
                // Include Controller file
                $controllerFile = ROOT . 'Application/Controller/' . $controllerName . '.php';
                if (is_file($controllerFile)) {
                    include_once($controllerFile);               
                }
        
                // Create an object, call a method (action)
                if (class_exists($controllerName)) {
                    
                    $controllerObject = new $controllerName;
                    if (method_exists($controllerObject, $actionName)) {
                        $result = call_user_func_array([$controllerObject, $actionName], $parameters);
                
                         if ($result != null) {
                            break;
                        }
                    }
                }
            }
        } 
    }
}
