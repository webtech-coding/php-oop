<?php

include 'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
use Core\Config;
use Core\Gate;
use Database\Connection;

//instantitate the configuration
Config::load();

//intantiate the database
$database = new Connection();

Gate::define('is-admin', function($user): bool{
    return $user->role==='admin';
});

Gate::define('modify-post', function($user, $post): bool{
    
    
    return ($user->role=== 'admin' && $user->id=== $post->user_id);
});
