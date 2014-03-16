<?php

namespace Time\TrackerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Photo
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
     * @ORM\Column(name="photo_base64", type="text")
     */
    private $photoBase64;

    /**
     * @var integer
     *
     * @ORM\Column(name="tracker_id", type="integer")
     */
    private $trackerId;


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
     * Set photoBase64
     *
     * @param string $photoBase64
     * @return Photo
     */
    public function setPhotoBase64($photoBase64)
    {
        $this->photoBase64 = $photoBase64;
    
        return $this;
    }

    /**
     * Get photoBase64
     *
     * @return string 
     */
    public function getPhotoBase64()
    {
        return $this->photoBase64;
    }

    /**
     * Set trackerId
     *
     * @param integer $trackerId
     * @return Photo
     */
    public function setTrackerId($trackerId)
    {
        $this->trackerId = $trackerId;
    
        return $this;
    }

    /**
     * Get trackerId
     *
     * @return integer 
     */
    public function getTrackerId()
    {
        return $this->trackerId;
    }
}