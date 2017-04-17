<?php

namespace vendor\core;

class Router {
    /**
     * таблица маршрутов
     * @var array
     */
    protected static $routes = [];

    /**
     * текущий маршрут
     * @var array
     */
    protected static $route = [];

    /**
     * @param string $regexp - регулярное выражение маршрута
     * @param array $route -маршрут [controller, action, params]
     */
    public static function add($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }

    /**
     * возвращает текущий маршрут
     * @return array
     */
    public static function getRoute() {
        return self::$route;
    }

    /**
     * возвращает таблицу маршрутов
     * @return array
     */
    public static function getRoutes() {
        return self::$routes;
    }

    /**
     * ищет URL в текущей таблице маршрутов
     * @param string $url входящий URL
     * @return bool
     */
    protected static function matchRoute($url) {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i",$url,$matches)) {
                foreach ($matches as $k =>$v){
                    if(is_string($k)){
                        $route[$k]=$v;
                    }
                }
                if(!isset($route['action'])){
                    $route['action']='index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route=$route;
                return true;
            }
        }
        return false;
    }

    /**
     * перенаправляет url по коректному маршруту
     * @param string $url
     */
    public static function dispatch($url){
        $url = self::removeQueryString($url);
        if(self::matchRoute($url)){
            $controller = 'app\controllers\\'.self::$route['controller'];
            if(class_exists($controller)){
              $obj = new $controller(self::$route);
              $action=self::lowerCamelCase(self::$route['action']).'Action';
              if(method_exists($obj,$action)){
                  $obj->$action();
              }else{
                  echo "Action <b>$action</b> not found.";
              }
           }else{
               echo "Controller <b>$controller</b> not found.";
           }
        }else{
            http_response_code(404);
            include "404.html";
        }
    }

    protected static function upperCamelCase($name){
        return str_replace(' ','',ucwords(str_replace('-',' ',$name)));
    }

    protected static function lowerCamelCase($name){
        return lcfirst(self::upperCamelCase($name));
    }

    /**
     * @param $url
     * @return mixed
     */
    protected static function removeQueryString($url){
        if ($url){
            $params=explode('&',$url,2);
            if(false==strpos($params[0],'=')){
                return trim($params[0],'/');
            }else{
                return '';
            }
        }
    }

}