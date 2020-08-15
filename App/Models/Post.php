<?php
namespace  App\Models;

class Post extends \Core\Db{
    public static function  getPosts(){
        $query = static::getDB();
        $rows = $query->query("SELECT * FROM `cart`");
        return $rows;
    }
}