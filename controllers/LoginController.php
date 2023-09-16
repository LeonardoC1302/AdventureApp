<?php

namespace Controllers;
use MVC\Router;
use Model\User;
use Classes\Email;

class LoginController{
    public static function login(Router $router){
        $alerts = [];

        $auth = new User();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth->sync($_POST);
            $alerts = $auth->validateLogin();
        }

        $router->render('auth/login', [
            'alerts' => $alerts,
            'auth' => $auth
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
        $user = new User();
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user->sync($_POST);
            $alerts = $user->validateRegister();}

            if(empty($alerts['error'])){
                $result = $user->exists();
                if($result->num_rows){
                    $alerts = User::getAlerts();
                } else{
                    // Hash password
                    $user->hashPassword();
                    // Generate token
                    $user->generateToken();
                    // Send email
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendConfirmation();
                    // Save user
                    $result = $user->save();
                    if($result){
                        header('Location: /message');
                    }
                }
        }

        $router->render('auth/register', [
            'user' => $user,
            'alerts' => $alerts
        ]);
    }

    public static function verify(Router $router){
        $alerts = [];
        $token = s($_GET['token'] ?? null);

        $user = User::where('token', $token);
        if(empty($user)) {
            User::setAlerts('error', 'Invalid token');
        } else {
            $user->verified = 1;
            $user->token = '';
            $user->save();
            User::setAlerts('success', 'Your account has been verified');
        }

        $alerts = User::getAlerts();
        $router->render('auth/verify', [
            'alerts' => $alerts
        ]);
    }

    public static function message(Router $router){
        $router->render('auth/message', [
            
        ]);
    }
}