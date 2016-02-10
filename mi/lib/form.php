<?php

require_once('startup.php');

class Form extends Helper
{
    // members
    public $form;
    public $primaryKey;

    // methods 
    public function __construct($options=array(), $primaryKey='')
    {
        $this->primaryKey = $primaryKey;
        $this->form = "<form ";
        if (isset($options['method']))
            $this->form .= "method=\"{$options['method']}\" ";
        else
            $this->form .= "method=\"post\" ";
        if (isset($options['action']))
            $this->form .= "action=\"{$options['action']}\" ";
        $this->form .= "enctype=\"multipart/form-data\">\n";
        return $this->form;
    }

    public function input($options=array())
    {
        if (isset($options['type'])) {
            switch($options['type']) {
                case "text":
                    $this->form .= "<input type=\"text\" /><br />\n";
                    break;
                case "textarea":
                    $this->form .= "<textarea></textarea><br />\n";
                    break;
                case "submit":
                    $this->form .= "<input type=\"submit\" /><br />\n";
                    break;
            }
        } else {
            $this->form .= "<input type=\"text\" />\n";
        }
    }

    public function end()
    {
        $instance = Object::singleton();
        $primary_key = $instance->getPrimaryKey();
        $this->form .= "<input type=\"text\" name=\"primaryKey\" value=\"$primary_key\" />\n";
        $this->form .= "</form>\n";
        echo $this->form;
    }
}

?>
