<?php
namespace App\Controllers;
use \Core\View;
use \Core\Db;
//use \App\Controllers\Header;
class Home extends \Core\Controller{
    /**
     * view
     */
    public function index(){
        $script["scripts"][] =  $this->loadScript("plugin");
        $script["scripts"][]=  $this->loadScript("plugin");

    $this->load("Header");
        $data["header"] = Header::index($script);
        $data["name"] = "saad";

        $data["css"] = $this->loadStyle("jquery/bootstrap/css/bootstrap.min");
        $data["job"] = "engineer";

     

        View::renderTemplate('Home/index.twig',$data);
    }
}