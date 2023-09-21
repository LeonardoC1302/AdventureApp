<?php

namespace Controllers;
use Model\Activity;
use Model\Reservation;
use Model\ReservationActivities;

class APIController{
    public static function index(){
        $activities = Activity::all();
        echo json_encode($activities);
    }

    public static function save(){
        // Save reservation
        $reservation = new Reservation($_POST);
        $result = $reservation->save();
        $id = $result['id'];

        // Save activities
        $idsActivities = explode(',', $_POST['activities']);
        foreach($idsActivities as $idActivity){
            $args = [
                'reservationId' => $id,
                'activityId' => $idActivity
            ];
            $reservationActivity = new ReservationActivities($args);
            $reservationActivity->save();
        }

        // Return result
        echo json_encode(['result' => $result]);
    }
}