<?php

namespace Time\TrackerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegexBrowsers
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RegexBrowsers
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
     * @ORM\Column(name="regexbrowsers", type="string", length=255)
     */
    private $regexbrowsers;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=true)
     */
    private $version;


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
     * Set regexbrowsers
     *
     * @param string $regexbrowsers
     * @return RegexBrowsers
     */
    public function setRegexbrowsers($regexbrowsers)
    {
        $this->regexbrowsers = $regexbrowsers;

        return $this;
    }

    /**
     * Get regexbrowsers
     *
     * @return string
     */
    public function getRegexbrowsers()
    {
        return $this->regexbrowsers;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return RegexBrowsers
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return RegexBrowsers
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }
}