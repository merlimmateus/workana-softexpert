<?php

use workanaSoftexpert\applications\services\jwtService\JwtService;
use workanaSoftexpert\applications\services\userService\UserService;
use workanaSoftexpert\applications\services\userGroupService\UserGroupService;
use workanaSoftexpert\domain\repositories\userRepository\UserRepository;
use workanaSoftexpert\domain\repositories\userGroupRepository\UserGroupRepository;
use workanaSoftexpert\infrastructure\controllers\userController\UserController;
use workanaSoftexpert\infrastructure\controllers\userGroupController\UserGroupController;
use workanaSoftexpert\applications\services\productService\ProductService;
use workanaSoftexpert\applications\services\productTypeService\ProductTypeService;
use workanaSoftexpert\domain\repositories\productRepository\ProductRepository;
use workanaSoftexpert\domain\repositories\productTypeRepository\ProductTypeRepository;
use workanaSoftexpert\infrastructure\controllers\productController\ProductController;
use workanaSoftexpert\infrastructure\controllers\productTypeController\ProductTypeController;
use workanaSoftexpert\domain\repositories\sellRepository\SellRepository;
use workanaSoftexpert\applications\services\sellService\SellService;
use workanaSoftexpert\infrastructure\controllers\sellController\SellController;


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';


if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

$userRepository = new UserRepository($entityManager);
$userGroupRepository = new UserGroupRepository($entityManager);
$userService = new UserService($userRepository, $userGroupRepository);
$jwtService = new JwtService('teste');
$userController = new UserController($userService, $jwtService);


// User Group
$userGroupRepository = new UserGroupRepository($entityManager);
$userGroupService = new UserGroupService($userGroupRepository);
$userGroupController = new UserGroupController($userGroupService);

$productRepository = new ProductRepository($entityManager);
$productTypeRepository = new ProductTypeRepository($entityManager);
$productService = new ProductService($productRepository, $productTypeRepository, $userRepository);
$productController = new ProductController($productService);
$productTypeService = new ProductTypeService($productTypeRepository, $userRepository);
$productTypeController = new ProductTypeController($productTypeService);
$sellRepository = new SellRepository($entityManager);
$sellService = new SellService($sellRepository, $productRepository, $userRepository);
$sellController = new SellController($sellService);

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
    case 'OPTIONS':
        header('HTTP/1.1 200 OK');
        break;
    case 'GET':
        if ($requestUri === '/users' && isAuthorized($jwtService)) {
            echo $userController->getAllUsers();
        } elseif ($requestUri === '/products' && isAuthorized($jwtService)) {
            echo $productController->getAllProducts();
        } elseif ($requestUri === '/product-types' && isAuthorized($jwtService)) {
            echo $productTypeController->getAllProductTypes();
        } elseif ($requestUri === '/user-groups' && isAuthorized($jwtService)) {
            echo $userGroupController->getAllUserGroups();
        } elseif ($requestUri === '/sells' && isAuthorized($jwtService)) {
            echo $sellController->getAllSells();
        } else {
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(['message' => 'Unauthorized']);
        }
        break;
    case 'POST':
        if ($requestUri === '/users') {
            echo $userController->createUser($requestData);
        } elseif ($requestUri === '/user-groups') {
            echo $userGroupController->createUserGroup($requestData);
        } elseif ($requestUri === '/login') {
            $username = $requestData['username'];
            $password = $requestData['password'];
            $loginResult = $userController->login($username, $password);
            if ($loginResult) {
                echo json_encode($loginResult);
            } else {
                header('HTTP/1.1 401 Unauthorized');
                echo json_encode(['message' => 'Login failed']);
            }
        } elseif ($requestUri === '/products' && isAuthorized($jwtService)) {
            echo $productController->createProduct($requestData);
        } elseif ($requestUri === '/product-types' && isAuthorized($jwtService)) {
            echo $productTypeController->createProductType($requestData);
        } elseif($requestUri === '/sells' && isAuthorized($jwtService)) {
            echo $sellController->createSell($requestData);
        }
        break;
    case 'PUT':
        if ($requestUri === '/users' && isAuthorized($jwtService)) {
            $userId = $requestData['userId'] ?? null;
            if ($userId) {
                echo $userController->updateUser($requestData, $userId);
            } else {
                header('HTTP/1.1 400 Bad Request');
                echo json_encode(['message' => 'Missing user ID']);
            }
        } elseif ($requestUri === '/products' && isAuthorized($jwtService)) {
            $productId = $requestData['productId'] ?? null;
            if ($productId) {
                echo $productController->updateProduct($requestData, $productId);
            } else {
                header('HTTP/1.1 400 Bad Request');
                echo json_encode(['message' => 'Missing product ID']);
            }
        } elseif ($requestUri === '/product-types' && isAuthorized($jwtService)) {
            $productTypeId = $requestData['productTypeId'] ?? null;
            if ($productTypeId) {
                echo $productTypeController->updateProductType($requestData, $productTypeId);
            } else {
                header('HTTP/1.1 400 Bad Request');
                echo json_encode(['message' => 'Missing product type ID']);
            }
        } elseif ($requestUri === '/sells' && isAuthorized($jwtService)) {
            $sellId = $requestData['sellId'] ?? null;
            if ($sellId) {
                echo $sellController->updateSell($requestData, $sellId);
            } else {
                header('HTTP/1.1 400 Bad Request');
                echo json_encode(['message' => 'Missing sell ID']);
            }
        }
        break;
    case 'DELETE':
        if (preg_match("/\/product-types\/(\d+)/", $requestUri, $matches) && isAuthorized($jwtService)) {
            $productTypeId = $matches[1];
            echo $productTypeController->deleteProductType($productTypeId);
        } elseif (preg_match("/\/products\/(\d+)/", $requestUri, $matches) && isAuthorized($jwtService)) {
            $productId = $matches[1];
            echo $productController->deleteProduct($productId);
        } elseif (preg_match("/\/sells\/(\d+)/", $requestUri, $matches) && isAuthorized($jwtService)) {
            $sellId = $matches[1];
            echo $sellController->deleteSell($sellId);
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
