<?php

namespace Model;

class ActiveRecord {
    // DB
    protected static $db;
    protected static $columns_db = [];
    protected static $table = '';

    // Validation
    protected static $alerts = [];

    public static function setDB($database){
        self::$db = $database;
    }

    public function save(){
        if(!is_null($this->id)){
            $result = $this->update();
        } else {
            $result = $this->create();
        }
        return $result;
    }

    public function create() {
        $attributes = $this->sanitizeData();
        // Insert data
        $query = "INSERT INTO " . static::$table . " ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";

        $result = self::$db->query($query);
        return [
            'result' =>  $result,
            'id' => self::$db->insert_id
         ];
    }

    public function update(){
        // Sanitize inputs
        $attributes = $this->sanitizeData();

        $values = [];
        foreach ($attributes as $key=>$value) {
            $values[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$table . " SET ";
        $query .= join(', ', $values);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $result = self::$db->query($query);
        return $result;
    }
    // Delete a register
    public function delete(){
        $query = "DELETE FROM " . static::$table . " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";
        $result = self::$db->query($query);
        return $result;
    }

    // Identify all the attributes of the object
    public function attributes(){
        $attributes = [];
        foreach (static::$columns_db as $column) {
            if($column === 'id')  continue; 
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    public function sanitizeData(){
        $attributes = $this->attributes();
        $sanitized = [];
        foreach ($attributes as $key=>$value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    // Validate the inputs
    public static function getAlerts() {
        return static::$alerts;
    }

    public static function setAlerts($type, $message){
        static::$alerts[$type][] = $message;
    }

    public function validate(){
        static::$alerts = [];
        return static::$alerts;
    }

    public static function all(){
        $query = "SELECT * FROM " . static::$table;
        $result = self::querySQL($query);
        return $result;
    }

    public static function get($quantity){
        $query = "SELECT * FROM " . static::$table . " LIMIT " . $quantity;
        $result = self::querySQL($query);
        return $result;
    }

    public static function where($column, $value){
        $query = "SELECT * FROM " . static::$table . " WHERE $column = '$value'";
        $result = self::querySQL($query);
        return array_shift($result); // Get the first element of the array
    }

    public static function SQL($query){
        $result = self::querySQL($query);
        return $result;
    }

    public static function querySQL($query){
        $result = self::$db->query($query);
        $array = [];
        while($register = $result->fetch_assoc()){
            $array[] = static::createObject($register);
        }
        $result->free(); // Free the memory
        return $array;
    }

    protected static function createObject($register){
        $object = new static;
        foreach($register as $key=>$value){
            if(property_exists($object, $key)){
                $object->$key = $value;
            }
        }
        return $object;
    }

    // Sync the object with the new values
    public function sync($args = []){
        foreach($args as $key=>$value){
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}