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

    public function validate(){
        if(!$this->name){
            self::$alerts['error'][] = "Name is required";
        }
        if(!$this->description){
            self::$alerts['error'][] = "Description is required";
        }
        if(!$this->price){
            self::$alerts['error'][] = "Price is required";
        } else if(!is_numeric($this->price)){
            self::$alerts['error'][] = "Price must be a number";
        }

        return self::$alerts;
    }
}