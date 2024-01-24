<?php
namespace workanaSoftexpert\domain\repositories\userGroupRepository;

use workanaSoftexpert\domain\entities\userGroup\UserGroup;

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

    public function findAll() {
        return $this->entityManager->getRepository(UserGroup::class)->findAll();
    }

}
