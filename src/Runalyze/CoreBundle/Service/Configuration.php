<?php
namespace Runalyze\CoreBundle\Service;


/**
 * @author Hannes Christiansen & Michael Pohl
 * @package Runalyze\Service
 */
class Configuration {

    private $em;

    private $category;
    
    private $accountid;
    
    /**
     * Values from database
     * @var array
     */
    private $ValuesFromDB = null;
        
    public function __construct($em)
    {
        $this->em = $em->getRepository('RunalyzeCoreBundle:Conf');
    }

    public function setAccountid($accountid) {
        $this->accountid = $accountid;
        $this->loadAll();
    }
    public function loadAll() {
         $DBconf = $this->em->findAllByAccount($this->accountid);

         foreach($DBconf as $key => $conf) {
             $values[$conf->getCategory()][$conf->getKey()] = $conf->getValue();
        }
         
         $this->ValuesFromDB = $values;
         
    }
    
    public function setCategory($category) {
        $this->category = $category;
    }
    
    public function getCategory($category) {
        return $this->ValuesFromDB[$category];
    }
    
    public function get($key) {
        return $this->ValuesFromDB[$this->category][$key];
    }

}