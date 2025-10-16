<?php

use Core\Gate;

function redirect(string $uri='/'){
    header("Location:{$uri}");
    exit();
}

function setFlashMessage(string $message= "", string $type="info"): void{
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    $_SESSION['flash'] = ['message'=> $message, $type=> $type];
}

function getFlashMessage(string $key): string | null{
    if(isset($_SESSION['flash'][$key])){        
        $message = $_SESSION['flash']['message'];  
        unset($_SESSION['flash']);
        return $message;
    }
   
    return null;
}

const CRSF_TOKEN_LENGTH = 32;
const CSRF_TOKEN_TIMEOUT = 5 * 60;
function csrf(): string {
    $token = bin2hex(random_bytes(CRSF_TOKEN_LENGTH));
    $_SESSION['csrf']= ['token'=>$token, 'expiresAt'=> time()+ CSRF_TOKEN_TIMEOUT];
  
    return "<input type='hidden' value='{$token}' name='csrf'/>";
}

function verify_csrf(string $user_token): bool {
    if(!$user_token)return false;

    if(!isset($_SESSION["csrf"]))return false;

    $token = $_SESSION['csrf']['token'];
    $timeout = $_SESSION['csrf']['expiresAt'];

    $isValid = hash_equals($token, $user_token) && $timeout> time();

    return $isValid;

}

function verify($name, $user, ...$params): bool {
    return Gate::verify($name, $user, ...$params);
}