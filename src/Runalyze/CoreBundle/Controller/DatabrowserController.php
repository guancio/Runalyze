<?php

namespace Runalyze\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Request;
use Runalyze\CoreBundle\Service\DataBrowserTime as DBTime;
use Runalyze\CoreBundle\Service\Time;
use Runalyze\CoreBundle\Service\ActivityView;

class DatabrowserController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/databrowser", name="databrowser")
     */
    public function indexAction(Request $request)
    {
        $accountid = $this->getUser()->getID();
        $em = $this->getDoctrine()->getManager();
        
        $time = $this->initTimestamps($request);
        dump($time);
        //Get title
        $title['month'] = Time::Month(date("m", $time['start']));
        $title['year'] = date("Y", $time['start']);
        $title['week'] = date("W", $time['start']);
        //Get times for navigation
        $backtime = DBTime::prevTimestamps($time['start'], $time['end']);
        $nexttime = DBTime::nextTimestamps($time['start'], $time['end']);
        $year = DBTime::year($time['start']);
        $month = DBTime::month($time['start']);
        $week = DBTime::week($time['start']);
        //Get Dataset
        $dataset = $this->get('runalyze.dataset')->getActive();
        dump($dataset);
        dump($this->get('runalyze.conf')->getCategory('data-browser'));
        //Get needed trainings
        $trainings = $em->getRepository('RunalyzeCoreBundle:Training')->findByTimeRangeForAccount($time['start'], $time['end'], $accountid);
        //Get ShortSports
        $emSp = $em->getRepository('RunalyzeCoreBundle:Sport')->getShortSport($accountid);
        $shortSport = array(); 
        foreach($emSp as $Sp) {
            $shortSport[] = $Sp['id'];
        }
        
        //Create empty days array
        $days = array();
        for ($w = 0; $w <= ($time['days'] - 1); $w++) {
            $days[] = array(
                'date' => mktime(0, 0, 0, date("m", $time['start']), date("d", $time['start']) + $w, date("Y", $time['start'])),
                'shorts' => array(),
                'trainings' => array());
        }
        

        foreach ($trainings as $Training) {
                $w = Time::diffInDays($Training->getTime(), $time['start']);
                 $tr = $this->get('runalyze.training');
                 $tr->set($Training);
                 $tr->VerticalOscillation();

                 
                if (in_array($Training->getSportid(), $shortSport)) {
                        $days[$w]['shorts'][]    = $Training;
                } else {
                        $days[$w]['trainings'][] = $Training;
                }
        }
        
                return $this->render('RunalyzeCoreBundle:Databrowser:databrowser.html.twig',
                array('title' => $title,
                      'backtime' => $backtime,
                      'nexttime' => $nexttime,
                      'days' => $days,
                      'year' => $year,
                      'month' => $month,
                      'week' => $week,
                      'shortSport' => $shortSport,
                      'dataset' => $dataset
                    ));
    }
    
    /**
     * Init private timestamps from request
     */
    protected function initTimestamps(Request $request) {
        $dbConf = $this->get('runalyze.configuration');
        $dbConf->setAccountid($this->getUser()->getID());
        $dbConf = $dbConf->getCategory('data-browser');
            if(!$request->query->get('start') && !$request->query->get('end')) {

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
            return $rdata;
    }
    

}
