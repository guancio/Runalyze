<?php

namespace Runalyze\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dataset
 *
 * @ORM\Table(name="dataset", indexes={@ORM\Index(name="accountid", columns={"accountid"})})
 * @ORM\Entity
 */
class Dataset
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
     * @ORM\Column(name="name", type="string", length=20, nullable=false)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="modus", type="boolean", nullable=false)
     */
    private $modus = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="class", type="string", length=25, nullable=false)
     */
    private $class;

    /**
     * @var string
     *
     * @ORM\Column(name="style", type="string", length=100, nullable=false)
     */
    private $style;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="smallint", nullable=false)
     */
    private $position = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="summary", type="boolean", nullable=false)
     */
    private $summary = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="summary_mode", type="string", length=3, nullable=false)
     */
    private $summaryMode = 'SUM';

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
     * @return Dataset
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
     * Set active
     *
     * @param boolean $active
     * @return Dataset
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set modus
     *
     * @param boolean $modus
     * @return Dataset
     */
    public function setModus($modus)
    {
        $this->modus = $modus;

        return $this;
    }

    /**
     * Get modus
     *
     * @return boolean 
     */
    public function getModus()
    {
        return $this->modus;
    }

    /**
     * Set class
     *
     * @param string $class
     * @return Dataset
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set style
     *
     * @param string $style
     * @return Dataset
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return string 
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Dataset
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set summary
     *
     * @param boolean $summary
     * @return Dataset
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return boolean 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set summaryMode
     *
     * @param string $summaryMode
     * @return Dataset
     */
    public function setSummaryMode($summaryMode)
    {
        $this->summaryMode = $summaryMode;

        return $this;
    }

    /**
     * Get summaryMode
     *
     * @return string 
     */
    public function getSummaryMode()
    {
        return $this->summaryMode;
    }

    /**
     * Set accountid
     *
     * @param integer $accountid
     * @return Dataset
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
