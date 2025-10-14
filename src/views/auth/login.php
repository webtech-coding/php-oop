<?php
    $error = getFlashMessage('error');
    /*
    if (isset($_SESSION['user_id'])) {
        redirect('/');
        exit();
    }*/
?>
<main>
    <h3>Login</h3>
    <?php if($error):?>
        <div class="error">
        <?=$error ?>
        </div>
       
    <?php endif;?>
    <form action="/login" method="POST">
        <div>
            <label>Emai:</label>
            <input type="text" name="email"/>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password"/>
        </div>
        <div>
            <input type="checkbox" name="remember_me"/>
            <label>Remember me</label>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</main>
