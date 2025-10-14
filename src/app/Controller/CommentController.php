<?php

namespace App\Controller;

use App\Services\Auth;
use Models\Comment;

class CommentController{
    public function create(array $params=[]){
        $post_id = (int)$params['id'];
        if(!isset($_POST['submit']))return;

        $csrf_token = $_POST['csrf'];
        $content = $_POST['content'];
        $user = Auth::getAuth();

        $csrf_valid = verify_csrf($csrf_token);
        if(!$csrf_valid){
            setFlashMessage('Invalid token. Unable to create a post.','error');
            redirect("/post/{$post_id}");
            exit();
        }

        $commentData = ['comment'=>$content,'post_id'=>$post_id,'user_id'=>$user->id,'rating'=>5];

        $comment = Comment::create($commentData);
        if(!$comment){
            setFlashMessage('Unable to crreate a comment','error');
           
        }
        redirect("/post/{$post_id}");
        

    }
}
