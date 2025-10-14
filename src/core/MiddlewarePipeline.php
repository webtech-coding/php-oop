<?php

namespace Core;
class MiddlewarePipeline{
    public function handle(array $middlewares, $request, callable $controller){
        $next = array_reduce(
            array_reverse($middlewares),
            fn($next, $middlewareClass) => fn($req) => (new $middlewareClass)->handle($req, $next),
            $controller
        );
        
        return $next($request);
    }   
}