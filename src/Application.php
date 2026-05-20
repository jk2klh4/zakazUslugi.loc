<?php

namespace src;

use src\exceptions\InvalidArgumentException;
use src\Entity;

class Application extends Entity {

    protected string $tableName = 'application';

    protected string $content;
    protected string $date;
    protected string $time;
    protected string $reason;
    protected string $create_at;

public function validate(){
        if (empty($this->content)) {
            throw new InvalidArgumentException('Не заполнен текст заявки');
        }
        if (empty($reason)) {
            throw new InvalidArgumentException('Не указана неисправность ');
        }
        if (mb_strlen($reason) > 255) {
            throw new InvalidArgumentException('Причина не должна превышать 255 символов');
        }
        if (empty($content)) {
            throw new InvalidArgumentException('Не заполнено состояние устройства');
        }
        if (empty($date)) {
            throw new InvalidArgumentException('Не выбрана дата посещения');
        }
        if (empty($time)) {
            throw new InvalidArgumentException('Не выбрано время посещения');
        }
    }

}
?>