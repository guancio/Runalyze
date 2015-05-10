<?php
namespace Runalyze\CoreBundle\Service;

/**
 * @author Hannes Christiansen & Michael Pohl
 * @package Runalyze\Service
 */
class Dataset {

    private $em;

    /**
     * Values from database
     * @var array
     */
    private $ValuesFromDB = null;
        
    public function __construct($em)
    {
        $this->em = $em->getRepository('RunalyzeCoreBundle:Dataset');
        $this->loadAll();
    }

    public function loadAll() {
         $DBconf = $this->em->findAll();

         $this->ValuesFromDB = $DBconf;
         
    }
    
    public function getAll() {
        
        foreach($DBconf as $key => $conf) {
             $values[$conf->getName()] = $conf;
        }
        return $values;
    }
    
    public function getActive() {
         foreach($this->ValuesFromDB as $key => $conf) {
             if($conf->getActive() === true)
                $values[$conf->getName()] = $conf;
        }
        return $values;
    }
    

}