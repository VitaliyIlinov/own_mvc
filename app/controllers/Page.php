<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 18.04.2017
 * Time: 0:10
 */

namespace app\controllers;


use vendor\core\base\Controller;

class Page extends Controller {

    public function viewAction(){
        debug($this->route);
        debug($_GET);
        echo __METHOD__;
    }

}