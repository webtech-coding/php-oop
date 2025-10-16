<?php
    use App\Admin\DahboardController;
    use App\Controller\AuthController;
    use App\Controller\CommentController;
    use App\Controller\HomeController;
    use App\Controller\PostController;
    use App\Middlewares\AuthMiddleware;
    use App\Middlewares\CsrfMiddleWare;
    use App\Middlewares\ViewMiddleware;

    $router->get('/', [HomeController::class,'index'])->middlewares([ViewMiddleware::class]);
    $router->post('', [HomeController::class,'create'])->middlewares([AuthController::class]);

    $router->get('/post', [PostController::class,'index'])->middlewares([AuthMiddleware::class]);

    $router
        ->post('/post/{id}/comment', [CommentController::class,'create'])
        ->middlewares([AuthMiddleware::class, CsrfMiddleWare::class]);

    $router
        ->get('/post/{id}', [PostController::class,'show']);
        //->middlewares([AuthMiddleware::class]);

    $router->get('/login', [AuthController::class,'loginView']);
    $router->post('/login', [AuthController::class,'handleUserLogin']);
    $router->post('/logout', [AuthController::class,'logout']);


    /**
     * Admin routes
     */

     $router->get('/admin', [DahboardController::class, 'index'])->middlewares([AuthMiddleware::class]);

   
?>