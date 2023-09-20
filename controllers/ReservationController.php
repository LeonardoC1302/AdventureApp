<?php

namespace Controllers;
use MVC\Router;

class ReservationController
{
    public static function index(Router $router) {
        session_start();
        $router->render('reservations/index', [
            'name' => $_SESSION['name'],
            'id' => $_SESSION['id']
        ]);
    }
}
