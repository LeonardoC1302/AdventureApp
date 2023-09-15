<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;

$router = new Router();




// Checks and validates the routes, ensuring they exist and assigns them to the Controller functions
$router->checkRoutes();