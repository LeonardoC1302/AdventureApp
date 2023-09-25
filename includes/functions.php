<?php

function debug($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Sanitizing
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function isLast(string $current, string $next) : bool {
    return $current != $next;
}

// Protect Reservations Pages
function isAuth() : void{
    if(!isset($_SESSION['login'])){
        header('Location: /');
    }
}

function isAdmin() : void{
    if(!isset($_SESSION['admin'])){
        header('Location: /');
    }
}

// Show notifications
function showNotification($code){
    switch($code){
        case 1:
            $message = 'Created Successfully';
            break;
        case 2:
            $message = 'Updated Successfully';
            break;
        case 3:
            $message = 'Deleted Successfully';
            break;
        default:
            $message = False;
            break;
    }

    return $message;
}