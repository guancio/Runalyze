<?php

namespace Runalyze\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PluginConf
 *
 * @ORM\Table(name="plugin_conf", indexes={@ORM\Index(name="pluginid", columns={"pluginid"})})
 * @ORM\Entity
 */
class PluginConf
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
     * @ORM\Column(name="pluginid", type="integer", nullable=false)
     */
    private $pluginid;

    /**
     * @var string
     *
     * @ORM\Column(name="config", type="string", length=100, nullable=false)
     */
    private $config;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    private $value;



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
     * Set pluginid
     *
     * @param integer $pluginid
     * @return PluginConf
     */
    public function setPluginid($pluginid)
    {
        $this->pluginid = $pluginid;

        return $this;
    }

    /**
     * Get pluginid
     *
     * @return integer 
     */
    public function getPluginid()
    {
        return $this->pluginid;
    }

    /**
     * Set config
     *
     * @param string $config
     * @return PluginConf
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Get config
     *
     * @return string 
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return PluginConf
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Plugin", inversedBy="pluginconf")
     * @ORM\JoinColumn(name="pluginid", referencedColumnName="id")
     */
    protected $plugin;

    /**
     * Set plugin
     *
     * @param \Runalyze\CoreBundle\Entity\Plugin $plugin
     * @return PluginConf
     */
    public function setPlugin(\Runalyze\CoreBundle\Entity\Plugin $plugin = null)
    {
        $this->plugin = $plugin;

        return $this;
    }

    /**
     * Get plugin
     *
     * @return \Runalyze\CoreBundle\Entity\Plugin 
     */
    public function getPlugin()
    {
        return $this->plugin;
    }
}
