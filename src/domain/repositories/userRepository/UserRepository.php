<?php
namespace YourNamespace\domain\repositories\userRepository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\TransactionRequiredException;
use YourNamespace\domain\entities\user\User;

class UserRepository
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws ORMException
     */
    public function find($id)
    {
        return $this->entityManager->find(User::class, $id);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(User $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function delete(User $user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    /**
     * @throws NotSupported
     */
    public function findByUsername($username)
    {
        return $this->entityManager->getRepository(User::class)->findOneBy(['username' => $username]);
    }
}