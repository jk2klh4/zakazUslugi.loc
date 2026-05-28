<?php

namespace src;

use src\exceptions\InvalidArgumentException;
use src\Entity;

class Application extends Entity {

    protected string $tableName = 'application';


    public ?int $user_id = null;
    public ?int $status_id = null;

    public ?string $content = null;
    public ?string $date = null;
    public ?string $time = null;
    public ?string $reason = null;
    protected ?string $create_at = null;

    public function validate(){
        if (empty($this->reason)) {
            throw new InvalidArgumentException('Не заполнена краткая причина посещения');
        }
        if (mb_strlen($this->reason) > 255) {
            throw new InvalidArgumentException('Причина не должна превышать 255 символов');
        }
        if (empty($this->content)) {
            throw new InvalidArgumentException('Не заполнена подробная причина посещения');
        }
        if (mb_strlen($this->content) < 50 ) {
            throw new InvalidArgumentException('Подробная причина посещения должна быть не менее 50 символов');
        }
        if (empty($this->date)) {
            throw new InvalidArgumentException('Не выбрана дата посещения');
        }
        if (empty($this->time)) {
            throw new InvalidArgumentException('Не выбрано время посещения');
        }
        $visitDateTime = $this->date . ' ' . $this->time;
        if ($visitDateTime <= date('Y-m-d H:i:s')) {
            throw new InvalidArgumentException('Дата не может быть в прошлом');
        }

        if ($this->time < '08:00' || $this->time > '20:00') {
            throw new InvalidArgumentException('Выберете время с 8:00 до 20:00');
        }
    }
     public function validateAdminTime() {
        if (empty($this->date)) {
            throw new InvalidArgumentException('Не выбрана дата посещения');
        }
        if (empty($this->time)) {
            throw new InvalidArgumentException('Не выбрано время посещения');
        }

        if ($this->date < date('Y-m-d H:i:s')) {
            throw new InvalidArgumentException('Дата не может быть в прошлом');
        }

        if ($this->time < '08:00' || $this->time > '20:00') {
            throw new InvalidArgumentException('Выберете время с 8:00 до 20:00');
        }
    }


public function saveApplication(){
    if (empty($this->create_at)) {
        $this->create_at = date('Y-m-d H:i:s');
    }
    $this->status_id = 1;

    $fields = [
        'user_id'   => $this->user_id,    
        'status_id' => $this->status_id,  
        'content'   => $this->content,
        'date'      => $this->date,
        'time'      => $this->time,
        'reason'    => $this->reason,
        'create_at' => $this->create_at
    ];
    $result = $this->insert($fields);

}
}
?>