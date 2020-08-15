<?php

/**
 * Author : saad mohmed
 * agency : holol for web services
 * version : 1.0
 * DB Class
 */
namespace  Core;
use App\config;
use PDO;
abstract  class Db{


    protected  static  function  getDB(){

         static  $db = null;
         if ($db === null){

         try {
             $db = new PDO('mysql:host='.Config::DB_HOST .';dbname='.Config::DB_NAME.';charset=utf8',Config::DB_USER,Config::DB_PASSWORD);
           $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          return $db ;

     }catch (PDOException $e){
         echo $e->getMessage();
         exit();
     }
 }


    }

}