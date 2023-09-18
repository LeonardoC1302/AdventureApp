<?php

namespace Model;

class Activity extends ActiveRecord {
    protected static $table = 'activities';
    protected static $columns_db = ['id', 'name', 'description', 'price'];

    public $id;
    public $name;
    public $description;
    public $price;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->price = $args['price'] ?? '';
    }
}