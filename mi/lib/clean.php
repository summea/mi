<?php

require_once('startup.php');

class Clean
{
    // members

    // methods 
    public function __construct()
    {
    }

    public static function numbersOnly($data)
    {
        return preg_replace('/[^\d]+/i', '', $data);
    }

    public static function lettersOnly($data)
    {
        return preg_replace('/[^A-Za-z]+/i', '', $data);
    }

    public static function alphanumericOnly($data)
    {
        return preg_replace('/[^A-z]+/i', '', $data);
    }
    
    public static function custom($data, $regexp)
    {
        return preg_replace($regexp, '', $data);
    }
}

?>
