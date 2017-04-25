<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 25.04.2017
 * Time: 21:18
 */

namespace vendor\core;


class Db {

    protected $pdo;
    protected static $instance;

    protected function __construct() {
        $db = require ROOT.DS.'config'.DS.'config_db.php';
        $this->pdo = new \PDO($db['dsn'],$db['user'],$db['pass']);
    }

    public static function instance(){
        if(self::$instance===null){
            return self::$instance= new self;
        }
    }

    public function execute($sql){
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }

    public function query($sql){
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute();
        if($res !==false){
            return $stmt->fetchAll();
        }
        return [];
    }
}