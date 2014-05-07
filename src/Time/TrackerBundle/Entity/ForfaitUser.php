<?php

namespace Time\TrackerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ForfaitUser
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ForfaitUser
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
     * @var integer
     * @ORM\ManyToOne(targetEntity="Time\TrackerBundle\Entity\User")
     * @@ORM\JoinColumn
     */
    private $iduser;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_request", type="integer")
     */
    private $nbrRequest;


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
     * @param int $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    /**
     * @return int
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set nbrRequest
     *
     * @param integer $nbrRequest
     * @return ForfaitUser
     */
    public function setNbrRequest($nbrRequest)
    {
        $this->nbrRequest = $nbrRequest;

        return $this;
    }

    /**
     * Get nbrRequest
     *
     * @return integer
     */
    public function getNbrRequest()
    {
        return $this->nbrRequest;
    }
}
