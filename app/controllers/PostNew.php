<?php

namespace app\controllers;

use vendor\core\base\Controller;

class PostNew extends Controller {

    public function indexAction(){
        debug($this->route);
        debug($_GET);
        echo __METHOD__;
    }

    public function editAction(){
        echo __METHOD__;
    }

    public function testPageAction(){
        echo __METHOD__;
    }

    public function before(){
        echo __METHOD__;
    }

}