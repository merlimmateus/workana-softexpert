<?php
namespace workanaSoftexpert\core\dto\userGroupResponse;

use workanaSoftexpert\domain\entities\userGroup\UserGroup;

class UserGroupResponse {
    public $id;
    public $name;

    public function __construct(UserGroup $userGroup) {
        $this->id = $userGroup->getId();
        $this->name = $userGroup->getName();
    }
}