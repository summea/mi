<?php

require_once('startup.php');

class Object
{
    // members
    public $flash;
    public $controller;
    public $action;
    private static $primaryKey;
    public $params;
    private static $instance;

    // methods 
    private function __construct(
        $model='',
        $controller='',
        $action='',
        $primaryKey='',
        $params=''
    )
    {
        if ($controller > '') {

            $this->model = $model;
            $this->controller = $controller;
            $this->action = $action;
            $this->primaryKey = $primaryKey;
            $this->params = $params;

            $modelName = ucfirst($model);
            $controllerName = ucfirst($controller) . 'Controller';

            # model
            $this->$modelName = new $modelName;

            # controller
            $this->$controllerName = new $controllerName(
                $this->controller,
                $this->action,
                $this->primaryKey
            );

            # view
            $this->View = new View($this->$controllerName->get(),
                $this->$controllerName->getLayout(),
                $this->controller,
                $this->action,
                $this->primaryKey);

            $this->Form = new Form(null, $this->primaryKey);

        } else {
            // instantiate model, controller, view classes
            $this->Model = new Model;
            $this->Controller = new Controller;
            $this->View = new View;
        }
    }

    public static function singleton(
        $model='',
        $controller='',
        $action='',
        $primaryKey='',
        $params=''
    )
    {
        if (!isset(self::$instance)) {
            self::$instance = new Object($model, $controller, $action, $primaryKey, $params);
        }
        return self::$instance;
    }

    public function get()
    {
        return $this->param;
    }

    public function set($key, $value)
    {
        $this->param[$key] = $value;
    }

    public function getURL()
    {
        return $_SERVER['REQUEST_URI'];
    }
    
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function setLayout($newLayout)
    {
        $this->layout = $newLayout;
    }

    public function setUseTable($table)
    {
        $this->useTable = $table;
    }

    public function getUseTable()
    {   
        return $this->useTable;
    }

    public function redirect($goto)
    {
        Header('Location:' . BASE_URL . '/' . $goto);
    }

    public function flash($message)
    {
        $this->setFlash($message);
    }

    public function setFlash($flash)
    {
        $_SESSION['flash'] = array("message" => $flash, "count" => 0);
    }

    public function getFlash()
    {
        return $_SESSION['flash']['message'];
    }

    public function getFlashCount()
    {
        return $_SESSION['flash']['count'];
    }

    public function increaseFlashCount()
    {
        $_SESSION['flash']['count']++;
    }


}

?>
