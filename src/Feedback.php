<?php

namespace src;

use src\Entity;
use src\exceptions\InvalidArgumentException;
use src\exceptions\invalidArgumentException as ExceptionsInvalidArgumentException;

class Feedback extends Entity{
    protected string $fio;
    protected string $phone;
    protected string $text;
    protected array $image_file;
    protected string $create_at;
    protected string $agree;

    
    public function getFio(): string{
        return $this->fio;
    }
    
    public function getPhone(): string{
        return $this->phone;
    }
    public function getText(): string{
        return $this->text;
    }


    protected string $tableName = 'review';


    public function  loadFromForm(array $fields, array $files){
        $fields['image_file'] = $files;
        $this->load($fields);
    }

    public function validate(){
        if(empty($this->fio)){
            throw new InvalidArgumentException('Не передано ФИО пользователя');
        }
    

        if(empty($this->phone)){
            throw new InvalidArgumentException('Не передан телефон');
        }
    


        if(empty($this->text)){
            throw new InvalidArgumentException('Не передан текст отзыва');
        }
    

        if(!preg_match('/^[а-яА-Я\s\-]+$/u', $this->fio)){
            throw new InvalidArgumentException('ФИО может состоять только из символов русского алфавита');
        }


        if(!preg_match('/^[а-яА-Я\s\-]+(\s[а-яА-Я]+){1,2}$/u', $this->fio)){
            throw new InvalidArgumentException('ФИО неверный формат: должно быть Фамилия Имя Отчество(при наличии)');
        }


        if(!preg_match('/^\+7\(\d{3}\)-\d{3}-\d{2}-\d{2}$/', $this->phone)){
            throw new InvalidArgumentException('Введите номер телефона в формат: +7(XXX)-XXX-XX-XX');
        }    


        if(!preg_match('/^[\s\S]{50,1000}$/', $this->text)){
            throw new InvalidArgumentException('Отзыв должен быть не менее 50 и не более 1000 символов');
        }    


        if(empty($this->image_file)){
            throw new InvalidArgumentException("Не загружен файл");
        }
        $allowedExtensions = ['jpg', 'png', 'gif'];
        $extension = pathinfo($this->image_file['name'], PATHINFO_EXTENSION);
        if(!in_array($extension,$allowedExtensions)){
            throw new InvalidArgumentException("Загрузите файл с расширением jpg, png, gif.");
        }
        if($this->image_file['size'] > 5*1024*1024){
            throw new ExceptionsInvalidArgumentException("Слишком большой файл. Загрузите файл размером не более 5 мегабайт");
        }
    

        if(empty($this->agree)){
            throw new InvalidArgumentException('Нужно согласиться с обработкой персональных данных');
        }
    
    }

    public function save(): bool{
        $pathFile ='uploads/' . $this->image_file['name'];
        if(!move_uploaded_file($this->image_file['tmp_name'], $pathFile)){
            throw new InvalidArgumentException('Ошибка при загрузке файла');
        }
        $fields = ['fio' => $this->fio, 
        'phone' => $this->phone,
        'text' => $this->text,
        'image_file' => $this->$pathFile,
        ];
        return $this->insert($fields);
    }

    
}
?>