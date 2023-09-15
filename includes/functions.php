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