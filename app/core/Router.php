<?php
namespace app\core;
class Router
{
    protected $params = [];

    public function match ()
    {
        $url = trim($_SERVER['REQUEST_URI'],'/');
//        var_dump($url);
        if (!empty($url)){
            $params = explode('/',$url);
            if (!empty($params[0]) && !empty($params[1])){
                $this -> params = [
                    'controller' => $params[0],
                    'action' => $params[1]
                ];
            }
                else{
                    return false;
                }
            } else{
            $this -> params = [
                'controller' => 'main',
                'action' => 'index'
            ];
        }
        return true;
    }

    public function run()
    {
        $this -> match();
    }

}