<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 18.04.2017
 * Time: 22:38
 */

namespace vendor\core\base;


class View {

    public $route;
    public $view;
    public $layouts;

    public function __construct($route,$view='',$layouts='') {
        $this->route=$route;
        $this->layouts=$layouts ? :LAYOUT;
        $this->view=$view;
    }

    public function render(){
       $file_view=APP.DS.'views'.DS.$this->route['controller'].DS.$this->view.'.php';
       if(file_exists($file_view)){
           require $file_view;
       }else{
           echo "View <b>$file_view</b> not found";
       }
    }
}