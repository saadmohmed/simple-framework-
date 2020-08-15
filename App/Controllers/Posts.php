<?php
namespace App\Controllers;
use \Core\View;
use App\Models\Post;
class Posts extends \Core\Controller{

    public  function index(){
           $data = [] ;
           $data['post'] = Post::getPosts();
        return View::renderTemplate("Posts/index.twig",$data);
    }
    public  function  add(){

        echo "WE will add new post";
    }
    public function delete(){
        echo 'Hello from the edit action in the Posts controller! ';
        echo '<p>Route parameters: <pre>' .
            htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }


}