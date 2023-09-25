<?php

namespace Controllers;

use MVC\Router;
use Model\Activity;

class ActivityController{
    public static function index(Router $router){
        session_start();
        isAdmin();

        $activities = Activity::all();

        $router->render('activities/index', [
            'name' => $_SESSION['name'],
            'activities' => $activities,
        ]);
    }

    public static function create(Router $router){
        session_start();
        isAdmin();

        $activity = new Activity;
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activity->sync($_POST);
            $alerts = $activity->validate();

            if(empty($alerts['error'])){
                $activity->save();
                header('Location: /activities');
            }
        }

        $router->render('activities/create', [
            'name' => $_SESSION['name'],
            'activity' => $activity,
            'alerts' => $alerts
        ]);
    }

    public static function update(Router $router){
        session_start();
        isAdmin();

        if(!is_numeric($_GET['id'])) return;
        $activity = Activity::where('id', $_GET['id']);
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activity->sync($_POST);
            $alerts = $activity->validate();

            if(empty($alerts['error'])){
                $activity->save();
                header('Location: /activities');
            }
        }

        $router->render('activities/update', [
            'name' => $_SESSION['name'],
            'activity' => $activity,
            'alerts' => $alerts
        ]);
    }

    public static function delete(){
        session_start();
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $activity = Activity::where('id', $id);
            $activity->delete();
            header('Location: /activities');
        }
    }
}