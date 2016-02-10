<?php

require_once('conf.php');
#require_once('adodb/adodb.inc.php');
require_once('exceptions.php');

function __autoload($class) {
 
    $class = strtolower($class);
    
    if (class_exists($class, false) || interface_exists($class, false))
    {
        return;    
    }
    
    try {
        @require_once($LIB_DIR . $class . '.php');
        
        if (!class_exists($class, false)) {
            throw new Exception('Class ' . $class . ' not found');
        }
    } catch (Exception $e) {
        myExceptionHandler($e);
    }
}

?>
