<?php
    $error = getFlashMessage('error');
    if (!isset($_SESSION['user_id'])) {
        redirect('/');
        exit();
    }
?>
<main>
   <div class="posts">
        <div class="post">
        <?php if($error):?>
            <div class="error">
                <?=$error ?>
            </div>
        <?php endif;?>
            <h3><?= $post->title ?></h3>
            <p><?= $post->content ?></p>
            <p><small>Create at: <?= $post->created_at ?></small></p>
            <div class="comments">
                <strong>Comments(<?= count($comments)?>)</strong>
                <?php if($auth):?>
                    <form method="POST"  action="/post/<?=$post->id ?>/comment">
                        <label for="content">
                            Place a comment for the post
                        </label>
                        <?php echo csrf();  ?>
                        <textarea name="content" rows="5" required></textarea>
                        <button type="submit" name="submit">Post</button>
                    </form>
                <?php endif; ?>
                <hr/>
                <?php if(count($comments)):?>
                    <div>
                        <?php foreach($comments as $comment): ?>
                            <p><?= $comment->comment?></p>
                        <?php endforeach; ?>
                        </div>
                <?php endif;?>
            </div>
        </div>
   </div>
</main>

