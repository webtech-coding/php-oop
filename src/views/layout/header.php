<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="/styles/style.css"/>
    <title>Blog post</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="contact">Contact form</a></li>
            <?php if($auth): ?>
                <li>
                    <form method="POST" action="/logout">
                        <button><?=($auth->name) ?>Logout</button>
                    </form> 
                </li>
            <?php endif; ?>
            
        </ul>
    </nav>