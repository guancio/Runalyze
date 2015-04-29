<?php

namespace Runalyze\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Account
 *
 * @ORM\Table(name="account", uniqueConstraints={@ORM\UniqueConstraint(name="username", columns={"username"}), @ORM\UniqueConstraint(name="mail", columns={"mail"}), @ORM\UniqueConstraint(name="session_id", columns={"session_id"})})
 * @ORM\Entity
 */
class Account implements UserInterface, \Serializable
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
     * @Assert\NotBlank()
     * @ORM\Column(name="username", type="string", length=60, nullable=false)
     */
    private $username;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(name="mail", type="string", length=100, nullable=false)
     */
    private $mail;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="language", type="string", length=5, nullable=false)
     */
    private $language;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="password", type="string", length=64, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=64, nullable=false)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="session_id", type="string", length=32, nullable=true)
     */
    private $sessionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="registerdate", type="integer", nullable=false)
     */
    private $registerdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastaction", type="integer", nullable=false)
     */
    private $lastaction;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastlogin", type="integer", nullable=false)
     */
    private $lastlogin;

    /**
     * @var string
     *
     * @ORM\Column(name="autologin_hash", type="string", length=32, nullable=false)
     */
    private $autologinHash;

    /**
     * @var string
     *
     * @ORM\Column(name="changepw_hash", type="string", length=32, nullable=false)
     */
    private $changepwHash;

    /**
     * @var integer
     *
     * @ORM\Column(name="changepw_timelimit", type="integer", nullable=false)
     */
    private $changepwTimelimit;

    /**
     * @var string
     *
     * @ORM\Column(name="activation_hash", type="string", length=32, nullable=false)
     */
    private $activationHash;

    /**
     * @var string
     *
     * @ORM\Column(name="deletion_hash", type="string", length=32, nullable=false)
     */
    private $deletionHash;


    public function __construct()
    {
        $this->isActive = true;
        $this->setRegisterdate(date_timestamp_get(new \DateTime()));
        $this->userdata = new ArrayCollection();
        $this->shoes = new ArrayCollection();
        $this->dataset = new ArrayCollection();
        $this->conf = new ArrayCollection();
        $this->trainings = new ArrayCollection();
        $this->clothes = new ArrayCollection();
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }

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
     * Set username
     *
     * @param string $username
     * @return Account
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Account
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
     * Set mail
     *
     * @param string $mail
     * @return Account
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Account
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Account
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Account
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set sessionId
     *
     * @param string $sessionId
     * @return Account
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * Get sessionId
     *
     * @return string 
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Set registerdate
     *
     * @param integer $registerdate
     * @return Account
     */
    public function setRegisterdate($registerdate)
    {
        $this->registerdate = $registerdate;

        return $this;
    }

    /**
     * Get registerdate
     *
     * @return integer 
     */
    public function getRegisterdate()
    {
        return $this->registerdate;
    }

    /**
     * Set lastaction
     *
     * @param integer $lastaction
     * @return Account
     */
    public function setLastaction($lastaction)
    {
        $this->lastaction = $lastaction;

        return $this;
    }

    /**
     * Get lastaction
     *
     * @return integer 
     */
    public function getLastaction()
    {
        return $this->lastaction;
    }

    /**
     * Set lastlogin
     *
     * @param integer $lastlogin
     * @return Account
     */
    public function setLastlogin($lastlogin)
    {
        $this->lastlogin = $lastlogin;

        return $this;
    }

    /**
     * Get lastlogin
     *
     * @return integer 
     */
    public function getLastlogin()
    {
        return $this->lastlogin;
    }

    /**
     * Set autologinHash
     *
     * @param string $autologinHash
     * @return Account
     */
    public function setAutologinHash($autologinHash)
    {
        $this->autologinHash = $autologinHash;

        return $this;
    }

    /**
     * Get autologinHash
     *
     * @return string 
     */
    public function getAutologinHash()
    {
        return $this->autologinHash;
    }

    /**
     * Set changepwHash
     *
     * @param string $changepwHash
     * @return Account
     */
    public function setChangepwHash($changepwHash)
    {
        $this->changepwHash = $changepwHash;

        return $this;
    }

    /**
     * Get changepwHash
     *
     * @return string 
     */
    public function getChangepwHash()
    {
        return $this->changepwHash;
    }

    /**
     * Set changepwTimelimit
     *
     * @param integer $changepwTimelimit
     * @return Account
     */
    public function setChangepwTimelimit($changepwTimelimit)
    {
        $this->changepwTimelimit = $changepwTimelimit;

        return $this;
    }

    /**
     * Get changepwTimelimit
     *
     * @return integer 
     */
    public function getChangepwTimelimit()
    {
        return $this->changepwTimelimit;
    }

    /**
     * Set activationHash
     *
     * @param string $activationHash
     * @return Account
     */
    public function setActivationHash($activationHash)
    {
        $this->activationHash = $activationHash;

        return $this;
    }

    /**
     * Get activationHash
     *
     * @return string 
     */
    public function getActivationHash()
    {
        return $this->activationHash;
    }

    /**
     * Set deletionHash
     *
     * @param string $deletionHash
     * @return Account
     */
    public function setDeletionHash($deletionHash)
    {
        $this->deletionHash = $deletionHash;

        return $this;
    }

    /**
     * Get deletionHash
     *
     * @return string 
     */
    public function getDeletionHash()
    {
        return $this->deletionHash;
    }


    public function eraseCredentials()
    {
    }


    public function getRoles()
    {
        return array('ROLE_USER');
    }


    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            $this->salt
        ) = unserialize($serialized);
    }
    
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="account")
     */
    protected $userdata;
    
    /**
     * @ORM\OneToMany(targetEntity="Shoe", mappedBy="account")
     */
    protected $shoes;
    
    /**
     * @ORM\OneToMany(targetEntity="Dataset", mappedBy="account")
     */
    protected $dataset;
   
     /**
     * @ORM\OneToMany(targetEntity="Conf", mappedBy="account")
     */
    protected $conf;
    
      /**
     * @ORM\OneToMany(targetEntity="Training", mappedBy="account")
     */
    protected $trainings;
    
      /**
     * @ORM\OneToMany(targetEntity="Clothes", mappedBy="account")
     */
    protected $clothes;
    

    /**
     * Add userdata
     *
     * @param \Runalyze\CoreBundle\Entity\User $userdata
     * @return Account
     */
    public function addUserdatum(\Runalyze\CoreBundle\Entity\User $userdata)
    {
        $this->userdata[] = $userdata;

        return $this;
    }

    /**
     * Remove userdata
     *
     * @param \Runalyze\CoreBundle\Entity\User $userdata
     */
    public function removeUserdatum(\Runalyze\CoreBundle\Entity\User $userdata)
    {
        $this->userdata->removeElement($userdata);
    }

    /**
     * Get userdata
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserdata()
    {
        return $this->userdata;
    }

    /**
     * Add shoes
     *
     * @param \Runalyze\CoreBundle\Entity\Shoe $shoes
     * @return Account
     */
    public function addShoe(\Runalyze\CoreBundle\Entity\Shoe $shoes)
    {
        $this->shoes[] = $shoes;

        return $this;
    }

    /**
     * Remove shoes
     *
     * @param \Runalyze\CoreBundle\Entity\Shoe $shoes
     */
    public function removeShoe(\Runalyze\CoreBundle\Entity\Shoe $shoes)
    {
        $this->shoes->removeElement($shoes);
    }

    /**
     * Get shoes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getShoes()
    {
        return $this->shoes;
    }

    /**
     * Add dataset
     *
     * @param \Runalyze\CoreBundle\Entity\Dataset $dataset
     * @return Account
     */
    public function addDataset(\Runalyze\CoreBundle\Entity\Dataset $dataset)
    {
        $this->dataset[] = $dataset;

        return $this;
    }

    /**
     * Remove dataset
     *
     * @param \Runalyze\CoreBundle\Entity\Dataset $dataset
     */
    public function removeDataset(\Runalyze\CoreBundle\Entity\Dataset $dataset)
    {
        $this->dataset->removeElement($dataset);
    }

    /**
     * Get dataset
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDataset()
    {
        return $this->dataset;
    }

    /**
     * Add conf
     *
     * @param \Runalyze\CoreBundle\Entity\Conf $conf
     * @return Account
     */
    public function addConf(\Runalyze\CoreBundle\Entity\Conf $conf)
    {
        $this->conf[] = $conf;

        return $this;
    }

    /**
     * Remove conf
     *
     * @param \Runalyze\CoreBundle\Entity\Conf $conf
     */
    public function removeConf(\Runalyze\CoreBundle\Entity\Conf $conf)
    {
        $this->conf->removeElement($conf);
    }

    /**
     * Get conf
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConf()
    {
        return $this->conf;
    }

    /**
     * Add trainings
     *
     * @param \Runalyze\CoreBundle\Entity\Training $trainings
     * @return Account
     */
    public function addTraining(\Runalyze\CoreBundle\Entity\Training $trainings)
    {
        $this->trainings[] = $trainings;

        return $this;
    }

    /**
     * Remove trainings
     *
     * @param \Runalyze\CoreBundle\Entity\Training $trainings
     */
    public function removeTraining(\Runalyze\CoreBundle\Entity\Training $trainings)
    {
        $this->trainings->removeElement($trainings);
    }

    /**
     * Get trainings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrainings()
    {
        return $this->trainings;
    }

    /**
     * Add clothes
     *
     * @param \Runalyze\CoreBundle\Entity\Clothes $clothes
     * @return Account
     */
    public function addClothe(\Runalyze\CoreBundle\Entity\Clothes $clothes)
    {
        $this->clothes[] = $clothes;

        return $this;
    }

    /**
     * Remove clothes
     *
     * @param \Runalyze\CoreBundle\Entity\Clothes $clothes
     */
    public function removeClothe(\Runalyze\CoreBundle\Entity\Clothes $clothes)
    {
        $this->clothes->removeElement($clothes);
    }

    /**
     * Get clothes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClothes()
    {
        return $this->clothes;
    }
}
