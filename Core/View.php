<?php

/**
 * Author : saad mohmed
 * agency : holol for web services
 * version : 1.0
 * Router Class
 */
namespace  Core;
class View{

    /**
     * return the required files
     * @param $view
     */

//    public static  function  render($view , $args = []){
//        extract($args,EXTR_SKIP);
//        $file = "./App/Views/$view"; // path to the html file (twig)
//        if (is_readable($file)){
//            require $file;
//        }else{
//            echo "$file not found ('^')";
//        }
//    }
public static function  renderTemplate($template,$args =[] ){
    static  $twig = null ;
    if ($twig === null){
        $loader = new \Twig\Loader\FilesystemLoader('./App/Views');
        $twig =  new \Twig\Environment($loader);
    }
    echo  $twig->render($template,$args);
}
}