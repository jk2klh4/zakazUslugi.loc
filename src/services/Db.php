<?php

namespace src\services;

use src\exceptions\DbException;

class Db extends \mysqli{
    public function __construct($config){
        try{
            parent::__construct(
                $config['hostname'],
                $config['username'],
                $config['password'],
                $config['database']);
        } catch (\mysqli_sql_exception $e){
            throw new DbException('Ошибка при подключении к базе данных: ' . $e->getMessage());
        }
    }

    public function querySql(string $sql, array $params = []) : array|bool{
        $result = parent::query($sql);
        if(gettype($result) == 'boolean') return $result;
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>