<?php

namespace src;

use src\services\Request;
use src\services\Db;

abstract class Entity{

    protected string $tableName;
    protected int $id;


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
    public function update(array $field){

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
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE id = ' . $id;
        $result = $this->db->querySql($sql, [':id' => $id]);
        
        if (empty($result)) {
            return null;
        }
        
        return $result;
        

    }

    

    public function findByColumn(string $columnName, $value, int $limit=0) : ? array{
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $columnName . ' = value';
        $result = $this->db->querySql($sql, [':value' => $value]);
        
        if (empty($result)) {
            return null;
        }
        
        return $result;
    
    }


}

?>