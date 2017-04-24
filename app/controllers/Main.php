<?php

namespace app\controllers;

use vendor\core\base\Controller;

class Main extends Controller {

    public $layouts='main';

    public function indexAction(){
       //$this->layouts=false;
        $this->view='test';
       $name='vetal';
       $hi='Hello';
       $colors = [
           'white'=>'Белый',
           'black' =>'Чёрный'
       ];
       $this->set(compact('name','hi','colors'));
    }
}