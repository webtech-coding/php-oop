<?php

namespace App\Middlewares;

use Core\IMiddleware;

class CsrfMiddleWare implements IMiddleware{
    public function handle($request, callable $next){
        $req= (object)$request;
        $isValid = verify_csrf($req->csrf);
        if(!$isValid){
            setFlashMessage("Invalid token. Permission denied to create a comment","error");             
            redirect( '/');
        }
        $next($request);
    }
}