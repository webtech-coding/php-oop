<?php
namespace Core;

class View{
    public static function render(string $view, array $data = [], string $layout='main' ){
        $viewPath =  __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$view.".php";
        if(!file_exists($viewPath)){
            throw new \Exception("View {$viewPath} not found");
        }   

        extract($data);

        // get all the HTML contents from the view file. 
        ob_start();
            include $viewPath;
        $content = ob_get_clean();

        $layoutFile = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.$layout.'.php';
        if(!file_exists($layoutFile)){
            throw new \Exception("Layout file {$layoutFile} not found");
        }else{
            include $layoutFile; 
        }
    }

    public static function notFound(){
        $notFoundView = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR."404.php";

        ob_start();
            include $notFoundView;
        $content = ob_get_clean();

        $layoutFile = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.'main.php';
        if(!file_exists($layoutFile)){
            echo 'resource not found';
        }else{
            include $layoutFile; 
        }
    }
}