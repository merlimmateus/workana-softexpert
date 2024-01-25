<?php
namespace domain\entities\userGroup;

use PHPUnit\Framework\TestCase;
use workanaSoftexpert\domain\entities\userGroup\UserGroup;

class UserGroupTest extends TestCase
{
    private $userGroup;

    protected function setUp(): void
    {
        $this->userGroup = new UserGroup();
    }

    public function testCreateUserGroup()
    {
        $this->userGroup->setName("adm");

        $this->assertEquals("adm", $this->userGroup->getName());
    }

    public function testSetAndGetName()
    {
        $this->userGroup->setName("adm");
        $this->assertEquals("adm", $this->userGroup->getName());
    }
}