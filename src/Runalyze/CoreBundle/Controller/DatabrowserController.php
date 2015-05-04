<?php

namespace Runalyze\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Request;
use Runalyze\CoreBundle\Service\DataBrowserTime;
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
        $starttime = '1330580400';
        $endtime = '1431295190';
        
        $trainings = $em->getRepository('RunalyzeCoreBundle:Training')->findByTimeRangeForAccount($starttime, $endtime, $accountid);
        dump($trainings);
        return $this->render('RunalyzeCoreBundle:Databrowser:databrowser.html.twig',
                array('title' => $title));
    }
    
    /**
     * Init private timestamps from request
     */
    protected function initTimestamps() {
            if (!isset($_GET['start']) || !isset($_GET['end'])) {
                    $Mode = Configuration::DataBrowser()->mode();
                        
                    if ($Mode->showMonth()) {
                            $timestamp_start = mktime(0, 0, 0, date("m"), 1, date("Y"));
                            $timestamp_end   = mktime(23, 59, 50, date("m")+1, 0, date("Y"));
                    } else {
                            $timestamp_start = Time::Weekstart(time());
                            $timestamp_end   = Time::Weekend(time());
                    }
            } else {
                    $this->timestamp_start = $_GET['start'];
                    $this->timestamp_end   = $_GET['end'];
            }

            $this->day_count = round(($this->timestamp_end - $this->timestamp_start) / 86400);
    }

}
