<?php
namespace workanaSoftexpert\infrastructure\controllers\userController;

use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\TransactionRequiredException;
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
        $users = $this->userService->getAllUsers();
        return json_encode(array_map(function($user) {
            return new UserResponse($user);
        }, $users));
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
     * Atualiza um usuário existente.
     *
     * @param array $requestData Dados do usuário para atualização.
     * @param int $userId ID do usuário a ser atualizado.
     * @return string JSON response.
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws TransactionRequiredException
     */
    public function updateUser($requestData, $userId): string
    {
        $this->userService->updateUser($userId, $requestData);

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