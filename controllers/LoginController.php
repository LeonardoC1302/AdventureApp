<?php

namespace Controllers;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $router->render('auth/login', [
            
        ]);
    }

    public static function logout(Router $router){
        echo "Logout";
    }

    public static function forgot(Router $router){
        $router->render('auth/forgot', [
            
        ]);
    }

    public static function recover(Router $router){
        echo "Recover Password";
    }

    public static function register(Router $router){
        $router->render('auth/register', [
            
        ]);
    }
}