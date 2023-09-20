<?php

namespace Model;

class Reservation extends ActiveRecord {
    protected static $table = 'reservations';
    protected static $columns_db = ['id', 'date', 'time', 'userId'];

    public $id;
    public $date;
    public $time;
    public $userId;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->date = $args['date'] ?? '';
        $this->time = $args['time'] ?? '';
        $this->userId = $args['userId'] ?? null;
    }
}