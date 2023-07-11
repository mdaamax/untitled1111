<?php

namespace app\core;
use PDO;
use PDOException;
abstract class BaseModel
{
    protected $db;

    public function __construct()
    {
        $config = require 'app/config/db.php';
        try {
            $this ->db = new PDO(
                $config['provider'] . ':host' . $config['hostname'] . ';dbname=' . $config ['database'],
                $config['username'],
                $config['password']
            );
        } catch (PDOException $ex){
            print 'Ошибка' . $ex -> getMessage() . '<br>';
            die();
        }
    }
}