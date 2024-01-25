<?php
namespace workanaSoftexpert\infrastructure\controllers\userController;

use workanaSoftexpert\applications\services\jwtService\JwtService;
use workanaSoftexpert\applications\services\userService\UserService;
use workanaSoftexpert\core\dto\userCreateRequest\UserCreateRequest;
use workanaSoftexpert\core\dto\userResponse\UserResponse;

class UserController
{
    private $userService;
    private $jwtService;

    public function __construct(UserService $userService, JwtService $jwtService)
    {
        $this->userService = $userService;
        $this->jwtService = $jwtService;
    }

    public function getAllUsers() {
        try {
            $users = $this->userService->getAllUsers();
            return json_encode(array_map(function($user) {
                return new UserResponse($user);
            }, $users));
        } catch (\Exception $e) {
            http_response_code(500); // Internal Server Error
            return json_encode(['error' => 'Error fetching users', 'details' => $e->getMessage()]);
        }
    }

    public function createUser($requestData)
    {
        try {
            $userCreateRequest = new UserCreateRequest($requestData);
            $this->userService->createUser($userCreateRequest);

            $user = $this->userService->getUserByUsername($userCreateRequest->username);
            $userResponse = new UserResponse($user);

            return json_encode($userResponse);
        } catch (\Exception $e) {
            http_response_code(400); // Bad Request
            return json_encode(['error' => 'Error creating user', 'details' => $e->getMessage()]);
        }
    }

    public function updateUser($requestData, $userId): string
    {
        try {
            $this->userService->updateUser($userId, $requestData);

            $updatedUser = $this->userService->getUserById($userId);
            $userResponse = new UserResponse($updatedUser);

            return json_encode($userResponse);
        } catch (\Exception $e) {
            http_response_code(400); // Bad Request
            return json_encode(['error' => 'Error updating user', 'details' => $e->getMessage()]);
        }
    }

    public function deleteUser($userId)
    {
        try {
            $this->userService->deleteUser($userId);
            return json_encode(['message' => 'User successfully deactivated']);
        } catch (\Exception $e) {
            http_response_code(400); // Bad Request
            return json_encode(['error' => 'Error deactivating user', 'details' => $e->getMessage()]);
        }
    }

    public function login($username, $password) {
        try {
            $user = $this->userService->getUserByUsername($username);
            if (!$user || !$this->verifyPassword($password, $user->getPassword())) {
                throw new \Exception('Invalid credentials');
            }

            $payload = ['userId' => $user->getId(), 'username' => $user->getUsername()];
            $token = $this->jwtService->createToken($payload);

            $userResponse = new UserResponse($user);

            return [
                'token' => $token,
                'user' => $userResponse
            ];
        } catch (\Exception $e) {
            http_response_code(401); // Unauthorized
            return json_encode(['error' => 'Login failed', 'details' => $e->getMessage()]);
        }
    }

    private function verifyPassword($inputPassword, $storedPassword): bool
    {
        return password_verify($inputPassword, $storedPassword);
    }
}
