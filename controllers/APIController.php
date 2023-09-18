<?php

namespace Controllers;
use Model\Activity;

class APIController{
    public static function index(){
        $activities = Activity::all();
        echo json_encode($activities);
    }
}