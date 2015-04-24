<?php

namespace Runalyze\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sport
 *
 * @ORM\Table(name="sport", indexes={@ORM\Index(name="accountid", columns={"accountid"})})
 * @ORM\Entity
 */
class Sport
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
     * @ORM\Column(name="img", type="string", length=100, nullable=false)
     */
    private $img = 'unknown.gif';

    /**
     * @var boolean
     *
     * @ORM\Column(name="short", type="boolean", nullable=false)
     */
    private $short = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="kcal", type="smallint", nullable=false)
     */
    private $kcal = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="HFavg", type="smallint", nullable=false)
     */
    private $hfavg = '120';

    /**
     * @var boolean
     *
     * @ORM\Column(name="RPE", type="boolean", nullable=false)
     */
    private $rpe = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="speed", type="string", length=10, nullable=false)
     */
    private $speed = 'min/km';

    /**
     * @var boolean
     *
     * @ORM\Column(name="types", type="boolean", nullable=false)
     */
    private $types = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="power", type="boolean", nullable=false)
     */
    private $power = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="outside", type="boolean", nullable=false)
     */
    private $outside = '0';

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
     * @return Sport
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
     * Set img
     *
     * @param string $img
     * @return Sport
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string 
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set short
     *
     * @param boolean $short
     * @return Sport
     */
    public function setShort($short)
    {
        $this->short = $short;

        return $this;
    }

    /**
     * Get short
     *
     * @return boolean 
     */
    public function getShort()
    {
        return $this->short;
    }

    /**
     * Set kcal
     *
     * @param integer $kcal
     * @return Sport
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
     * Set hfavg
     *
     * @param integer $hfavg
     * @return Sport
     */
    public function setHfavg($hfavg)
    {
        $this->hfavg = $hfavg;

        return $this;
    }

    /**
     * Get hfavg
     *
     * @return integer 
     */
    public function getHfavg()
    {
        return $this->hfavg;
    }

    /**
     * Set rpe
     *
     * @param boolean $rpe
     * @return Sport
     */
    public function setRpe($rpe)
    {
        $this->rpe = $rpe;

        return $this;
    }

    /**
     * Get rpe
     *
     * @return boolean 
     */
    public function getRpe()
    {
        return $this->rpe;
    }

    /**
     * Set speed
     *
     * @param string $speed
     * @return Sport
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return string 
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set types
     *
     * @param boolean $types
     * @return Sport
     */
    public function setTypes($types)
    {
        $this->types = $types;

        return $this;
    }

    /**
     * Get types
     *
     * @return boolean 
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Set power
     *
     * @param boolean $power
     * @return Sport
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return boolean 
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Set outside
     *
     * @param boolean $outside
     * @return Sport
     */
    public function setOutside($outside)
    {
        $this->outside = $outside;

        return $this;
    }

    /**
     * Get outside
     *
     * @return boolean 
     */
    public function getOutside()
    {
        return $this->outside;
    }

    /**
     * Set accountid
     *
     * @param integer $accountid
     * @return Sport
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
