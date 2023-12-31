<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\ReservationController;
use Controllers\APIController;
use Controllers\AdminController;
use Controllers\ActivityController;

$router = new Router();

// Log In
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);

$router->get('/logout', [LoginController::class, 'logout']);

// Recover Password
$router->get('/forgot', [LoginController::class, 'forgot']);
$router->post('/forgot', [LoginController::class, 'forgot']);

$router->get('/recover', [LoginController::class, 'recover']);
$router->post('/recover', [LoginController::class, 'recover']);

// Register
$router->get('/register', [LoginController::class, 'register']);
$router->post('/register', [LoginController::class, 'register']);

// Verify Account
$router->get('/verify', [LoginController::class, 'verify']);
$router->get('/message', [LoginController::class, 'message']);


// Reservations
$router->get('/reservations', [ReservationController::class, 'index']);

// Admin
$router->get('/admin', [AdminController::class, 'index']);

// API
$router->get('/api/activities', [APIController::class, 'index']);
$router->post('/api/reservations', [APIController::class, 'save']);
$router->post('/api/delete', [APIController::class, 'delete']);

// Activities CRUD
$router->get('/activities', [ActivityController::class, 'index']);

$router->get('/activities/create', [ActivityController::class, 'create']);
$router->post('/activities/create', [ActivityController::class, 'create']);

$router->get('/activities/update', [ActivityController::class, 'update']);
$router->post('/activities/update', [ActivityController::class, 'update']);

$router->post('/activities/delete', [ActivityController::class, 'delete']);


// Checks and validates the routes, ensuring they exist and assigns them to the Controller functions
$router->checkRoutes();