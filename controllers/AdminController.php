<?php

namespace Controllers;

use Model\AdminReservation;
use MVC\Router;


class AdminController{
    public static function index(Router $router){
        session_start();
        $date = $_GET['date'] ?? date('Y-m-d');
        $dates = explode('-', $date);
        if(!checkdate($dates[1], $dates[2], $dates[0])) {
            header('Location: /404');
        }

        // Get data
        $query = "SELECT r.id, r.time, CONCAT(u.name, ' ', u.lastName) as client, u.email, u.phone, a.name as activity, a.price ";
        $query .= "FROM reservations r ";
        $query .= "LEFT OUTER JOIN users u ";
        $query .= "ON r.userId=u.id ";
        $query .= "LEFT OUTER JOIN activitiesXreservation ar ";
        $query .= "ON ar.reservationId=r.id ";
        $query .= "LEFT OUTER JOIN activities a ";
        $query .= "ON a.id=ar.activityId ";
        $query .= "WHERE date = '$date'";

        $reservations = AdminReservation::SQL($query);

        $router->render('admin/index', [
            'name' => $_SESSION['name'],
            'reservations' => $reservations,
            'date' => $date
        ]);
    }
}