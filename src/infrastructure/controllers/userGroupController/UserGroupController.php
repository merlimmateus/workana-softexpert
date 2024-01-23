<?php
namespace workanaSoftexpert\infrastructure\controllers\userGroupController;

use workanaSoftexpert\applications\services\userGroupService\UserGroupService;
use workanaSoftexpert\core\dto\userGroupCreateRequest\UserGroupCreateRequest;
use workanaSoftexpert\domain\entities\userGroup\UserGroup;

class UserGroupController
{
    private $userGroupService;

    public function __construct(UserGroupService $userGroupService)
    {
        $this->userGroupService = $userGroupService;
    }

    public function createUserGroup($requestData)
    {
        $userGroupCreateRequest = new UserGroupCreateRequest($requestData);
        $this->userGroupService->createUserGroup($userGroupCreateRequest);

        return json_encode(['message' => 'User group created successfully']);
    }

    public function getAllUserGroups() {
        $users = $this->userGroupService->getAllUsersGroups();
        return json_encode(array_map(function() {
            return new UserGroup();
        }, $users));
    }

}