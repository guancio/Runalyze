<?php

namespace Runalyze\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="time", columns={"accountid", "time"})})
 * @ORM\Entity
 */
class User
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
     * @var integer
     *
     * @ORM\Column(name="time", type="integer", nullable=false)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="decimal", precision=4, scale=1, nullable=false)
     */
    private $weight = '0.0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pulse_rest", type="smallint", nullable=false)
     */
    private $pulseRest = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pulse_max", type="smallint", nullable=false)
     */
    private $pulseMax = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="fat", type="decimal", precision=3, scale=1, nullable=false)
     */
    private $fat = '0.0';

    /**
     * @var string
     *
     * @ORM\Column(name="water", type="decimal", precision=3, scale=1, nullable=false)
     */
    private $water = '0.0';

    /**
     * @var string
     *
     * @ORM\Column(name="muscles", type="decimal", precision=3, scale=1, nullable=false)
     */
    private $muscles = '0.0';

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
     * Set time
     *
     * @param integer $time
     * @return User
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
     * Set weight
     *
     * @param string $weight
     * @return User
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set pulseRest
     *
     * @param integer $pulseRest
     * @return User
     */
    public function setPulseRest($pulseRest)
    {
        $this->pulseRest = $pulseRest;

        return $this;
    }

    /**
     * Get pulseRest
     *
     * @return integer 
     */
    public function getPulseRest()
    {
        return $this->pulseRest;
    }

    /**
     * Set pulseMax
     *
     * @param integer $pulseMax
     * @return User
     */
    public function setPulseMax($pulseMax)
    {
        $this->pulseMax = $pulseMax;

        return $this;
    }

    /**
     * Get pulseMax
     *
     * @return integer 
     */
    public function getPulseMax()
    {
        return $this->pulseMax;
    }

    /**
     * Set fat
     *
     * @param string $fat
     * @return User
     */
    public function setFat($fat)
    {
        $this->fat = $fat;

        return $this;
    }

    /**
     * Get fat
     *
     * @return string 
     */
    public function getFat()
    {
        return $this->fat;
    }

    /**
     * Set water
     *
     * @param string $water
     * @return User
     */
    public function setWater($water)
    {
        $this->water = $water;

        return $this;
    }

    /**
     * Get water
     *
     * @return string 
     */
    public function getWater()
    {
        return $this->water;
    }

    /**
     * Set muscles
     *
     * @param string $muscles
     * @return User
     */
    public function setMuscles($muscles)
    {
        $this->muscles = $muscles;

        return $this;
    }

    /**
     * Get muscles
     *
     * @return string 
     */
    public function getMuscles()
    {
        return $this->muscles;
    }

    /**
     * Set accountid
     *
     * @param integer $accountid
     * @return User
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
