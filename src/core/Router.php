<?php

namespace Core;

use Core\MiddlewarePipeline;

final class Router{

    private array $routes = [];
    private string $lastMethod;
    private string $lastUri;
    public function __construct(){

    }
    /**
     * Register get route
     * @param string $path
     * @param callable|array $routerHandler
     * @return void
     */
    public function get(string $path, callable | array $routerHandler):self{
        $this->addRoute('GET', $path, $routerHandler);
        return $this;
    }   

    /**
     * Register post route
     * @param string $path
     * @param callable|array $routerHandler
     * @return void
     */
    public function post(string $path, callable | array $routerHandler):self{
        $this->addRoute('POST', $path, $routerHandler);
        return $this;
    }
    
    private function addRoute(string $method, string $path, callable | array $routerHandler) : void{  
        $path = rtrim($path,'/') ?: '/';
        $this->lastMethod = $method;
        $this->lastUri = $path;
        $this->routes[$method][$path] = $routerHandler;
    }

    public function allRoutes(): array{
        return $this->routes;
    }

    /**
     * Register the middlewares for the last inserted method/uri
     * @param array $middlewares
     * @return void
     */
    public function middlewares(array $routesMiddlewares): void{  
        //get the last inserted method and Uri
        $method = $this->lastMethod;
        $uri = $this->lastUri;
        array_push($this->routes[$method][$uri], $routesMiddlewares);
    }

    public function dispatch(): void{
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);       
        $uri = rtrim($uri,'/') ?:'/';                
        //exact route found, invoke the callback or call the controller action

        if(isset($this->routes[$method][$uri])){
            $this->invoke($this->routes[$method][$uri]);            
            return;
        }

        //if there is no exact match, look for the possible wildcard in the uri
        foreach($this->routes[$method] as $key=>$value){            
            $pattern = preg_replace('#\{([a-zA-Z0-9_]+)\}#', '([a-zA-Z0-9_-]+)', $key);                      
            if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
                array_shift($matches);
                $id= $matches[0] ?? null;
                $this->invoke($value, ['id'=> $id]);
                return;
            }             
        }
        
        http_response_code(404);
    }

    private function invoke(array|callable $routerHandler, array $params=[]): void{      
        [$controller, $function] = $routerHandler;

        $routesMiddlewares = $routerHandler[2] ?? [];

        if(!is_array($routerHandler)){
            call_user_func($routerHandler, $params);
            exit();
        }

        $pipeline = new MiddlewarePipeline();

        $pipeline->handle($routesMiddlewares, $_REQUEST, function ($req) use ($controller, $function, $params){
           
            $instance = new $controller;
            foreach($params as $key=>$value){
                $req[$key]= $value;
            }

            
            return $instance->$function($req);
        });


        //calling the middleware pipeline
        /*
        if(!is_array($routerHandler)){
            call_user_func_array($routerHandler, $params);
        }else{
            
            if(!class_exists($controller)){
                throw new \Exception("Controller {$controller} not found");
            }
            
            $controller = new $controller();
            if(!method_exists($controller, $function)){
                throw new \Exception("Method  {$function} not found in the {$controller}");
            }
            
            call_user_func_array([$controller, $function], [$params]);
        }
            */
    }

    private function runMiddlewarePipeline(): void{

    }

}