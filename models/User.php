<?php 

namespace Model;

class User extends ActiveRecord {
    protected static $table = 'users';
    protected static $columnsDB = ['id', 'name', 'lastName', 'email', 'password', 'phone', 'admin', 'verified', 'token'];

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
    
}