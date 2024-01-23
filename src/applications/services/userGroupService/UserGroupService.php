<?php

namespace workanaSoftexpert\applications\services\userGroupService;

use workanaSoftexpert\core\dto\userGroupCreateRequest\UserGroupCreateRequest;
use workanaSoftexpert\domain\repositories\userGroupRepository\UserGroupRepository;
use workanaSoftexpert\domain\entities\userGroup\UserGroup;

class UserGroupService
{
    private $userGroupRepository;

    public function __construct(UserGroupRepository $userGroupRepository)
    {
        $this->userGroupRepository = $userGroupRepository;
    }

    public function createUserGroup(UserGroupCreateRequest $request)
    {
        $userGroup = new UserGroup();
        $userGroup->setName($request->name);

        $this->userGroupRepository->save($userGroup);
    }

    public function getAllUsersGroups() {
        return $this->userGroupRepository->findAll();
    }

}