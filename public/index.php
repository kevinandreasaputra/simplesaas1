<?php
// session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\Core\Router;
use App\Controllers\Web\HomeController;
use App\Controllers\Web\ServiceController;
use App\Controllers\Web\AuthController;
use App\Controllers\Web\BookingController;
use App\Controllers\Web\AdminController;
use App\Controllers\Api\ServiceController as ApiServiceController;
use App\Controllers\Api\AuthController as ApiAuthController;
use App\Controllers\Api\BookingController as ApiBookingController;

$router = new Router();

// Web Routes
$router->add('GET', '/', [HomeController::class, 'index']);
$router->add('GET', '/about', [HomeController::class, 'about']);
$router->add('GET', '/login', [AuthController::class, 'loginPage']);
$router->add('POST', '/login', [AuthController::class, 'loginProcess']);
$router->add('GET', '/logout', [AuthController::class, 'logout']);
$router->add('GET', '/services', [ServiceController::class, 'index']);
$router->add('POST', '/booking/process', [BookingController::class, 'process']);
$router->add('GET', '/my-orders', [BookingController::class, 'history']);

// Admin Routes
$router->add('GET', '/admin', [AdminController::class, 'dashboard']);
$router->add('POST', '/admin/update-status', [AdminController::class, 'updateStatus']);

// API Routes
$router->add('GET', '/api/services', [ApiServiceController::class, 'index']);
$router->add('POST', '/api/login', [ApiAuthController::class, 'login']);
$router->add('POST', '/api/booking', [ApiBookingController::class, 'process']);
$router->add('GET', '/api/my-orders', [ApiBookingController::class, 'history']);

$router->dispatch();
