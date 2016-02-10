<?php

$routes = array(
  # '/something' => array('controller' => 'something', 'action' => 'stuff')
    '*' => array('controller' => ':controller', 'action' => ':action', 'primary_key' => ':primary_key')
);

?>
