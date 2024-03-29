<?php
namespace workanaSoftexpert\domain\entities\product;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="workanaSoftexpert\domain\entities\productType\ProductType")
     * @ORM\JoinColumn(name="product_type_id", referencedColumnName="id")
     */
    private $productType;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $excluded = false;

    public function isExcluded(): bool
    {
        return $this->excluded;
    }

    public function setExcluded(bool $excluded)
    {
        $this->excluded = $excluded;
    }



    /**
     * @ORM\ManyToOne(targetEntity="workanaSoftexpert\domain\entities\user\User")
     * @ORM\JoinColumn(name="created_by_user_id", referencedColumnName="id")
     */
    private $createdByUserId;

    public function getCreatedByUser()
    {
        return $this->createdByUserId;
    }

    public function setCreatedByUser($createdByUser)
    {
        $this->createdByUserId = $createdByUser;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * @param mixed $productType
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Calcula o valor do imposto com base no preço e no percentual de imposto do tipo de produto.
     * @return float
     */
    public function calculateTax(): float
    {
        if ($this->productType) {
            return $this->price * ($this->productType->getTaxPercentage() / 100);
        }
        return 0.0;
    }

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

}
