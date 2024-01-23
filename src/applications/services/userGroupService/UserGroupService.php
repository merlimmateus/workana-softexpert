<?php

namespace YourNamespace\applications\services\userGroupService;

use YourNamespace\core\dto\UserGroupCreateRequest\UserGroupCreateRequest;
use YourNamespace\domain\repositories\userGroupRepository\UserGroupRepository;
use YourNamespace\domain\entities\userGroup\UserGroup;

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

}