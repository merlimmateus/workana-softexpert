<?php
namespace YourNamespace\domain\repositories\userGroupRepository;

use YourNamespace\domain\entities\userGroup\UserGroup;

class UserGroupRepository
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function find($id)
    {
        return $this->entityManager->find(UserGroup::class, $id);
    }

    public function save(UserGroup $userGroup)
    {
        $this->entityManager->persist($userGroup);
        $this->entityManager->flush();
    }

}
