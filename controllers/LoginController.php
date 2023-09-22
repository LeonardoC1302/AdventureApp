<?php

namespace Controllers;
use MVC\Router;
use Model\User;
use Classes\Email;

class LoginController{
    public static function login(Router $router){
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new User($_POST);
            $auth->sync($_POST);
            $alerts = $auth->validateLogin();

            if(empty($alerts['error'])){
                // check if user exists
                $user = User::where('email', $auth->email);
                if($user){
                    // check if password is correct
                    if($user->verifyPasswordVerified($auth->password)){
                        session_start();
                        $_SESSION['id'] = $user->id;
                        $_SESSION['name'] = $user->name . " " . $user->lastName;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['login'] = true;
                        // Redirect 
                        if($user->admin == 1){
                            $_SESSION['admin'] = $user->admin;
                            header('Location: /admin');
                        } else{
                            header('Location: /reservations');
                        }
                    }
                } else{
                    User::setAlerts('error', 'The user does not exist');
                }
            }

        }

        $alerts = User::getAlerts();
        $router->render('auth/login', [
            'alerts' => $alerts
        ]);
    }

    public static function logout(Router $router){
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function forgot(Router $router){
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new User($_POST);
            $alerts = $auth->validateEmail();

            if(empty($alerts)){
                $user = User::where('email', $auth->email);
                if($user && $user->verified === "1"){
                    // Generate token
                    $user->generateToken();
                    $user->save();
                    // Send email
                    $mail = new Email($user->email, $user->name, $user->token);
                    $mail->sendRecover();
                    // Success message
                    User::setAlerts('success', 'Check your email to recover your password');
                } else{
                    User::setAlerts('error', 'The user does not exist or is not verified');
                }
            }
        }

        $alerts = User::getAlerts();
        $router->render('auth/forgot', [
            'alerts' => $alerts
        ]);
    }

    public static function recover(Router $router){
        $error = false;
        $alerts = [];
        $token = s($_GET['token'] ?? null);
        $user = User::where('token', $token);
        if(empty($user) || $token === ''){
            User::setAlerts('error', 'Invalid token');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $password = new User($_POST);
            $alerts = $password->validatePassword();

            if(empty($alerts['error'])){
                $user->password = $password->password;
                $user->hashPassword();
                $user->token = '';
                $result = $user->save();
                if($result){
                    header('Location: /');
                }
            }
        }

        $alerts = User::getAlerts();
        $router->render('auth/recover', [
            'alerts' => $alerts,
            'error' => $error
        ]);
    }

    public static function register(Router $router){ 
        $user = new User();
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user->sync($_POST);
            $alerts = $user->validateRegister();

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
        $router->render('auth/message');
    }
}