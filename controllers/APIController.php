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

    public static function delete() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $reservation = Reservation::where('id', $id);
            $reservation->delete();
            header('Location: ' . $_SERVER['HTTP_REFERER']); // Redirect to the previous page
        }
    }
}