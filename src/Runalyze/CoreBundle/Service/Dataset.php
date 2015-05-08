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


         foreach($DBconf as $key => $conf) {
             $values[$conf->getName()] = $conf;
        }
         
         $this->ValuesFromDB = $values;
         
    }
    
    public function getAll() {
        return $this->ValuesFromDB;
    }
    

}