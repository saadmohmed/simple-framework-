<?php
namespace App\Controllers;
use \Core\View;
use \Core\Db;
class Header extends \Core\Controller{
    /**
     * view
     */
    public static  function index($d = [] ){
        $data = [];
        $data["name"] = "header";
        $data["job"] = "headerrr";

        $data['scripts'] =  $d["scripts"];



        View::renderTemplate('Common/header.twig',$data);
    }
}