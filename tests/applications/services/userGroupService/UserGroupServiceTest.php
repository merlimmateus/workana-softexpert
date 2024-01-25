<?php

namespace applications\services\userGroupService;

use PHPUnit\Framework\TestCase;
use workanaSoftexpert\applications\services\userGroupService\UserGroupService;
use workanaSoftexpert\core\dto\userGroupCreateRequest\UserGroupCreateRequest;
use workanaSoftexpert\domain\entities\userGroup\UserGroup;
use workanaSoftexpert\domain\repositories\userGroupRepository\UserGroupRepository;

class UserGroupServiceTest extends TestCase
{
    private $userGroupService;
    private $userGroupRepository;

    protected function setUp(): void
    {
        $this->userGroupRepository = $this->createMock(UserGroupRepository::class);
        $this->userGroupService = new UserGroupService($this->userGroupRepository);
    }

    public function testCreateUserGroup()
    {
        $requestData = ['name' => 'adm'];
        $request = new UserGroupCreateRequest($requestData);

        $this->userGroupRepository->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($userGroup) {
                return $userGroup instanceof UserGroup && $userGroup->getName() === 'adm';
            }));

        $this->userGroupService->createUserGroup($request);
    }

    public function testGetAllUsersGroups()
    {
        $userGroups = [
            $this->createMock(UserGroup::class),
            $this->createMock(UserGroup::class)
        ];
        $this->userGroupRepository->method('findAll')->willReturn($userGroups);

        $retrievedUserGroups = $this->userGroupService->getAllUsersGroups();
        $this->assertSame($userGroups, $retrievedUserGroups);
    }
}