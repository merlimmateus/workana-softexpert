<?php
namespace workanaSoftexpert\core\dto\userGroupCreateRequest;

class UserGroupCreateRequest
{
    public $name;

    public function __construct($data)
    {
        $this->name = $data['name'];
    }
}