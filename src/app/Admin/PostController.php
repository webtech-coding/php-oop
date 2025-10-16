<?php

namespace App\Admin;

use Core\View;
use Models\Post;

class PostController{
    public function index($request){
        $auth = (object)$request['auth'];
        $posts = Post::all();
        View::render(
            "/admin/posts/index",
            ['posts'=>$posts, 'auth'=>$auth], 
            'admin'
        );
    }

    public function create($request){

    }

    public function edit($request){
        $auth = (object)$request['auth'];
        $id = (int)$request['id'];       
        $post = Post::findById($id);
        View::render('/admin/posts/edit', ['auth'=>$auth, 'post'=>$post], 'admin');
    }

    public function update($request): void{
       
        $csrf = $request['csrf'];
        $title= $request['title'];
        $content = $request['content'];
        $id =(int)$request['id'];

        $updated = Post::findByIdAndUpdate($id,['title'=>$title, 'content'=>$content]);
        if($updated){
            redirect('/admin/posts');
        }

    }


}
