<?php

namespace Controllers;
use Model\Activity;
use Model\Reservation;

class APIController{
    public static function index(){
        $activities = Activity::all();
        echo json_encode($activities);
    }

    public static function save(){
        $reservation = new Reservation($_POST);
        $result = $reservation->save();
        echo json_encode($result);
    }
}