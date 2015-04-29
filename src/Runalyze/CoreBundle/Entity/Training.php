<?php

namespace Runalyze\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Training
 *
 * @ORM\Table(name="training", indexes={@ORM\Index(name="time", columns={"accountid", "time"}), @ORM\Index(name="sportid", columns={"accountid", "sportid"}), @ORM\Index(name="typeid", columns={"accountid", "typeid"})})
 * @ORM\Entity
 */
class Training
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
     * @ORM\Column(name="sportid", type="integer", nullable=false)
     */
    private $sportid = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="typeid", type="integer", nullable=false)
     */
    private $typeid = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="time", type="integer", nullable=false)
     */
    private $time = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="created", type="integer", nullable=false)
     */
    private $created;

    /**
     * @var integer
     *
     * @ORM\Column(name="edited", type="integer", nullable=false)
     */
    private $edited;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_public", type="boolean", nullable=false)
     */
    private $isPublic = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_track", type="boolean", nullable=false)
     */
    private $isTrack = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="distance", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $distance = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="s", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $s = '0.00';

    /**
     * @var integer
     *
     * @ORM\Column(name="elapsed_time", type="integer", nullable=false)
     */
    private $elapsedTime = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="elevation", type="integer", nullable=false)
     */
    private $elevation = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="kcal", type="integer", nullable=false)
     */
    private $kcal = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pulse_avg", type="integer", nullable=false)
     */
    private $pulseAvg = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pulse_max", type="integer", nullable=false)
     */
    private $pulseMax = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="vdot", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $vdot = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="vdot_by_time", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $vdotByTime = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="vdot_with_elevation", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $vdotWithElevation = '0.00';

    /**
     * @var boolean
     *
     * @ORM\Column(name="use_vdot", type="boolean", nullable=false)
     */
    private $useVdot = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="jd_intensity", type="smallint", nullable=false)
     */
    private $jdIntensity = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="trimp", type="integer", nullable=false)
     */
    private $trimp = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="cadence", type="integer", nullable=false)
     */
    private $cadence = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="power", type="integer", nullable=false)
     */
    private $power = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="groundcontact", type="smallint", nullable=false)
     */
    private $groundcontact = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="vertical_oscillation", type="boolean", nullable=false)
     */
    private $verticalOscillation = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="temperature", type="boolean", nullable=true)
     */
    private $temperature;

    /**
     * @var integer
     *
     * @ORM\Column(name="weatherid", type="smallint", nullable=false)
     */
    private $weatherid = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="text", nullable=true)
     */
    private $route;

    /**
     * @var integer
     *
     * @ORM\Column(name="routeid", type="integer", nullable=false)
     */
    private $routeid;

    /**
     * @var string
     *
     * @ORM\Column(name="clothes", type="string", length=100, nullable=false)
     */
    private $clothes;

    /**
     * @var string
     *
     * @ORM\Column(name="splits", type="text", nullable=true)
     */
    private $splits;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="partner", type="text", nullable=true)
     */
    private $partner;

    /**
     * @var integer
     *
     * @ORM\Column(name="abc", type="smallint", nullable=false)
     */
    private $abc = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="shoeid", type="integer", nullable=false)
     */
    private $shoeid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=false)
     */
    private $notes;

    /**
     * @var integer
     *
     * @ORM\Column(name="accountid", type="integer", nullable=false)
     */
    private $accountid;

    /**
     * @var string
     *
     * @ORM\Column(name="creator", type="string", length=100, nullable=false)
     */
    private $creator;

    /**
     * @var string
     *
     * @ORM\Column(name="creator_details", type="text", nullable=false)
     */
    private $creatorDetails;

    /**
     * @var string
     *
     * @ORM\Column(name="activity_id", type="string", length=50, nullable=false)
     */
    private $activityId = '';



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
     * Set sportid
     *
     * @param integer $sportid
     * @return Training
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
     * Set typeid
     *
     * @param integer $typeid
     * @return Training
     */
    public function setTypeid($typeid)
    {
        $this->typeid = $typeid;

        return $this;
    }

    /**
     * Get typeid
     *
     * @return integer 
     */
    public function getTypeid()
    {
        return $this->typeid;
    }

    /**
     * Set time
     *
     * @param integer $time
     * @return Training
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
     * Set created
     *
     * @param integer $created
     * @return Training
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return integer 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set edited
     *
     * @param integer $edited
     * @return Training
     */
    public function setEdited($edited)
    {
        $this->edited = $edited;

        return $this;
    }

    /**
     * Get edited
     *
     * @return integer 
     */
    public function getEdited()
    {
        return $this->edited;
    }

    /**
     * Set isPublic
     *
     * @param boolean $isPublic
     * @return Training
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    /**
     * Get isPublic
     *
     * @return boolean 
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * Set isTrack
     *
     * @param boolean $isTrack
     * @return Training
     */
    public function setIsTrack($isTrack)
    {
        $this->isTrack = $isTrack;

        return $this;
    }

    /**
     * Get isTrack
     *
     * @return boolean 
     */
    public function getIsTrack()
    {
        return $this->isTrack;
    }

    /**
     * Set distance
     *
     * @param string $distance
     * @return Training
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
     * Set s
     *
     * @param string $s
     * @return Training
     */
    public function setS($s)
    {
        $this->s = $s;

        return $this;
    }

    /**
     * Get s
     *
     * @return string 
     */
    public function getS()
    {
        return $this->s;
    }

    /**
     * Set elapsedTime
     *
     * @param integer $elapsedTime
     * @return Training
     */
    public function setElapsedTime($elapsedTime)
    {
        $this->elapsedTime = $elapsedTime;

        return $this;
    }

    /**
     * Get elapsedTime
     *
     * @return integer 
     */
    public function getElapsedTime()
    {
        return $this->elapsedTime;
    }

    /**
     * Set elevation
     *
     * @param integer $elevation
     * @return Training
     */
    public function setElevation($elevation)
    {
        $this->elevation = $elevation;

        return $this;
    }

    /**
     * Get elevation
     *
     * @return integer 
     */
    public function getElevation()
    {
        return $this->elevation;
    }

    /**
     * Set kcal
     *
     * @param integer $kcal
     * @return Training
     */
    public function setKcal($kcal)
    {
        $this->kcal = $kcal;

        return $this;
    }

    /**
     * Get kcal
     *
     * @return integer 
     */
    public function getKcal()
    {
        return $this->kcal;
    }

    /**
     * Set pulseAvg
     *
     * @param integer $pulseAvg
     * @return Training
     */
    public function setPulseAvg($pulseAvg)
    {
        $this->pulseAvg = $pulseAvg;

        return $this;
    }

    /**
     * Get pulseAvg
     *
     * @return integer 
     */
    public function getPulseAvg()
    {
        return $this->pulseAvg;
    }

    /**
     * Set pulseMax
     *
     * @param integer $pulseMax
     * @return Training
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
     * Set vdot
     *
     * @param string $vdot
     * @return Training
     */
    public function setVdot($vdot)
    {
        $this->vdot = $vdot;

        return $this;
    }

    /**
     * Get vdot
     *
     * @return string 
     */
    public function getVdot()
    {
        return $this->vdot;
    }

    /**
     * Set vdotByTime
     *
     * @param string $vdotByTime
     * @return Training
     */
    public function setVdotByTime($vdotByTime)
    {
        $this->vdotByTime = $vdotByTime;

        return $this;
    }

    /**
     * Get vdotByTime
     *
     * @return string 
     */
    public function getVdotByTime()
    {
        return $this->vdotByTime;
    }

    /**
     * Set vdotWithElevation
     *
     * @param string $vdotWithElevation
     * @return Training
     */
    public function setVdotWithElevation($vdotWithElevation)
    {
        $this->vdotWithElevation = $vdotWithElevation;

        return $this;
    }

    /**
     * Get vdotWithElevation
     *
     * @return string 
     */
    public function getVdotWithElevation()
    {
        return $this->vdotWithElevation;
    }

    /**
     * Set useVdot
     *
     * @param boolean $useVdot
     * @return Training
     */
    public function setUseVdot($useVdot)
    {
        $this->useVdot = $useVdot;

        return $this;
    }

    /**
     * Get useVdot
     *
     * @return boolean 
     */
    public function getUseVdot()
    {
        return $this->useVdot;
    }

    /**
     * Set jdIntensity
     *
     * @param integer $jdIntensity
     * @return Training
     */
    public function setJdIntensity($jdIntensity)
    {
        $this->jdIntensity = $jdIntensity;

        return $this;
    }

    /**
     * Get jdIntensity
     *
     * @return integer 
     */
    public function getJdIntensity()
    {
        return $this->jdIntensity;
    }

    /**
     * Set trimp
     *
     * @param integer $trimp
     * @return Training
     */
    public function setTrimp($trimp)
    {
        $this->trimp = $trimp;

        return $this;
    }

    /**
     * Get trimp
     *
     * @return integer 
     */
    public function getTrimp()
    {
        return $this->trimp;
    }

    /**
     * Set cadence
     *
     * @param integer $cadence
     * @return Training
     */
    public function setCadence($cadence)
    {
        $this->cadence = $cadence;

        return $this;
    }

    /**
     * Get cadence
     *
     * @return integer 
     */
    public function getCadence()
    {
        return $this->cadence;
    }

    /**
     * Set power
     *
     * @param integer $power
     * @return Training
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return integer 
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Set groundcontact
     *
     * @param integer $groundcontact
     * @return Training
     */
    public function setGroundcontact($groundcontact)
    {
        $this->groundcontact = $groundcontact;

        return $this;
    }

    /**
     * Get groundcontact
     *
     * @return integer 
     */
    public function getGroundcontact()
    {
        return $this->groundcontact;
    }

    /**
     * Set verticalOscillation
     *
     * @param boolean $verticalOscillation
     * @return Training
     */
    public function setVerticalOscillation($verticalOscillation)
    {
        $this->verticalOscillation = $verticalOscillation;

        return $this;
    }

    /**
     * Get verticalOscillation
     *
     * @return boolean 
     */
    public function getVerticalOscillation()
    {
        return $this->verticalOscillation;
    }

    /**
     * Set temperature
     *
     * @param boolean $temperature
     * @return Training
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * Get temperature
     *
     * @return boolean 
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Set weatherid
     *
     * @param integer $weatherid
     * @return Training
     */
    public function setWeatherid($weatherid)
    {
        $this->weatherid = $weatherid;

        return $this;
    }

    /**
     * Get weatherid
     *
     * @return integer 
     */
    public function getWeatherid()
    {
        return $this->weatherid;
    }

    /**
     * Set route
     *
     * @param string $route
     * @return Training
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string 
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set routeid
     *
     * @param integer $routeid
     * @return Training
     */
    public function setRouteid($routeid)
    {
        $this->routeid = $routeid;

        return $this;
    }

    /**
     * Get routeid
     *
     * @return integer 
     */
    public function getRouteid()
    {
        return $this->routeid;
    }

    /**
     * Set clothes
     *
     * @param string $clothes
     * @return Training
     */
    public function setClothes($clothes)
    {
        $this->clothes = $clothes;

        return $this;
    }

    /**
     * Get clothes
     *
     * @return string 
     */
    public function getClothes()
    {
        return $this->clothes;
    }

    /**
     * Set splits
     *
     * @param string $splits
     * @return Training
     */
    public function setSplits($splits)
    {
        $this->splits = $splits;

        return $this;
    }

    /**
     * Get splits
     *
     * @return string 
     */
    public function getSplits()
    {
        return $this->splits;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Training
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set partner
     *
     * @param string $partner
     * @return Training
     */
    public function setPartner($partner)
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * Get partner
     *
     * @return string 
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * Set abc
     *
     * @param integer $abc
     * @return Training
     */
    public function setAbc($abc)
    {
        $this->abc = $abc;

        return $this;
    }

    /**
     * Get abc
     *
     * @return integer 
     */
    public function getAbc()
    {
        return $this->abc;
    }

    /**
     * Set shoeid
     *
     * @param integer $shoeid
     * @return Training
     */
    public function setShoeid($shoeid)
    {
        $this->shoeid = $shoeid;

        return $this;
    }

    /**
     * Get shoeid
     *
     * @return integer 
     */
    public function getShoeid()
    {
        return $this->shoeid;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return Training
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string 
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set accountid
     *
     * @param integer $accountid
     * @return Training
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
     * Set creator
     *
     * @param string $creator
     * @return Training
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return string 
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set creatorDetails
     *
     * @param string $creatorDetails
     * @return Training
     */
    public function setCreatorDetails($creatorDetails)
    {
        $this->creatorDetails = $creatorDetails;

        return $this;
    }

    /**
     * Get creatorDetails
     *
     * @return string 
     */
    public function getCreatorDetails()
    {
        return $this->creatorDetails;
    }

    /**
     * Set activityId
     *
     * @param string $activityId
     * @return Training
     */
    public function setActivityId($activityId)
    {
        $this->activityId = $activityId;

        return $this;
    }

    /**
     * Get activityId
     *
     * @return string 
     */
    public function getActivityId()
    {
        return $this->activityId;
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="Sport", inversedBy="trainings")
     * @ORM\JoinColumn(name="sportid", referencedColumnName="id")
     */
    protected $sport;
    
    /**
     * @ORM\OneToOne(targetEntity="Route")
     * @ORM\JoinColumn(name="route_id", referencedColumnName="id")
     **/
    private $trainingRoute;

    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="trainings")
     * @ORM\JoinColumn(name="accountid", referencedColumnName="id")
     */
    protected $account;

    /**
     * Set sport
     *
     * @param \Runalyze\CoreBundle\Entity\Sport $sport
     * @return Training
     */
    public function setSport(\Runalyze\CoreBundle\Entity\Sport $sport = null)
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * Get sport
     *
     * @return \Runalyze\CoreBundle\Entity\Sport 
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * Set trainingRoute
     *
     * @param \Runalyze\CoreBundle\Entity\Route $trainingRoute
     * @return Training
     */
    public function setTrainingRoute(\Runalyze\CoreBundle\Entity\Route $trainingRoute = null)
    {
        $this->trainingRoute = $trainingRoute;

        return $this;
    }

    /**
     * Get trainingRoute
     *
     * @return \Runalyze\CoreBundle\Entity\Route 
     */
    public function getTrainingRoute()
    {
        return $this->trainingRoute;
    }

    /**
     * Set account
     *
     * @param \Runalyze\CoreBundle\Entity\Account $account
     * @return Training
     */
    public function setAccount(\Runalyze\CoreBundle\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \Runalyze\CoreBundle\Entity\Account 
     */
    public function getAccount()
    {
        return $this->account;
    }
}
