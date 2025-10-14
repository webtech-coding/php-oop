<?php

namespace App\Controller;
use App\Services\Auth;
use Core\View;
use Models\Comment;
use Models\Post;

class PostController{
    
    public function index($request){
        $auth = (object)$request['auth'];     
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $posts = [];
        if($search){
                $posts = Post::search(['title','content'], $search);
        }else{
            $posts = Post::all();
        }
       
        View::render("posts/index", [
            'posts'=>$posts,
            'title'=>'Showing all the posts',
            'search'=>$search,
            'auth'=>$auth
        ]);
    }

    public function show(array $params = []): void{
        $id = $params["id"];
        $post = Post::findById((int)$id);

        if(!$post){
          View::render("layout/404");
          return;
        }

        $comments = Comment::getPostComment($post->id);

        View::render("posts/show", [
            'post'=>$post,
            'title'=>'Showing the post',
            'comments'=>$comments,
            'auth'=>Auth::getAuth()
        ]);
    }
    
}   