<?php

namespace  App\Controller;

use App\Services\Auth;
use Core\View;
use Models\User;

class AuthController{
    public function loginView(){
        View::render("auth/login", ['auth'=>Auth::getAuth()]);
    }

    public function handleUserLogin(){
        //csrf_token
        $email = $_POST["email"];
        $password = $_POST["password"];
        if(!$email || !$password){
            throw new \Exception("Email and password are mandatory");
        }

        $user = Auth::userAuthorized($email, $password);
       
        if(!$user){
            setFlashMessage('User name or password invalid', 'error');
            View::render("auth/login", ['auth'=>Auth::getAuth()]);
            exit();
        }
        redirect("/");
    }

    public function logout(){
        Auth::remvoeUserSession();
        redirect("/");
    }
}
