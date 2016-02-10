<?php

require_once('startup.php');

class Configure
{
    public static function read($var)
    {
        global ${$var};

        return ${$var};
    }

    public function set()
    {
    }
}

?>
