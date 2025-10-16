<h3>Manage posts</h3>

<section>
    <table>
        <thead>
            <th>#Post Id</th>
            <th>Title</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php foreach ($posts as $post):?>
                <tr>
                    <td><?=$post->id?></td>
                    <td><?=$post->title?></td>
                    <td class="cta">
                        <?php if(verify("modify-post", $auth, $post)):?>
                            <a href="/admin/posts/<?=$post->id?>/edit"><button>Edit</button></a>
                            <button>Delete</button>
                        <?php else: ?>
                            ---
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach;?>
            
        </tbody>
    </table>
</section>