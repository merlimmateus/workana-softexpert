<?php

namespace applications\services\userService;

use PHPUnit\Framework\TestCase;
use workanaSoftexpert\applications\services\userService\UserService;
use workanaSoftexpert\core\dto\userCreateRequest\UserCreateRequest;
use workanaSoftexpert\domain\entities\user\User;
use workanaSoftexpert\domain\entities\userGroup\UserGroup;
use workanaSoftexpert\domain\repositories\userGroupRepository\UserGroupRepository;
use workanaSoftexpert\domain\repositories\userRepository\UserRepository;

class UserServiceTest extends TestCase
{
    private $userService;
    private $userRepository;
    private $userGroupRepository;

    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->userGroupRepository = $this->createMock(UserGroupRepository::class);
        $this->userService = new UserService($this->userRepository, $this->userGroupRepository);
    }

    public function testCreateUser()
    {
        $userGroup = $this->createMock(UserGroup::class);
        $this->userGroupRepository->method('find')->willReturn($userGroup);

        $requestData = [
            'username' => 'unitTest',
            'password' => '123',
            'name' => 'unitTest',
            'groupId' => 1
        ];
        $request = new UserCreateRequest($requestData);

        $this->userRepository->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($user) {
                return $user instanceof User && $user->getUsername() === 'unitTest';
            }));

        $this->userService->createUser($request);
    }

    public function testDeleteUser()
    {
        $user = $this->createMock(User::class);
        $this->userRepository->method('find')->willReturn($user);
        $user->expects($this->once())->method('setIsActive')->with($this->equalTo(false));

        $this->userService->deleteUser(1);
    }

    public function testGetUserByUsername()
    {
        $user = $this->createMock(User::class);
        $this->userRepository->method('findByUsername')->willReturn($user);

        $retrievedUser = $this->userService->getUserByUsername('johndoe');
        $this->assertSame($user, $retrievedUser);
    }

    public function testGetUserById()
    {
        $user = $this->createMock(User::class);
        $this->userRepository->method('find')->willReturn($user);

        $retrievedUser = $this->userService->getUserById(1);
        $this->assertSame($user, $retrievedUser);
    }

    public function testGetAllUsers()
    {
        $users = [
            $this->createMock(User::class),
            $this->createMock(User::class)
        ];
        $this->userRepository->method('findAll')->willReturn($users);

        $retrievedUsers = $this->userService->getAllUsers();
        $this->assertSame($users, $retrievedUsers);
    }
}