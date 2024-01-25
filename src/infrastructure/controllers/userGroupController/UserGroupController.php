<?php
namespace workanaSoftexpert\infrastructure\controllers\userGroupController;

use workanaSoftexpert\applications\services\userGroupService\UserGroupService;
use workanaSoftexpert\core\dto\userGroupCreateRequest\UserGroupCreateRequest;
use workanaSoftexpert\core\dto\userGroupResponse\UserGroupResponse;

class UserGroupController
{
    private $userGroupService;

    public function __construct(UserGroupService $userGroupService)
    {
        $this->userGroupService = $userGroupService;
    }

    public function createUserGroup($requestData)
    {
        try {
            $userGroupCreateRequest = new UserGroupCreateRequest($requestData);
            $this->userGroupService->createUserGroup($userGroupCreateRequest);

            return json_encode(['message' => 'User group created successfully']);
        } catch (\Exception $e) {
            http_response_code(400); // Bad Request
            return json_encode(['error' => 'Error creating user group', 'details' => $e->getMessage()]);
        }
    }

    public function getAllUserGroups() {
        try {
            $userGroups = $this->userGroupService->getAllUsersGroups();
            return json_encode(array_map(function($userGroup) {
                return new UserGroupResponse($userGroup);
            }, $userGroups));
        } catch (\Exception $e) {
            http_response_code(500); // Internal Server Error
            return json_encode(['error' => 'Error fetching user groups', 'details' => $e->getMessage()]);
        }
    }
}
