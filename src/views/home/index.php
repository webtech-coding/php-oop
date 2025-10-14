<?php
    $error = getFlashMessage('error');
    if (!isset($_SESSION['user_id'])) {
        redirect('/');
        exit();
    }
?>
<main>   
   <?=$title?>
   <?php if($error):?>
        <div class="error">
            <?=$error ?>
        </div>
    <?php endif;?>
   <div class="posts">
        <?php foreach($posts as $post): ?>
            <div class="post">
                <h3><?= $post->title ?></h3>
                <p><?= $post->content ?></p>
                <p><small>Create at: <?= $post->created_at ?></small></p>
                <a href="/post/<?=$post->id?>">Reader more..</a>
            </div>        
        <?php endforeach; ?>
   </div>
   
</main>

