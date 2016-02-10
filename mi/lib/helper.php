<?php

require_once('startup.php');

class Helper extends Object
{
    // members
    public $param = array();

    // methods 
    public function __construct()
    {
    }

    public function get()
    {
        return $this->param;
    }

    public function set($key, $value)
    {
        $this->param[$key] = $value;
    }
}

?>
