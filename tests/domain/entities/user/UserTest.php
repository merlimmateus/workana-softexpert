<?php
namespace domain\entities\user;

use PHPUnit\Framework\TestCase;
use workanaSoftexpert\domain\entities\user\User;
use workanaSoftexpert\domain\entities\userGroup\UserGroup;

class UserTest extends TestCase
{
    private $user;
    private $userGroup;

    protected function setUp(): void
    {
        $this->user = new User();
        $this->userGroup = $this->createMock(UserGroup::class);
    }

    public function testCreateUser()
    {
        $this->user->setUsername("test");
        $this->user->setPassword("password123");
        $this->user->setName("test");
        $this->user->setGroup($this->userGroup);
        $this->user->setIsActive(true);

        $this->assertEquals("test", $this->user->getUsername());
        $this->assertEquals("password123", $this->user->getPassword());
        $this->assertEquals("test", $this->user->getName());
        $this->assertSame($this->userGroup, $this->user->getGroup());
        $this->assertTrue($this->user->getIsActive());
    }

    public function testSetAndGetUsername()
    {
        $this->user->setUsername("test");
        $this->assertEquals("test", $this->user->getUsername());
    }

    public function testSetAndGetPassword()
    {
        $this->user->setPassword("test2301!");
        $this->assertEquals("test2301!", $this->user->getPassword());
    }

    public function testSetAndGetName()
    {
        $this->user->setName("Matthews");
        $this->assertEquals("Matthews", $this->user->getName());
    }

    public function testSetAndGetGroup()
    {
        $this->user->setGroup($this->userGroup);
        $this->assertSame($this->userGroup, $this->user->getGroup());
    }

    public function testSetAndGetIsActive()
    {
        $this->user->setIsActive(false);
        $this->assertFalse($this->user->getIsActive());
    }
}