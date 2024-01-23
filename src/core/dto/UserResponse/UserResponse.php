<?php
namespace YourNamespace\core\dto\UserResponse;

use YourNamespace\domain\entities\user\User;

class UserResponse
{
    public $id;
    public $username;
    public $name;
    public $groupId;
    public $isActive;

    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->username = $user->getUsername();
        $this->name = $user->getName();
        $this->groupId = $user->getGroup()->getId();
        $this->isActive = $user->getIsActive();
    }
}
