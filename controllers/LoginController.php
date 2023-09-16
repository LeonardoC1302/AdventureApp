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
        $router->render('auth/message', [
            
        ]);
    }


    // Reservations
    public static function reservations(Router $router){
        echo "Reservations";
    }

    // Admin
    public static function admin(Router $router){
        echo "Admin";
    }
}