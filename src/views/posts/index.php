<main>   
   <?=$title?>
   <form>
        <div class="post-form" method="GET">
            <input type="text" value="<?=$_GET['search']??''?>"  name="search" placeholder="search post"/>
            <button type="submit">Search</button>
        </div>
    
   </form>
   <div class="posts">
        <?php if(count($posts)>0): ?>
            <?php foreach($posts as $post): ?>
                <div class="post">
                    <h3><?= $post->title ?></h3>
                    <p><?= $post->content ?></p>
                    <p><small>Create at: <?= $post->created_at ?></small></p>
                    <a href="/post/<?=$post->id?>">Reader more..</a>
                </div>        
            <?php endforeach; ?>
        <?php else:?>
            <div class="post">
                No Post found
            </div>
        <?php endif;?>
        
   </div>
   
</main>

