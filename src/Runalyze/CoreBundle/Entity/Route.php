<?php

namespace Runalyze\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Route
 *
 * @ORM\Table(name="route", indexes={@ORM\Index(name="accountid", columns={"accountid"})})
 * @ORM\Entity
 */
class Route
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
     * @ORM\Column(name="accountid", type="integer", nullable=false)
     */
    private $accountid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="cities", type="string", length=255, nullable=false)
     */
    private $cities;

    /**
     * @var string
     *
     * @ORM\Column(name="distance", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $distance;

    /**
     * @var integer
     *
     * @ORM\Column(name="elevation", type="smallint", nullable=false)
     */
    private $elevation;

    /**
     * @var integer
     *
     * @ORM\Column(name="elevation_up", type="smallint", nullable=false)
     */
    private $elevationUp;

    /**
     * @var integer
     *
     * @ORM\Column(name="elevation_down", type="smallint", nullable=false)
     */
    private $elevationDown;

    /**
     * @var string
     *
     * @ORM\Column(name="lats", type="text", nullable=false)
     */
    private $lats;

    /**
     * @var string
     *
     * @ORM\Column(name="lngs", type="text", nullable=false)
     */
    private $lngs;

    /**
     * @var string
     *
     * @ORM\Column(name="elevations_original", type="text", nullable=false)
     */
    private $elevationsOriginal;

    /**
     * @var string
     *
     * @ORM\Column(name="elevations_corrected", type="text", nullable=false)
     */
    private $elevationsCorrected;

    /**
     * @var string
     *
     * @ORM\Column(name="elevations_source", type="string", length=255, nullable=false)
     */
    private $elevationsSource;

    /**
     * @var float
     *
     * @ORM\Column(name="startpoint_lat", type="float", precision=8, scale=5, nullable=false)
     */
    private $startpointLat;

    /**
     * @var float
     *
     * @ORM\Column(name="startpoint_lng", type="float", precision=8, scale=5, nullable=false)
     */
    private $startpointLng;

    /**
     * @var float
     *
     * @ORM\Column(name="endpoint_lat", type="float", precision=8, scale=5, nullable=false)
     */
    private $endpointLat;

    /**
     * @var float
     *
     * @ORM\Column(name="endpoint_lng", type="float", precision=8, scale=5, nullable=false)
     */
    private $endpointLng;

    /**
     * @var float
     *
     * @ORM\Column(name="min_lat", type="float", precision=8, scale=5, nullable=false)
     */
    private $minLat;

    /**
     * @var float
     *
     * @ORM\Column(name="min_lng", type="float", precision=8, scale=5, nullable=false)
     */
    private $minLng;

    /**
     * @var float
     *
     * @ORM\Column(name="max_lat", type="float", precision=8, scale=5, nullable=false)
     */
    private $maxLat;

    /**
     * @var float
     *
     * @ORM\Column(name="max_lng", type="float", precision=8, scale=5, nullable=false)
     */
    private $maxLng;

    /**
     * @var boolean
     *
     * @ORM\Column(name="in_routenet", type="boolean", nullable=false)
     */
    private $inRoutenet;



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
     * Set accountid
     *
     * @param integer $accountid
     * @return Route
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
     * Set name
     *
     * @param string $name
     * @return Route
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
     * Set cities
     *
     * @param string $cities
     * @return Route
     */
    public function setCities($cities)
    {
        $this->cities = $cities;

        return $this;
    }

    /**
     * Get cities
     *
     * @return string 
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * Set distance
     *
     * @param string $distance
     * @return Route
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
     * Set elevation
     *
     * @param integer $elevation
     * @return Route
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
     * Set elevationUp
     *
     * @param integer $elevationUp
     * @return Route
     */
    public function setElevationUp($elevationUp)
    {
        $this->elevationUp = $elevationUp;

        return $this;
    }

    /**
     * Get elevationUp
     *
     * @return integer 
     */
    public function getElevationUp()
    {
        return $this->elevationUp;
    }

    /**
     * Set elevationDown
     *
     * @param integer $elevationDown
     * @return Route
     */
    public function setElevationDown($elevationDown)
    {
        $this->elevationDown = $elevationDown;

        return $this;
    }

    /**
     * Get elevationDown
     *
     * @return integer 
     */
    public function getElevationDown()
    {
        return $this->elevationDown;
    }

    /**
     * Set lats
     *
     * @param string $lats
     * @return Route
     */
    public function setLats($lats)
    {
        $this->lats = $lats;

        return $this;
    }

    /**
     * Get lats
     *
     * @return string 
     */
    public function getLats()
    {
        return $this->lats;
    }

    /**
     * Set lngs
     *
     * @param string $lngs
     * @return Route
     */
    public function setLngs($lngs)
    {
        $this->lngs = $lngs;

        return $this;
    }

    /**
     * Get lngs
     *
     * @return string 
     */
    public function getLngs()
    {
        return $this->lngs;
    }

    /**
     * Set elevationsOriginal
     *
     * @param string $elevationsOriginal
     * @return Route
     */
    public function setElevationsOriginal($elevationsOriginal)
    {
        $this->elevationsOriginal = $elevationsOriginal;

        return $this;
    }

    /**
     * Get elevationsOriginal
     *
     * @return string 
     */
    public function getElevationsOriginal()
    {
        return $this->elevationsOriginal;
    }

    /**
     * Set elevationsCorrected
     *
     * @param string $elevationsCorrected
     * @return Route
     */
    public function setElevationsCorrected($elevationsCorrected)
    {
        $this->elevationsCorrected = $elevationsCorrected;

        return $this;
    }

    /**
     * Get elevationsCorrected
     *
     * @return string 
     */
    public function getElevationsCorrected()
    {
        return $this->elevationsCorrected;
    }

    /**
     * Set elevationsSource
     *
     * @param string $elevationsSource
     * @return Route
     */
    public function setElevationsSource($elevationsSource)
    {
        $this->elevationsSource = $elevationsSource;

        return $this;
    }

    /**
     * Get elevationsSource
     *
     * @return string 
     */
    public function getElevationsSource()
    {
        return $this->elevationsSource;
    }

    /**
     * Set startpointLat
     *
     * @param float $startpointLat
     * @return Route
     */
    public function setStartpointLat($startpointLat)
    {
        $this->startpointLat = $startpointLat;

        return $this;
    }

    /**
     * Get startpointLat
     *
     * @return float 
     */
    public function getStartpointLat()
    {
        return $this->startpointLat;
    }

    /**
     * Set startpointLng
     *
     * @param float $startpointLng
     * @return Route
     */
    public function setStartpointLng($startpointLng)
    {
        $this->startpointLng = $startpointLng;

        return $this;
    }

    /**
     * Get startpointLng
     *
     * @return float 
     */
    public function getStartpointLng()
    {
        return $this->startpointLng;
    }

    /**
     * Set endpointLat
     *
     * @param float $endpointLat
     * @return Route
     */
    public function setEndpointLat($endpointLat)
    {
        $this->endpointLat = $endpointLat;

        return $this;
    }

    /**
     * Get endpointLat
     *
     * @return float 
     */
    public function getEndpointLat()
    {
        return $this->endpointLat;
    }

    /**
     * Set endpointLng
     *
     * @param float $endpointLng
     * @return Route
     */
    public function setEndpointLng($endpointLng)
    {
        $this->endpointLng = $endpointLng;

        return $this;
    }

    /**
     * Get endpointLng
     *
     * @return float 
     */
    public function getEndpointLng()
    {
        return $this->endpointLng;
    }

    /**
     * Set minLat
     *
     * @param float $minLat
     * @return Route
     */
    public function setMinLat($minLat)
    {
        $this->minLat = $minLat;

        return $this;
    }

    /**
     * Get minLat
     *
     * @return float 
     */
    public function getMinLat()
    {
        return $this->minLat;
    }

    /**
     * Set minLng
     *
     * @param float $minLng
     * @return Route
     */
    public function setMinLng($minLng)
    {
        $this->minLng = $minLng;

        return $this;
    }

    /**
     * Get minLng
     *
     * @return float 
     */
    public function getMinLng()
    {
        return $this->minLng;
    }

    /**
     * Set maxLat
     *
     * @param float $maxLat
     * @return Route
     */
    public function setMaxLat($maxLat)
    {
        $this->maxLat = $maxLat;

        return $this;
    }

    /**
     * Get maxLat
     *
     * @return float 
     */
    public function getMaxLat()
    {
        return $this->maxLat;
    }

    /**
     * Set maxLng
     *
     * @param float $maxLng
     * @return Route
     */
    public function setMaxLng($maxLng)
    {
        $this->maxLng = $maxLng;

        return $this;
    }

    /**
     * Get maxLng
     *
     * @return float 
     */
    public function getMaxLng()
    {
        return $this->maxLng;
    }

    /**
     * Set inRoutenet
     *
     * @param boolean $inRoutenet
     * @return Route
     */
    public function setInRoutenet($inRoutenet)
    {
        $this->inRoutenet = $inRoutenet;

        return $this;
    }

    /**
     * Get inRoutenet
     *
     * @return boolean 
     */
    public function getInRoutenet()
    {
        return $this->inRoutenet;
    }
}
