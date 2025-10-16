<h3>
    Edit post
</h3>
<section>
    <form method="POST" action="/admin/posts/<?= $post->id?>">
        <?= csrf()?>
        <input type="text" value="<?=$post->title?>" name="title"/>
        <textarea name="content">
            <?=$post->content?>
        </textarea>
        <button type="submit">Save</button>
    </form>
</section>