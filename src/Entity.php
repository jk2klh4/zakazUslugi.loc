<?php

namespace src;

use src\services\Request;
use src\services\Db;

abstract class Entity{

    protected string $tableName;
    public int $id;


    public function __construct(protected Request $request, protected Db $db){

    }


    public function load(array $fields){
        foreach($fields as $key => $value){
            if(property_exists($this,$key)){
                $this->$key = $value;
            }
        }
    }
    public function insert(array $fields){
        $props = [];
        $values = [];
        foreach($fields as $key => $value){
            $props[] = $key;
            $values[] = $value;
        }
        $propsViaSemicolon = implode(', ', $props);
        $valuesViaSemicolon = implode('", "', $values);
        $sql = 'INSERT INTO ' . $this->tableName . '(' . $propsViaSemicolon . ')' . ' VALUES ( "' . $valuesViaSemicolon . '")';
        return $this->db->querySql($sql);
    }
    public function update(array $field): void{
        $propValuesArray = [];
        foreach($fields as $key => $value){
            $propValuesArray[] = "$key='$value'";
        }
        $propValues = implode(', ', $propValuesArray);
        $sql = "UPDATE " . $this->tableName. ' '. 'SET'.' '. $propValues.' '." WHERE id = '$this->id'";
        $this->db->querySql($sql);
    }

    public function delete($id){

    }
    public function findAll(): ?array{
        $sql = 'SELECT * FROM   ' . $this->tableName;
        $result = $this->db->querySql($sql);
        if($result === false) return null;
        return $result;
    }
    
    
    public function getById(int $id): ?array{
        $sql = "SELECT * FROM $this->tableName WHERE id = $id ";
        $result = $this->db->querySql($sql);
        return $result ? $result[0] : null;
    }


    public function findByColumn(string $columnName, $value, int $limit=0) : ? array{
        $strLimit = $limit ? " LIMIT $limit " : '';
        $sql = "SELECT * FROM " . $this->tableName . " WHERE $columnName = '$value'" . $strLimit;
        $result = $this->db->querySql($sql);
        return $result ? $result : null;
    
    }

    
    public function findOneByColumn(string $columnName, $value) : ?array{
        $result = $this->findByColumn($columnName, $value, 1);
        if (empty($result)) {
            return null;
        }
        
        return current($result);
    }


}

?>