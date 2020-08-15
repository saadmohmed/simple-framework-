<?php
namespace  Core;
use App\config;
/**
 * Base Controller
 * author : saad mohmed
 * agency : holol for web services
 * version : 1.0;
 */

abstract class Controller{
    /**
     * @var array
     */
    private $data = array();
    /**
     * Parameters from the matched route
     * @var array
     */
    protected $route_params = [];

    /**
     * Class constructor
     *
     * @param array $route_params  Parameters from the route
     *
     * @return void
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }
    public function get($name){
        return $this->route_params["$name"];
    }


    public function load($filename) {

        $file = Config::DIR_CONFIG . $filename . '.php';

        if (file_exists($file)) {
            $_ = array();

            require($file);

            $this->data = array_merge($this->data, $_);
        } else {
            trigger_error('Error: Could not load config ' . $filename . '!');
            exit();
        }
    }
    public function loadController($filename){
        $file = Config::DIR_CONFIG . $filename . '.php';

        if (file_exists($file)) {
            $fp = fopen($file, 'r');
            $class = $buffer = '';
            $i = 0;
            while (!$class) {
                if (feof($fp)) break;

                $buffer .= fread($fp, 512);
                $tokens = token_get_all($buffer);

                if (strpos($buffer, '{') === false) continue;

                for (;$i<count($tokens);$i++) {
                    if ($tokens[$i][0] === T_CLASS) {
                        for ($j=$i+1;$j<count($tokens);$j++) {
                            if ($tokens[$j] === '{') {
                                $class = $tokens[$i+2][1];
                            }
                        }
                    }
                }
            }
            return new $class();
        } else {
            trigger_error('Error: Could not load config ' . $filename . '!');
            exit();
        }
    }

    public  function  loadScript($script){
        $file = Config::DIR_SYSTEM ."App/javascript/". $script . '.js';
        if (is_readable($file)){
           return "./App/javascript/". $script . '.js';
        }else{
          return   new \ErrorException("Coud't  find $file ");
        }


    }
    public  function  loadStyle($style){
        $file = Config::DIR_SYSTEM ."App/css/". $style . '.css';
        if (is_readable($file)){
            return "./App/css/". $style . '.css';
        }else{
            return   new \ErrorException("Coud't  find $file ");
        }


    }
}