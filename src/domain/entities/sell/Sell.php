<?php

namespace workanaSoftexpert\domain\entities\sell;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="sells")
 */
class Sell
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="workanaSoftexpert\domain\entities\product\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="workanaSoftexpert\domain\entities\user\User")
     * @ORM\JoinColumn(name="created_by_user_id", referencedColumnName="id")
     */
    private $createdByUser;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $excluded = false;

    public function isExcluded()
    {
        return $this->excluded;
    }

    public function setExcluded($excluded)
    {
        $this->excluded = $excluded;
    }

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getCreatedByUser()
    {
        return $this->createdByUser;
    }

    public function setCreatedByUser($createdByUser)
    {
        $this->createdByUser = $createdByUser;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

}
