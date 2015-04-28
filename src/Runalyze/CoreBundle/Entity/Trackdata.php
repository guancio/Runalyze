<?php

namespace Runalyze\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trackdata
 *
 * @ORM\Table(name="trackdata", indexes={@ORM\Index(name="accountid", columns={"accountid"})})
 * @ORM\Entity
 */
class Trackdata
{
    /**
     * @var integer
     *
     * @ORM\Column(name="activityid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $activityid;

    /**
     * @var integer
     *
     * @ORM\Column(name="accountid", type="integer", nullable=false)
     */
    private $accountid;

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="text", nullable=false)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="distance", type="text", nullable=false)
     */
    private $distance;

    /**
     * @var string
     *
     * @ORM\Column(name="pace", type="text", nullable=false)
     */
    private $pace;

    /**
     * @var string
     *
     * @ORM\Column(name="heartrate", type="text", nullable=false)
     */
    private $heartrate;

    /**
     * @var string
     *
     * @ORM\Column(name="cadence", type="text", nullable=false)
     */
    private $cadence;

    /**
     * @var string
     *
     * @ORM\Column(name="power", type="text", nullable=false)
     */
    private $power;

    /**
     * @var string
     *
     * @ORM\Column(name="temperature", type="text", nullable=false)
     */
    private $temperature;

    /**
     * @var string
     *
     * @ORM\Column(name="groundcontact", type="text", nullable=false)
     */
    private $groundcontact;

    /**
     * @var string
     *
     * @ORM\Column(name="vertical_oscillation", type="text", nullable=false)
     */
    private $verticalOscillation;

    /**
     * @var string
     *
     * @ORM\Column(name="pauses", type="text", nullable=false)
     */
    private $pauses;



    /**
     * Get activityid
     *
     * @return integer 
     */
    public function getActivityid()
    {
        return $this->activityid;
    }

    /**
     * Set accountid
     *
     * @param integer $accountid
     * @return Trackdata
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

    /**
     * Set time
     *
     * @param string $time
     * @return Trackdata
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set distance
     *
     * @param string $distance
     * @return Trackdata
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return string 
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set pace
     *
     * @param string $pace
     * @return Trackdata
     */
    public function setPace($pace)
    {
        $this->pace = $pace;

        return $this;
    }

    /**
     * Get pace
     *
     * @return string 
     */
    public function getPace()
    {
        return $this->pace;
    }

    /**
     * Set heartrate
     *
     * @param string $heartrate
     * @return Trackdata
     */
    public function setHeartrate($heartrate)
    {
        $this->heartrate = $heartrate;

        return $this;
    }

    /**
     * Get heartrate
     *
     * @return string 
     */
    public function getHeartrate()
    {
        return $this->heartrate;
    }

    /**
     * Set cadence
     *
     * @param string $cadence
     * @return Trackdata
     */
    public function setCadence($cadence)
    {
        $this->cadence = $cadence;

        return $this;
    }

    /**
     * Get cadence
     *
     * @return string 
     */
    public function getCadence()
    {
        return $this->cadence;
    }

    /**
     * Set power
     *
     * @param string $power
     * @return Trackdata
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return string 
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Set temperature
     *
     * @param string $temperature
     * @return Trackdata
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * Get temperature
     *
     * @return string 
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Set groundcontact
     *
     * @param string $groundcontact
     * @return Trackdata
     */
    public function setGroundcontact($groundcontact)
    {
        $this->groundcontact = $groundcontact;

        return $this;
    }

    /**
     * Get groundcontact
     *
     * @return string 
     */
    public function getGroundcontact()
    {
        return $this->groundcontact;
    }

    /**
     * Set verticalOscillation
     *
     * @param string $verticalOscillation
     * @return Trackdata
     */
    public function setVerticalOscillation($verticalOscillation)
    {
        $this->verticalOscillation = $verticalOscillation;

        return $this;
    }

    /**
     * Get verticalOscillation
     *
     * @return string 
     */
    public function getVerticalOscillation()
    {
        return $this->verticalOscillation;
    }

    /**
     * Set pauses
     *
     * @param string $pauses
     * @return Trackdata
     */
    public function setPauses($pauses)
    {
        $this->pauses = $pauses;

        return $this;
    }

    /**
     * Get pauses
     *
     * @return string 
     */
    public function getPauses()
    {
        return $this->pauses;
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Training", mappedBy="trackdata")
     */
    protected $trainings;
}
