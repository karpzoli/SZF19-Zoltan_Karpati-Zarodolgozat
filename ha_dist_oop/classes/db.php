<?php
/**
 * Created by Chris on 9/29/2014 3:54 PM.
 */

class DB {
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_count = 0;

    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array()) {
        $this->_error = false;
        //if the PDO statement object is prepared successfully
        if($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            //if params is not empty
            if(count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            //if query was executed successfully
            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();               
            } else {
                $this->_error = true;
            }
        }

        return $this;
    }
      

    public function action($action, $table, $where = array()) {
    //check if all elements of the WHERE statement is in place
        if(count($where) === 3) {  
            $operators = array('=', '>', '<', '>=', '<=', 'LIKE');

            $field = $where[0];            
            $operator = $where[1]; 
            $value = $where[2];             

            //check the operator's validity
            if(in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }

        }

        return false;
    }

    public function insert($table, $fields = array()) {
        //Return all the keys or a subset of the keys of an array
        $keys = array_keys($fields);
        $values = null;
        $x = 1;
        //set values in row separated by commas
        foreach($fields as $field) {
            $values .= '?';
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }
        //implode returns with a string
        //"INSERT INTO MyGuests (firstname, lastname, email) VALUES ('John', 'Doe', 'john@example.com');";
        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
        
        if(!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    public function update($table, $id, $fields) {
        $set = '';
        $x = 1;

        foreach($fields as $name => $value) {
            $set .= "{$name} = ?";
            if($x < count ($fields)) {
                $set .= ', ';
            }
            $x++;
        }
        if($table == 'order_header'){$sql = "UPDATE {$table} SET {$set} WHERE order_number = {$id}";}
        else {$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";}

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    public function delete($table, $where) {
        return $this->action('DELETE ', $table, $where);
    }

    public function get($table, $where) {
        return $this->action('SELECT *', $table, $where);
    }

    public function getMAX($column, $table) {
        $this->action('SELECT MAX('.$column.') AS max', $table, array($column, '>', '0'));  
        return $this->results();
    }

    public function getField($table, $columnm, $where) {
        return $this->action('SELECT'." ".$columnm, $table, $where);
    }

    public function results() {
        return $this->_results;
    }

    public function first() {
        $data = $this->results();
        return $data[0];
    }

    public function count() {
        return $this->_count;
    }

    public function error() {
        return $this->_error;
    }
}