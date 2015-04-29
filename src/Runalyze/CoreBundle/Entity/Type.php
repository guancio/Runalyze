<?php

namespace Runalyze\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Type
 *
 * @ORM\Table(name="type", indexes={@ORM\Index(name="accountid", columns={"accountid"})})
 * @ORM\Entity
 */
class Type
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="abbr", type="string", length=5, nullable=false)
     */
    private $abbr;

    /**
     * @var integer
     *
     * @ORM\Column(name="RPE", type="smallint", nullable=false)
     */
    private $rpe = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="sportid", type="integer", nullable=false)
     */
    private $sportid = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="accountid", type="integer", nullable=false)
     */
    private $accountid;



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
     * Set name
     *
     * @param string $name
     * @return Type
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
     * Set abbr
     *
     * @param string $abbr
     * @return Type
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;

        return $this;
    }

    /**
     * Get abbr
     *
     * @return string 
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * Set rpe
     *
     * @param integer $rpe
     * @return Type
     */
    public function setRpe($rpe)
    {
        $this->rpe = $rpe;

        return $this;
    }

    /**
     * Get rpe
     *
     * @return integer 
     */
    public function getRpe()
    {
        return $this->rpe;
    }

    /**
     * Set sportid
     *
     * @param integer $sportid
     * @return Type
     */
    public function setSportid($sportid)
    {
        $this->sportid = $sportid;

        return $this;
    }

    /**
     * Get sportid
     *
     * @return integer 
     */
    public function getSportid()
    {
        return $this->sportid;
    }

    /**
     * Set accountid
     *
     * @param integer $accountid
     * @return Type
     */
    public function setAccountid($accountid)
    {
        $this->accountid = $accountid;

        return $this;
    }

    /**
     * Get accountid
     *
     * @return integer 
     */
    public function getAccountid()
    {
        return $this->accountid;
    }
    
    public function __construct()
    {
        $this->sport = new ArrayCollection();
    }
    
      /**
     * @ORM\OneToMany(targetEntity="Sport", mappedBy="type")
     */
    protected $sport;
    
}
