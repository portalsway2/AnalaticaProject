<?php

namespace Time\TrackerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Device
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Device
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
     * @var
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @var
     * @ORM\Column(name="version", type="string", length=255)
     */
    private $version;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Time\TrackerBundle\Entity\UserAgent")
     * @@ORM\JoinColumn
     */
    private $idUserAgent;

    /**
     * @param int $idUserAgent
     */
    public function setIdUserAgent($idUserAgent)
    {
        $this->idUserAgent = $idUserAgent;
    }

    /**
     * @return int
     */
    public function getIdUserAgent()
    {
        return $this->idUserAgent;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
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
}
