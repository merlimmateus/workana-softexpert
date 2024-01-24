<?php
namespace workanaSoftexpert\domain\entities\productType;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product_types")
 */
class ProductType
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
    private $taxPercentage;

    /**
     * @ORM\ManyToOne(targetEntity="workanaSoftexpert\domain\entities\user\User")
     * @ORM\JoinColumn(name="created_by_user_id", referencedColumnName="id")
     */
    private $createdByUser;

    /**
     * @ORM\Column(type="boolean")
     */
    private $excluded = false;

    public function isExcluded(): bool
    {
        return $this->excluded;
    }

    public function setExcluded($excluded)
    {
        $this->excluded = $excluded;
    }

    public function getCreatedByUser()
    {
        return $this->createdByUser;
    }

    public function setCreatedByUser($createdByUser)
    {
        $this->createdByUser = $createdByUser;
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
     * @return float
     */
    public function getTaxPercentage()
    {
        return $this->taxPercentage;
    }

    /**
     * @param float $taxPercentage
     */
    public function setTaxPercentage($taxPercentage)
    {
        $this->taxPercentage = $taxPercentage;
    }

}