<?php

namespace app\controllers;

use app\models\Main;
use vendor\core\base\Controller;

class MainController extends Controller {

    public $layouts='main';

    /**
     * compact — Создает массив, содержащий названия переменных и их значения
     */
    public function indexAction(){
       //$this->layouts=false;
//        $this->view='test';
       $model = new Main;
       $model->query("CREATE TABLE `posts` (`id` INT NULL)");
       $title='PAGE TITLE';
       $this->set(compact('title'));
    }
}