<?php

namespace Controllers;
use Model\Activity;

class APIController{
    public static function index(){
        $activities = Activity::all();
        echo json_encode($activities);
    }

    public static function save(){
        $answer = [
            'data' => $_POST
        ];

        echo json_encode($answer);
    }
}