<?php

namespace App\Services;

use Models\User;

class Auth{

    private static function saveUserSession(object $auth){  
        session_create_id();
        $_SESSION['user_id']= $auth->id;       
    }

    public static function userAuthorized(string $email, string $password): object | bool{
        // check if user exists
        $auth = User::fetchOne(["email"=> $email]);
        if(!$auth)return false;

        //match the password
        $match = password_verify($password, $auth->password);
        if(!$match)return false;
        self::saveUserSession($auth);        
        return $auth;
    }

    public static function remvoeUserSession(){
        session_destroy();
    }


    public static function getAuth(): object | null{
        if(!isset($_SESSION["user_id"]))return null;

        $userId = $_SESSION['user_id'];
        if($userId){
            $user  = User::findById($userId);
            if(!$user)return null;
            return $user;
        }else{
            return null;
        }
    }
}