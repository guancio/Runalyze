<?php

namespace Runalyze\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class PanelController extends Controller
{
    public function indexAction()
    {
        $parameters = array(
            'accountid' => $this->getUser()->getId(),
            'pltype' => 'panel'
        );
       $panels =  $this->getDoctrine()
                ->getManager()
                ->createQueryBuilder()
                ->select('pl')
                ->from('RunalyzeCoreBundle:Plugin', 'pl')
                ->where('pl.accountid = :accountid')
                ->andWhere('pl.type = :pltype')
                ->leftJoin('RunalyzeCoreBundle:PluginConf', 'plcfg', 'WITH', 'pl.id = plcfg.pluginid')
                ->setParameters($parameters)
                ->getQuery()
                ->getResult();
      /* dump($test);
       foreach($test as $plg) {
           dump($plg);
            $response = $this->forward('RunalyzePanel'.$plg->getKey().'Bundle:Default:index');
           echo $plg->getKey();
           
       }*/
        //Get Panelplugins of user and loop through each panel controller
        //$response = $this->forward('RunalyzePanelPrognoseBundle:Default:index');
       // return $response;
       return $this->render('RunalyzeCoreBundle:Panel:panel.html.twig',
               array('panels' => $panels));
    }
}
