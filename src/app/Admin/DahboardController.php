<?php

namespace App\Admin;

use Models\Post;
use Core\View;

class DahboardController{
    public function index($request=[]){
        $auth = (object)$request['auth'];

        $recentPosts = Post::getRecentPosts();

        View::render('/admin/dashboard/index',[
            'auth'=> $auth,
            'posts'=>$recentPosts
        ], 'admin');
    }
}