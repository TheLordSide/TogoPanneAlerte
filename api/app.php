<?php
use API\controllers\UsersController;
use API\controllers\ServicesController;
use API\controllers\AuthController;
use API\controllers\SignalerController;
use API\models\Users;
require_once('./vendor/autoload.php');
require_once('./helpers/responseHelper.php');

$router = new AltoRouter();

//UserController Routes

$router->map('GET', '/TogoPanneAlerte/api/users', function() {
    require __DIR__ . '/controllers/UsersController.php';
    $usersController = new UsersController(); // Instancier UsersController
    $usersController->getAllUsers(); // Appeler la méthode getAllUsers()
});

$router->map('POST', '/TogoPanneAlerte/api/users/create', function() {
    require __DIR__ . '/controllers/UsersController.php';
    $usersController = new UsersController(); // Instancier UsersController
    $usersController->createUser(); // Appeler la méthode createUser()
});

$router->map('GET', '/TogoPanneAlerte/api/users/[i:id]', function($id) {
    require __DIR__ . '/controllers/UsersController.php';
    $usersController = new UsersController(); // Instancier UsersController
    $usersController->getUserById($id); // Appeler la méthode getUserById() en passant l'ID de l'utilisateur
});



//ServiceController Routes

$router->map('GET', '/TogoPanneAlerte/api/services', function() {
    require __DIR__ . '/controllers/ServiceController.php';
    $servicesController = new ServicesController(); // Instancier ServicesController
    $servicesController->getAllServices(); // Appeler la méthode getAllServices()
});


$router->map('POST', '/TogoPanneAlerte/api/services/create', function() {
    require __DIR__ . '/controllers/ServiceController.php';
    $servicesController = new ServicesController(); // Instancier ServicesController
    $servicesController->createService(); // Appeler la méthode createService()
});

$router->map('GET', '/TogoPanneAlerte/api/services/[i:id]', function($id) {
    require __DIR__ . '/controllers/ServiceController.php';
    $usersController = new ServicesController(); // Instancier UsersController
    $usersController->getServiceById($id); // Appeler la méthode getUserById() en passant l'ID de l'utilisateur
});


//SiggnalerController Routes

$router->map('POST', '/TogoPanneAlerte/api/signaler/create', function() {
    require __DIR__ . '/controllers/SignalerController.php';
    $signalerController = new SignalerController(); // Instancier SignalerController
    $signalerController->createSignaler(); // Appeler la méthode createSignaler()
});


//AuthController Routes

/*
!This controller should not exist, i will come with another one
TODO : MAKE A BETTER ONE
$router->map('POST', '/TogoPanneAlerte/api/auth/login', function() {
    require __DIR__ . '/controllers/AuthController.php';
    $authcontroller = new AuthController(); // Instancier AuthController
    $authcontroller-> loginUser();// Appeler la méthode loginUser()
});

$router->map('POST', '/TogoPanneAlerte/api/auth/logout', function() {
    require __DIR__ . '/controllers/AuthController.php';
    $authcontroller = new AuthController(); // Instancier AuthController
    $authcontroller-> logoutUser();// Appeler la méthode logoutUser()
});
*/

$match = $router->match();

// Gérer la correspondance de la route
if ($match && is_callable($match['target'])) {
    // Si la route correspond et que la cible est une fonction appelable
    call_user_func_array($match['target'], $match['params']); // Passer les paramètres de la route
} else {
    header($_SERVER["SERVER_PROTOCOL"] . '405 Method Not Allowed');
    sendJsonResponse(['success' => false, 'erreur' => '405 Method Not Allowed'], 500);
}

