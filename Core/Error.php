<?php

namespace Core;

class Error{
    /**
     * @param int $level error level
     * @param $message error message
     * @param $file  file that has the error
     * @param $line the line which has the error
     * @throws \ErrorException
     * @return  void
     */
    public static function errorHandler($level , $message , $file , $line ){
        if (error_reporting() !== 0){
            throw  new \ErrorException($message , 0 , $level , $file , $line);
        }
    }

    /**
     * @param $exception
     */
    public  static function  exceptionHandler($exception){

        if ($exception->getCode() != 404) {
            echo "<h1>Error (^-^)</h1>";
            echo "<p>Uncaught exception : '" . get_class($exception) . "'</p>";
            echo "Message : '" . $exception->getMessage() . "'</p>";
            echo "<p> Stack trace <pre>'" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p> Thrown in '" . $exception->getFile() . "'on line " . $exception->getLine() . "</p>";
        }else{
            echo "We can find this page";
        }
    }

}