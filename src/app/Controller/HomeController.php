<?php

namespace App\Controller;

use App\Services\Auth;
use Core\View;
use Models\Post;

class HomeController{

    function index($request){
       $posts = Post::getRecentPosts(5);

       $auth = (object)$request['auth'];       
       
       View::render("home/index", [
        'title'=>"Welcome to the PHP programming",
        'posts'=> $posts,
        'auth'=> $auth,
       ]);
    }

    function create(){
        echo "creat page";
    }
}
?>