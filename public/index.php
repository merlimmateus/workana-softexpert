<?php

use YourNamespace\applications\services\jwtService\JwtService;
use YourNamespace\applications\services\userService\UserService;
use YourNamespace\applications\services\userGroupService\UserGroupService;
use YourNamespace\domain\repositories\userRepository\UserRepository;
use YourNamespace\domain\repositories\userGroupRepository\UserGroupRepository;
use YourNamespace\infrastructure\controllers\userController\UserController;
use YourNamespace\infrastructure\controllers\userGroupController\UserGroupController;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';

$userRepository = new UserRepository($entityManager);
$userGroupRepository = new UserGroupRepository($entityManager);
$userService = new UserService($userRepository, $userGroupRepository);
$jwtService = new JwtService('teste');
$userController = new UserController($userService, $jwtService);


// User Group
$userGroupRepository = new UserGroupRepository($entityManager);
$userGroupService = new UserGroupService($userGroupRepository);
$userGroupController = new UserGroupController($userGroupService);

// Handle CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Content-Type: application/json');

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$requestData = json_decode(file_get_contents('php://input'), true);

function getBearerToken() {
    $headers = apache_request_headers();
    if (isset($headers['Authorization'])) {
        $matches = [];
        if (preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
            return $matches[1];
        }
    }
    return null;
}

function isAuthorized($jwtService): bool
{
    $token = getBearerToken();
    return $jwtService->validateToken($token) !== null;
}

switch ($requestMethod) {
    case 'GET':
        if ($requestUri === '/users' && isAuthorized($jwtService)) {
            echo $userController->getAllUsers();
        } else {
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(['message' => 'Unauthorized']);
        }
        break;
    case 'POST':
        if ($requestUri === '/users') {
            echo $userController->createUser($requestData);
        } elseif ($requestUri === '/login') {
            $username = $requestData['username'];
            $password = $requestData['password'];
            $token = $userController->login($username, $password);
            if ($token) {
                echo json_encode(['token' => $token]);
            } else {
                header('HTTP/1.1 401 Unauthorized');
                echo json_encode(['message' => 'Login failed']);
            }
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['message' => 'Not Found']);
        }
        break;
    default:
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['message' => 'Not Found']);
        break;
}
