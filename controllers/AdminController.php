<?php

namespace Controllers;
use MVC\Router;


class AdminController{
    public static function index(Router $router){
        session_start();
        $router->render('admin/index', [
            'name' => $_SESSION['name']
        ]);
    }
}