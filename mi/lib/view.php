<?php

require_once('startup.php');

class View extends Object
{

    // members
    public $controller;
    public $action;
    public $primaryKey;

    // actions 
    public function __construct($param='', $layout='', $controller='', $action='', $primaryKey='')
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->primaryKey = $primaryKey;

        if ($param > '') {
            foreach($param as $key=>$value) {
                $this->set($key, $value);
            }
        }

        if ($layout > '')
            $this->setLayout($layout);
    }

    public function display($param='', $layout='', $flash='', $debug='')
    {
        // prevent cache for form fields, etc.
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);


        # a bit of a hack FIXME
        // make certain config variables easier to use in views
        $BASE_URL = Configure::read('BASE_URL');


        if ($layout) {

            // if we have a specified layout
            if (file_exists(Configure::read('BASE_DIR') . '/app/views/' . $this->controller . '/'
                            . $this->action . '.mhtml')) {

                ob_start();     // start buffer

                include_once(Configure::read('BASE_DIR') . '/app/views/' . $this->controller . '/'
                             . $this->action . '.mhtml');
                             
                $html = ob_get_contents();      // pass the output to a variable
                ob_end_clean();     // end buffer

                $content_for_layout = $debug . $flash . $html;

                try {
                    if (file_exists(Configure::read('BASE_DIR') . '/app/views/layouts/' . $layout . '.mhtml'))
                        include(Configure::read('BASE_DIR') . '/app/views/layouts/' . $layout . '.mhtml');
                    else

                        throw new Exception('There is no view for this layout! ('
                                            . $layout . ')');
                } catch (Exception $e) {
                    myExceptionHandler($e);
                }

            }
            try {
                if (!file_exists(Configure::read('BASE_DIR') . '/app/views/' . $this->controller . '/'
                                 . $this->action . '.mhtml'))
                    throw new Exception($this->controller .
                                        '\' class could not be found');
            } catch (Exception $e) {
                myExceptionHandler($e);
            }

        } else {
        
            // no specified layout, just show the view
            try {
                if (file_exists(Configure::read('BASE_DIR') . '/app/views/' . $this->controller
                                . '/' . $this->action . '.mhtml')) {
                    include(Configure::read('BASE_DIR') . '/app/views/' . $this->controller . '/'
                            . $this->action . '.mhtml');
                } else {
                    throw new Exception('There is no view for this controller\'s
                                        action! ('. $this->controller . ' > '
                                        . $this->action . ')');
                }
            } catch (Exception $e) {
                myExceptionHandler($e);
            }
            
        }
    }

}

?>
