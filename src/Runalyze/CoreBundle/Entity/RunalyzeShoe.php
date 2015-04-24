<?php

namespace Runalyze\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RunalyzeShoe
 *
 * @ORM\Table(name="runalyze_shoe", indexes={@ORM\Index(name="accountid", columns={"accountid"})})
 * @ORM\Entity
 */
class RunalyzeShoe
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
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="since", type="string", length=10, nullable=false)
     */
    private $since = '01.01.2000';

    /**
     * @var integer
     *
     * @ORM\Column(name="weight", type="smallint", nullable=false)
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="km", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $km = '0.00';

    /**
     * @var integer
     *
     * @ORM\Column(name="time", type="integer", nullable=false)
     */
    private $time = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="inuse", type="boolean", nullable=false)
     */
    private $inuse = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="additionalKm", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $additionalkm = '0.00';

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
     * @return RunalyzeShoe
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
     * Set since
     *
     * @param string $since
     * @return RunalyzeShoe
     */
    public function setSince($since)
    {
        $this->since = $since;

        return $this;
    }

    /**
     * Get since
     *
     * @return string 
     */
    public function getSince()
    {
        return $this->since;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return RunalyzeShoe
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set km
     *
     * @param string $km
     * @return RunalyzeShoe
     */
    public function setKm($km)
    {
        $this->km = $km;

        return $this;
    }

    /**
     * Get km
     *
     * @return string 
     */
    public function getKm()
    {
        return $this->km;
    }

    /**
     * Set time
     *
     * @param integer $time
     * @return RunalyzeShoe
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return integer 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set inuse
     *
     * @param boolean $inuse
     * @return RunalyzeShoe
     */
    public function setInuse($inuse)
    {
        $this->inuse = $inuse;

        return $this;
    }

    /**
     * Get inuse
     *
     * @return boolean 
     */
    public function getInuse()
    {
        return $this->inuse;
    }

    /**
     * Set additionalkm
     *
     * @param string $additionalkm
     * @return RunalyzeShoe
     */
    public function setAdditionalkm($additionalkm)
    {
        $this->additionalkm = $additionalkm;

        return $this;
    }

    /**
     * Get additionalkm
     *
     * @return string 
     */
    public function getAdditionalkm()
    {
        return $this->additionalkm;
    }

    /**
     * Set accountid
     *
     * @param integer $accountid
     * @return RunalyzeShoe
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
}
