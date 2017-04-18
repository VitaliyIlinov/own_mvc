<?php


namespace vendor\core\base;


abstract class Controller {

    public $route = [];
    public $view;
    public $layouts;

    public function __construct($route) {
        $this->route = $route;
        $this->view=$route['action'];
    }

    public function getView(){
        $obj= new View($this->route,$this->view,$this->layouts);
        $obj->render();
    }

}