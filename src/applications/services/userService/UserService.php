<?php
namespace YourNamespace\applications\services\userService;

use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\TransactionRequiredException;
use YourNamespace\core\dto\UserCreateRequest\UserCreateRequest;
use YourNamespace\domain\entities\user\User;
use YourNamespace\domain\repositories\userGroupRepository\UserGroupRepository;
use YourNamespace\domain\repositories\userRepository\UserRepository;

class UserService
{
    private $userRepository;
    private $userGroupRepository;

    public function __construct(UserRepository $userRepository, UserGroupRepository $userGroupRepository)
    {
        $this->userRepository = $userRepository;
        $this->userGroupRepository = $userGroupRepository;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function createUser(UserCreateRequest $userCreateRequest)
    {
        $userGroup = $this->userGroupRepository->find($userCreateRequest->getGroupId());

        if (!$userGroup) {
            throw new \RuntimeException("UserGroup with id {$userCreateRequest->getGroupId()} not found.");
        }

        $user = new User();
        $user->setUsername($userCreateRequest->getUsername());
        $user->setPassword($userCreateRequest->getPassword());
        $user->setName($userCreateRequest->getName());
        $user->setGroup($userGroup);

        $this->userRepository->save($user);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws TransactionRequiredException
     */
    public function updateUser($userId, $userData)
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            throw new \RuntimeException("User not found.");
        }

        $userGroup = $this->userGroupRepository->find($userData['groupId']);
        if (!$userGroup) {
            throw new \RuntimeException("UserGroup with id {$userData['groupId']} not found.");
        }

        $user->setUsername($userData['username']);
        $user->setPassword($userData['password']);
        $user->setName($userData['name']);
        $user->setGroup($userGroup);
        $user->setIsActive($userData['isActive'] ?? true);

        $this->userRepository->save($user);
    }
    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws TransactionRequiredException
     */
    public function deleteUser($userId)
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            throw new \RuntimeException("User not found.");
        }

        // Em vez de excluir, defina o usuário como inativo
        $user->setIsActive(false);
        $this->userRepository->save($user);
    }

    /**
     * @throws NotSupported
     */
    public function getUserByUsername($username)
    {
        return $this->userRepository->findByUsername($username);
    }

    /**
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws ORMException
     */
    public function getUserById($userId)
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            throw new \RuntimeException("User not found.");
        }

        return $user;
    }

}
