<?php

require_once('startup.php');

class Model extends Object
{

    // members
    public $useTable;
    public $controller;
    public $action;
    public $primaryKey;

    // methods
    public function __construct($useTable='', $controller='', $action='', $primaryKey=null)
    {
        //$this->useTable = $useTable;
        $this->controller = $controller;
        $this->action = $action;
        $this->primaryKey = $primaryKey;
    }

    public static function openDBConnection()
    {
        $db = new PDO(
            Configure::read('DBDRIVER') . ':host='.
            Configure::read('HOST') . ';dbname=' . 
            Configure::read('DATABASE'),
            Configure::read('USER'),
            Configure::read('PASSWORD')
        );
        return $db;
    }   

    public static function closeDBConnection()
    {
    }

    public static function query($query)
    {
        $db = Model::openDBConnection();
        $q = $db->prepare($query);
        $q->execute();
        return $q;
    }
    
    public static function execute($query)
    {
        $db = Model::openDBConnection();
        $q = $db->prepare($query);
        $q->execute();
    }

    public static function create($data)
    {
        $db = Model::openDBConnection();
        if (isset($data['table'])) {
            $query = 'INSERT INTO `' . $data['table'] . '`' .
                ' (' . implode(', ', array_keys($data['data'])) . ')' .
                ' values (:' . implode(', :', array_keys($data['data'])) . ')';
            $q = $db->prepare($query);
            foreach ($data['data'] as $k => $v) {
                $data['data'][":$k"] = $v;
                unset($data['data'][$k]);
            }
            $q->execute($data['data']);
            return $q;
        } else {
            return;
        }
    }

    public static function read($query)
    {

    }

    public static function update($data)
    {
        $db = Model::openDBConnection();
        if (isset($data['table'])) {

            $update_array = array();
            foreach ($data['data'] as $k => $v) {
                array_push($update_array, $k . '=:' . $k);
            }

            $query = 'UPDATE `' . $data['table'] . '`' .
                ' SET ' . implode(', ', $update_array) . 
                ' WHERE ' . PRIMARY_KEY . '=' . $data['primaryKey'];
                echo $query;
                exit;
            $q = $db->prepare($query);
            foreach ($data['data'] as $k => $v) {
                $data['data'][":$k"] = $v;
                unset($data['data'][$k]);
            }
            $q->execute($data['data']);
            return $q;
        } else {
            return;
        }
 
    }

    public static function delete($query)
    { 

    }

    public function setUseTable($table)
    {
        $this->useTable = $table;
    }

    public function getUseTable()
    {
        return $this->useTable;
    }

    public function save($data)
    {
    /*
        $primary_key = 0;
    
        if (isset($_GET[PRIMARY_KEY])) {
            $primary_key = (int)$_GET[PRIMARY_KEY];
        }
        echo $_GET[PRIMARY_KEY];
        exit;
*/
print_r($_POST);
        try {
            if (empty($data))
                throw new Exception('No data to save!');
     
              $db = Model::openDBConnection();
              
              if ($data['submit'])
                  unset($data['submit']);

#echo $this->getPrimaryKey();
exit;
              if ($this->getPrimaryKey()) {
                  $this->update(
                      array(
                          'table' => $this->useTable,
                          'data'  => $data,
                          'primaryKey' => $this->getPrimaryKey()
                      )
                  );
              } else {
                  $this->create(
                      array(
                          'table' => $this->useTable,
                          'data'  => $data
                      )
                  );
              }

/*
              if (isset($data['id'])) {   // UPDATE QUERY
              
                  $query = sprintf("update %s set ", $this->useTable);

                  foreach($data as $key => $value) {
                      if ($key != 'id' && $key != 'submit')
                          $query .= $key . '=\'' .
                          mysql_real_escape_string($value) . '\', ';
                  }

                  $query = substr($query, 0, -2);

                  $query .= ' where id=' . $data['id'];

              } else {    // INSERT QUERY
            
                  $query = sprintf("insert into %s", $this->useTable);
                  
                  $fields = '';
                  $values = '';

                  foreach($data as $key => $value) {
                      if ($key != 'submit') {
                          $fields .= $key . ',';
                          $values .= '\'' . mysql_real_escape_string($value) . '\',';
                      }
                  }

                  $fields = substr($fields, 0, -1);
                  $values = substr($values, 0, -1);
               
                  $fields = '(' . $fields . ')';
                  $values = '(' . $values . ')';

                  $query .= ' ' . $fields . ' VALUES' . $values;

              }
*/
              #$query = $this->execute($query);

              #return array('query' => $query);
        } catch (Exception $e) {
            myExceptionHandler($e);
        }
    }

    public function destroy($id)
    {
        try {
            if (empty($id)) {
                throw new Exception('No id to destroy!');
            } else {
       
                $db = Model::openDBConnection();

                if (isset($id)) {   // DELETE QUERY
                
                    $query = sprintf("delete from %s where id=%d", $this->useTable, $id);
                    
                }

                $query = $this->execute($query);

                return $return_this;
            }
        } catch (Exception $e) {
            myExceptionHandler($e);
        }
    }

}

?>
