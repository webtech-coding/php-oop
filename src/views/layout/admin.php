<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="/styles/style.css"/>
    <title>Dashboard</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="/admin">Dashoard</a></li>
            <li><a href="/admin/posts">Manage posts</a></li>
            <?php if($auth): ?>
                <li>
                    <form method="POST" action="/logout">
                        <button><?=($auth->name) ?>Logout</button>
                    </form> 
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <main>
        <?= $content ?>
    </main>
</body>
<footer>
    &copy; All right reserved to shovit thapa <?= date('Y');?>
</footer>
</body>
</html>