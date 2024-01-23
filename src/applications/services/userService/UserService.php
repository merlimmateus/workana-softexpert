<?php
namespace workanaSoftexpert\applications\services\userService;

use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\TransactionRequiredException;
use workanaSoftexpert\core\dto\userCreateRequest\UserCreateRequest;
use workanaSoftexpert\domain\entities\user\User;
use workanaSoftexpert\domain\repositories\userGroupRepository\UserGroupRepository;
use workanaSoftexpert\domain\repositories\userRepository\UserRepository;

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

        // Atualização dos dados do usuário
        $user->setUsername($userData['username'] ?? $user->getUsername());
        if (!empty($userData['password'])) {
            $user->setPassword(password_hash($userData['password'], PASSWORD_DEFAULT));
        }
        $user->setName($userData['name'] ?? $user->getName());
        if (isset($userData['isActive'])) {
            $user->setIsActive($userData['isActive']);
        }

        // Atualizar grupo do usuário se necessário
        if (isset($userData['groupId'])) {
            $userGroup = $this->userGroupRepository->find($userData['groupId']);
            if (!$userGroup) {
                throw new \RuntimeException("UserGroup with id {$userData['groupId']} not found.");
            }
            $user->setGroup($userGroup);
        }

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

    public function getAllUsers() {
        return $this->userRepository->findAll();
    }

}
