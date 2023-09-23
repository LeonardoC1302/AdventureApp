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