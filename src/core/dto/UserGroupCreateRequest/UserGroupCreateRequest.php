<?php
namespace YourNamespace\core\dto\UserGroupCreateRequest;

class UserGroupCreateRequest
{
    public $name;

    public function __construct($data)
    {
        $this->name = $data['name'];
    }
}