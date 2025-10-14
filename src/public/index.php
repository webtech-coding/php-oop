<?php

declare(strict_types= 1);
session_start();
//include __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
include __DIR__ .DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.'bootstrap.php';

use Core\Router;
use Models\Comment;
use Models\Post;
use Models\User;

$router = new Router();
include_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.'/routes.php';

$router->dispatch(); 