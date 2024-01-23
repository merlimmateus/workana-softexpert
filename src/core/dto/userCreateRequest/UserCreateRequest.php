<?php
namespace workanaSoftexpert\core\dto\userCreateRequest;

class UserCreateRequest
{
    public $username;
    public $password;
    public $name;
    public $groupId;
    public $isActive;

    public function __construct($data)
    {
        $this->username = $data['username'] ?? null;
        $this->password = $data['password'] ? password_hash($data['password'], PASSWORD_DEFAULT) : null;
        $this->name = $data['name'] ?? null;
        $this->groupId = $data['groupId'] ?? null;
        $this->isActive = $data['isActive'] ?? true;
    }

    /**
     * @return mixed|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed|null $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return false|string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param false|string|null $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed|null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed|null
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param mixed|null $groupId
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

    /**
     * @return mixed|true
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed|true $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }


}
