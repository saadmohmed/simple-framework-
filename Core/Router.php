<?php

/**
 * Author : saad mohmed
 * agency : holol for web services
 * version : 1.0
 * Router Class
 */
namespace Core;
class Router{
    /**
     * @var array  routeing table
     */
  protected  $routes = [] ;

    /**
     * @var array  paramater that match the route
     */
  protected $params = [];

    /**
     * @param $route  The route url
     * @param $params Paramaters (controllers , actions);
     * @return  void
     */
  public function add($route, $params = []){
      // Convert the route to a regular expression: escape forward slashes
      $route = preg_replace('/\//', '\\/', $route);

      // Convert variables e.g. {controller}
      $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

      // Convert variables with custom regular expressions e.g. {id:\d+}
      $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

      // Add start and end delimiters, and case insensitive flag
      $route = '/^' . $route . '$/i';

      $this->routes[$route] = $params;
  }

    /**
     * @return array return routes
     */
  public  function getRoutes(){
      return $this->routes;
  }

    /**
     * Match the route to the routes in the routing list
     * @param $url The Route url
     * @return bool true if a match found , false otherwise
     */
  public  function match($url){

      foreach ($this->routes as $route => $params) {
          if (preg_match($route, $url, $matches)) {
              // Get named capture group values
              foreach ($matches as $key => $match) {
                  if (is_string($key)) {
                      $params[$key] = $match;
                  }
              }

              $this->params = $params;
              return true;
          }
      }

      return false;
  }

    /**
     * @return array all paramters like controller name and the action name
     */
  public  function getParmas(){
      return $this->params;
  }

  public function dispatch($url){
      $url = $this->removeQueryStringVariables($url);

      if ($this->match($url)){

          $controller = $this->params['controller'];
          $controller = $this->convertToCaps($controller);
          $controller = "App\Controllers\\$controller";

          if (class_exists($controller)){

              $controller_object = new $controller($this->params);

              $action = $this->params['action'];

               $action = $this->convertToCamelCase($action);

              if (is_callable([$controller_object,$action])){

                  $controller_object->$action();

              }else{

                  throw  new \ErrorException("Method $action in Controller $controller not found");

              }

          }else{
              throw  new \ErrorException( "Controller class $controller not found");
          }
      }else{
          return View::renderTemplate("Common/404.twig");

          throw  new \ErrorException( "404 page not found");
      }

  }

    /**
     * convert first letter to caps and remove (-) and spaces
     * @param $string
     * @return string|string[]
     */
  protected function  convertToCaps($string){
      return str_replace(' ','' , ucwords(str_replace('-',' ',$string)));
  }

    /**
     * Convert the string with hyphens to camelcase
     * @param $string The string to convert
     * @return string
     */
  protected  function  convertToCamelCase($string){
       return lcfirst($this->convertToCaps($string));
  }

    /**
     * we will remove the varaiables form the url to get the right route
     * @param $url full url
     * @return mixed|string
     */
  protected function removeQueryStringVariables($url){
      if ($url != ''){
          $parts = explode('&',$url , 2);
          if (strpos($parts[0] , '=' ) === false){
              $url = $parts[0];
          }else{
              $url = '' ;

          }
      }
      return $url;
  }
}