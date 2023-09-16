<?php 

namespace Model;

class User extends ActiveRecord {
    protected static $table = 'users';
    protected static $columns_db = ['id', 'name', 'lastName', 'email', 'password', 'phone', 'admin', 'verified', 'token'];

    public $id;
    public $name;
    public $lastName;
    public $email;
    public $password;
    public $phone;
    public $admin;
    public $verified;
    public $token;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->lastName = $args['lastName'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->verified = $args['verified'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    public function validateRegister() {
        if(!$this->name) {
            self::$alerts['error'][] = 'The name is mandatory';
        }
        if(!$this->lastName) {
            self::$alerts['error'][] = 'The last name is mandatory';
        }
        if(!$this->email) {
            self::$alerts['error'][] = 'The email is mandatory';
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'The email is not valid';
        }
        if(!$this->password) {
            self::$alerts['error'][] = 'The password is mandatory';
        }
        if($this->password && strlen($this->password) < 6) {
            self::$alerts['error'][] = 'The password must be at least 6 characters';
        }
        if(!$this->phone) {
            self::$alerts['error'][] = 'The phone is mandatory';
        }
        return self::$alerts;
    }

    public function validateLogin(){
        if(!$this->email) {
            self::$alerts['error'][] = 'The email is mandatory';
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'The email is not valid';
        }
        if(!$this->password) {
            self::$alerts['error'][] = 'The password is mandatory';
        }
        return self::$alerts;
    }

    public function exists(){
        $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";
        $result = self::$db->query($query);

        if($result->num_rows) {
            self::$alerts['error'][] = 'The email is already registered';
        }

        return $result;
    }

    public function validateEmail(){
        if(!$this->email) {
            self::$alerts['error'][] = 'The email is mandatory';
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'The email is not valid';
        }
        return self::$alerts;
    }

    public function validatePassword(){
        if(!$this->password) {
            self::$alerts['error'][] = 'The password is mandatory';
        }else if(strlen($this->password) < 6) {
            self::$alerts['error'][] = 'The password must be at least 6 characters';
        }
        return self::$alerts;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    
    public function generateToken() {
        $this->token = uniqid();
    }

    public function verifyPasswordVerified($password){
        $result = password_verify($password, $this->password);
        
        if(!$result || !$this->verified){
            self::$alerts['error'][] = 'The password is incorrect or the account is not verified';
        } else {
            return true;
        }
    }
    
}