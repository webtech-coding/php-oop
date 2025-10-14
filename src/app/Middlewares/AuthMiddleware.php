<?php

namespace App\Middlewares;

use App\Services\Auth;
use Core\IMiddleware;

class AuthMiddleware implements IMiddleware{
    public function handle($request, callable $next){

        $auth = Auth::getAuth();
        if(!$auth){
            redirect("/login");
        }

        $request['auth']= $auth;
        $next($request);
    }
}