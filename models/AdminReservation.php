<?php

namespace Model;

class AdminReservation extends ActiveRecord {
    protected static $table = 'activitiesXreservation';
    protected static $columnsDB = ['id', 'time', 'client', 'email', 'phone', 'activity', 'price'];

    public $id;
    public $time;
    public $client;
    public $email;
    public $phone;
    public $activity;
    public $price;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->time = $args['time'] ?? '';
        $this->client = $args['client'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->activity = $args['activity'] ?? '';
        $this->price = $args['price'] ?? '';
    }
}