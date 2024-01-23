<?php
namespace YourNamespace\infrastructure\controllers\userGroupController;

use YourNamespace\applications\services\userGroupService\UserGroupService;
use YourNamespace\core\dto\UserGroupCreateRequest\UserGroupCreateRequest;

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

}