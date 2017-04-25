<?php

namespace app\controllers;

use app\models\Main;
use vendor\core\base\Controller;

class MainController extends Controller {

    public $layouts='main';

    public function indexAction(){
       //$this->layouts=false;
//        $this->view='test';
        $model = new Main;
        $res = $model->query("CREATE TABLE `posts` (`id` INT NULL)");
        var_dump($res);
       $title='PAGE TITLE';
       $this->set(compact('title'));
    }
}