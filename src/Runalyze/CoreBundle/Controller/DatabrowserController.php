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
        $em = $this->getDoctrine()->getManager();
        
        $time = $this->initTimestamps($request);
        
        $title['month'] = Time::Month(date("m", $time['start']));
        $title['year'] = date("Y", $time['start']);
        $title['week'] = date("W", $time['start']);
        $backtime = DBTime::prevTimestamps($time['start'], $time['end']);
        $nexttime = DBTime::nextTimestamps($time['start'], $time['end']);
        $year = DBTime::year($time['start']);
        $month = DBTime::month($time['start']);
        $week = DBTime::week($time['start']);
        $dataset = $this->get('runalyze.dataset')->getAll();
        $trainings = $em->getRepository('RunalyzeCoreBundle:Training')->findByTimeRangeForAccount($time['start'], $time['end'], $accountid);
        dump($trainings);
        return $this->render('RunalyzeCoreBundle:Databrowser:databrowser.html.twig',
                array('title' => $title,
                      'backtime' => $backtime,
                      'nexttime' => $nexttime,
                      'days' => $time['days'],
                      'year' => $year,
                      'month' => $month,
                      'week' => $week,
                      'trainings' => $trainings,
                      'dataset' => $dataset
                    ));
    }
    
    /**
     * Init private timestamps from request
     */
    protected function initTimestamps(Request $request) {
        $dbConf = $this->get('runalyze.configuration')->getCategory('data-browser');
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
