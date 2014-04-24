<?php

namespace Time\TrackerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Forfait
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Forfait
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", length=255)
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="nbruseragent", type="integer")
     */
    private $nbruseragent;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param float $nbruseragent
     */
    public function setNbruseragent($nbruseragent)
    {
        $this->nbruseragent = $nbruseragent;
    }

    /**
     * @return float
     */
    public function getNbruseragent()
    {
        return $this->nbruseragent;
    }


    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }


}

