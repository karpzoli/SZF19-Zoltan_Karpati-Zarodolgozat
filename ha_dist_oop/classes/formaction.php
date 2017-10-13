<?php

Class formAction{
    protected   $_db,
                $_orderNr;
         
    public function __construct(){
        $this->_db = DB::getInstance();
    }     

    protected function GetNewRecordNr($column, $table){  
        $this->_db->getMAX($column, $table);    
        $_orderNr = $this->_db->results(); 
        $result = $_orderNr[0]->max;  
        return $result+=1;              
    } 

    public function GetAllRecords($table, $where){
        $this->_db->get($table, $where);
        return $this->_db->results(); 
    }

    public function GetRecordField($table, $column, $where){
        $this->_db->getField($table, $column, $where);
        return $this->_db->results();
    } 

    public function DeleteRecord($table, $where){
        if($this->_db->delete($table, $where)) return true;
        else return false;
    }
}

?> 