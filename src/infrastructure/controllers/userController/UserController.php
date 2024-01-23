<?php
namespace YourNamespace\infrastructure\controllers\userController;

use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\TransactionRequiredException;
use YourNamespace\applications\services\jwtService\JwtService;
use YourNamespace\applications\services\userService\UserService;
use YourNamespace\core\dto\UserCreateRequest\UserCreateRequest;
use YourNamespace\core\dto\UserResponse\UserResponse;

class UserController
{
    private $userService;
    private $jwtService;

    public function __construct(UserService $userService, JwtService $jwtService)
    {
        $this->userService = $userService;
        $this->jwtService = $jwtService;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function createUser($requestData)
    {
        $userCreateRequest = new UserCreateRequest($requestData);
        $this->userService->createUser($userCreateRequest);

        $user = $this->userService->getUserByUsername($userCreateRequest->username);

        $userResponse = new UserResponse($user);

        return json_encode($userResponse);
    }

    /**
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws ORMException
     */
    public function updateUser($request, $userId)
    {
        $userData = $request->getParsedBody();
        $this->userService->updateUser($userId, $userData);

        $updatedUser = $this->userService->getUserById($userId);
        $userResponse = new UserResponse($updatedUser);

        return json_encode($userResponse);
    }

    /**
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws ORMException
     */
    public function deleteUser($userId)
    {
        $this->userService->deleteUser($userId);

        return json_encode(['message' => 'User successfully deactivated']);
    }

    /**
     * @throws NotSupported
     */
    public function login($username, $password)
    {
        $user = $this->userService->getUserByUsername($username);
        if (!$user || !$this->verifyPassword($password, $user->getPassword())) {
            return null;
        }

        $payload = ['userId' => $user->getId(), 'username' => $user->getUsername()];
        return $this->jwtService->createToken($payload);
    }

    private function verifyPassword($inputPassword, $storedPassword): bool
    {
        return password_verify($inputPassword, $storedPassword);
    }

}