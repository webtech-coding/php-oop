<h3>OverView</h3>
<div>
    <?php foreach ($posts as $post):?>
        <p>
            <a href="post/<?=$post->id?>"><?= $post->title?></a>
            <?php if(verify('modify-post', $auth, $post)):?>
                <button>Edit</button>
            <?php endif;?>
           
        </p>
    <?php endforeach;?>
    </div>
