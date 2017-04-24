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
        $this->view=$view;
        if($layouts===false){//null == ;false===
            $this->layouts=false;
        }else{
            $this->layouts=$layouts ? :LAYOUT;
        }
    }

    public function render(array $data){
        extract($data);
       $file_view=APP.DS.'views'.DS.$this->route['controller'].DS.$this->view.'.php';
       ob_start();
       if(file_exists($file_view)){
           require $file_view;
       }else{
           echo "<h6>View <b>$file_view</b> not found</h6>";
       }
       $content = ob_get_clean();
       if($this->layouts!==false){
           $file_layout= APP.DS.'views'.DS.'layouts'.DS.$this->layouts.'.php';
           if(file_exists($file_layout)){
               require $file_layout;
           }else{
               echo "<h6>Не найден шаблон <b>$file_layout</b></h6>";
           }
       }

    }
}