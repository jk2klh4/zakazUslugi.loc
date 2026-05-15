<?php

namespace src;

use src\exceptions\InvalidArgumentException;
use src\Entity;

class User extends Entity{

    protected string $tableName = 'user';


    protected string $login;
    protected string $password;
    protected string $fio;
    protected string $email;
    protected string $phone;

    protected bool $isGuest = true;
    protected bool $isAdmin = false;




    public function getLogin(): string{
        return $this->login;
    }
    public function getPassword(): string{
        return $this->password;
    }
    public function getFio(): string{
        return $this->fio;
    }
    public function getEmail(): string{
        return $this->email;
    }
    public function getPhone(): string{
        return $this->phone;
    }

    public function validate(){
        if(empty($this->login)){
            throw new InvalidArgumentException('Не передан логин пользователя');
        }
        if(empty($this->password)){
            throw new InvalidArgumentException('Не передан пароль пользователя');
        }
        if(empty($this->fio)){
            throw new InvalidArgumentException('Не передано ФИО пользователя');
        }
        $passwordLength = mb_strlen($this->password);
        if ($passwordLength < 6) {
            throw new InvalidArgumentException('Пароль должен содержать не менее 6 символов');
        }
        if ($passwordLength > 30) {
            throw new InvalidArgumentException('Пароль должен содержать не более 30 символов');
        }
        if (!preg_match('/^[a-zA-Z0-9]+$/', $this->password)) {
            throw new InvalidArgumentException('Пароль должен состоять только из латинских букв и цифр');
        }
        if(!preg_match('/^[а-яА-Я\s\-]+$/u', $this->fio)){
            throw new InvalidArgumentException('ФИО может состоять только из символов русского алфавита');
        }
        if(!preg_match('/^[а-яА-Я\s\-]+(\s[а-яА-Я]+){1,2}$/u', $this->fio)){
            throw new InvalidArgumentException('ФИО неверный формат: должно быть Фамилия Имя Отчество(при наличии)');
        }
        if(empty($this->email)){
            throw new InvalidArgumentException('Не передан email пользователя');
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            throw new InvalidArgumentException('Некорректный email');
        }
        if(empty($this->phone)){
            throw new InvalidArgumentException('Не передан номер телефона пользователя');
        }
        if(!preg_match('/^\+7\(\d{3}\)-\d{3}-\d{2}-\d{2}$/', $this->phone)){
            throw new InvalidArgumentException('Введите номер телефона в формат: +7(XXX)-XXX-XX-XX');
        }    

        if ($this->find($this->tableName, 'login', $this->login)) {
            throw new InvalidArgumentException('Пользователь с таким логином уже зарегистрирован');
        }

        if ($this->find($this->tableName, 'email', $this->email)) {
            throw new InvalidArgumentException('Пользователь с таким Email уже зарегистрирован');
        }

        
    }

    public function save(): bool
    {

        $fields = [
            'login' => $this->login,
            'password' => $this->password,
            'fio' => $this->fio,
            'email' => $this->email,
            'phone' => $this->phone,
            
        ];

        return $this->insert($fields);
    }

    public function find(string $table, string $column, mixed $value): bool {
        $sql = "SELECT EXISTS (SELECT 1 FROM `{$table}` WHERE `{$column}` = '{$value}') AS `is_exists`";

        $result = $this->db->querySql($sql);

        if (isset($result[0]['is_exists'])) {
            return (bool)$result[0]['is_exists'];
        }
        return false;
        
    }
}



?>