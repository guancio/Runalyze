<?php

namespace Runalyze\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Request;
use Runalyze\CoreBundle\Service\DataBrowserTime as DBTime;
use Runalyze\CoreBundle\Service\Time;

class DatabrowserController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/databrowser", name="databrowser")
     */
    public function indexAction(Request $request)
    {
        $accountid = $this->getUser()->getID();
        $title['month'] = Time::Month(date("m", time()));
        $title['year'] = date("Y", time());
        $title['week'] = date("W", time());
        $em = $this->getDoctrine()->getManager();
        
        $time = $this->initTimestamps($request);
        
        $starttime = $time['start'];
        $endtime = $time['end'];
        
        $backtime = DBTime::prevTimestamps($starttime, $endtime);
        $nexttime = DBTime::nextTimestamps($starttime, $endtime);
        dump($nexttime);
        dump($title);
        
        $trainings = $em->getRepository('RunalyzeCoreBundle:Training')->findByTimeRangeForAccount($starttime, $endtime, $accountid);
        dump($trainings);
        print_r($trainings);
        return $this->render('RunalyzeCoreBundle:Databrowser:databrowser.html.twig',
                array('title' => $title,
                      'backtime' => $backtime,
                      'nexttime' => $nexttime));
    }
    
    /**
     * Init private timestamps from request
     */
    protected function initTimestamps(Request $request) {
        $dbConf = $this->get('runalyze.configuration')->getCategory('data-browser');
        dump($dbConf);
            if (!empty($request->query->get('start')) && !empty($request->query->get('end'))){

                    if ($dbConf['DB_DISPLAY_MODE'] != 'week') {
                            $rdata['start'] = mktime(0, 0, 0, date("m"), 1, date("Y"));
                            $rdata['end']   = mktime(23, 59, 50, date("m")+1, 0, date("Y"));
                    } else {
                            $rdata['start'] = Time::Weekstart(time());
                            $rdata['end']   = Time::Weekend(time());
                    }
            } else {
                   $rdata['start'] = $request->query->get('start');
                   $rdata['end']   = $request->query->get('end');
            }
            $rdata['days'] = round(($rdata['end'] - $rdata['start']) / 86400);
            echo $rdata['days'];
            return $rdata;
    }

}
