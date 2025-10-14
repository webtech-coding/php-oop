<?php

namespace App\Middlewares;

use App\Services\Auth;
use Core\IMiddleware;

class ViewMiddleware implements IMiddleware{
    public function handle($request, callable $next){
        $auth = Auth::getAuth();
        if(!$auth){
            redirect("/login");           
        }

        $request['auth']= $auth;
        return $next($request);
    }
}