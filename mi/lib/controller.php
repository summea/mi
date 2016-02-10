<?php

require_once('startup.php');

class Controller extends Object
{

    // members
    public $controller;
    public $action;
    public $primaryKey;
    
    // methods
    public function __construct($controller='', $action='', $primaryKey=null)
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->primaryKey = $primaryKey;
    }

    public function setUseTable($table)
    {
        $this->useTable = $table;
    }

    public function getUseTable()
    {   
        return $this->useTable;
    }
/*
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }
    */
}

?>
