<?php
/**
 * This file contains the class of the RunalyzePluginStat "Record".
 * @package Runalyze\Plugins\Stats
 */

use Runalyze\Configuration;
use Runalyze\Activity\Distance;
use Runalyze\Activity\Duration;
use Runalyze\Activity\Pace;
use Runalyze\Util\Time;
use Runalyze\Model\Sport;
use Runalyze\Model\Factory;

$PLUGINKEY = 'RunalyzePluginStat_Record';
/**
 * Class: RunalyzePluginStat_Record
 * @author Roberto Guanciale
 * @package Runalyze\Plugins\Stats
 */
class RunalyzePluginStat_Record extends PluginStat {
	/**
	 * Name
	 * @return string
	 */
	final public function name() {
		return __('Personal Records');
	}

	/**
	 * Description
	 * @return string
	 */
	final public function description() {
		return __('Faster, longer, better: Your records from your activities.');
	}

	/**
	 * Init data 
	 */
	protected function prepareForDisplay() {
		$this->setAnalysisNavigation();
		$this->setSportsNavigation();
		$this->setYearsNavigation(true, true, true);

		$this->setHeaderWithSportAndYear();
	}


	private function setAnalysisNavigation() {
		if ($this->dat == '') $this->dat = 'km';
		$LinkList = '<li class="with-submenu"><span class="link">' . $this->getAnalysisType() . '</span><ul class="submenu">';
		$LinkList .= '<li' . ('km' == $this->dat ? ' class="active"' : '') . '>' . $this->getInnerLink(__('by distance'), $this->sportid, $this->year, 'km') . '</li>';
		$LinkList .= '<li' . ('s' == $this->dat ? ' class="active"' : '') . '>' . $this->getInnerLink(__('by time'), $this->sportid, $this->year, 's') . '</li>';
		$LinkList .= '<li' . ('em' == $this->dat ? ' class="active"' : '') . '>' . $this->getInnerLink(__('by elevation'), $this->sportid, $this->year, 'em') . '</li>';
		$LinkList .= '<li' . ('kcal' == $this->dat ? ' class="active"' : '') . '>' . $this->getInnerLink(__('by calories'), $this->sportid, $this->year, 'kcal') . '</li>';
		$LinkList .= '<li' . ('trimp' == $this->dat ? ' class="active"' : '') . '>' . $this->getInnerLink(__('by trimp'), $this->sportid, $this->year, 'trimp') . '</li>';
		$LinkList .= '<li' . ('n' == $this->dat ? ' class="active"' : '') . '>' . $this->getInnerLink(__('by number'), $this->sportid, $this->year, 'n') . '</li>';
		$LinkList .= '</ul></li>';

		$this->setToolbarNavigationLinks(array($LinkList));
	}

	private function getAnalysisType() {
		$types = ['km' => __('by distance'),
			's' => __('by time'),
			'em' => __('by elevation'),
			'kcal' => __('by calories'),
			'trimp' => __('by trimp'),
			'n' => __('by number')
			];
		return $types[$this->dat];
	}

	/**
	 * Title for all years
	 * @return string
	 */
	protected function titleForAllYears() {
		return __('All years');
	}

	/**
	 * Display the content
	 * @see PluginStat::displayContent()
	 */
	protected function displayContent() {
		$this->displayRecord();
	}

	/**
	 * Init configuration
	 */
	protected function initConfiguration() {
		$Configuration = new PluginConfiguration($this->id());

		$Sports = SportFactory::AllSports();
		foreach ($Sports as $sport) {
		    $Configuration->addValue( new PluginConfigurationValueArray('pb_distances'.$sport['id'], __('Distances for yearly comparison for '.$sport['name']), '', array(1, 3, 5)) );
		}
		
		$this->setConfiguration($Configuration);
	}

	/**
	 * Display the table with general records
	 */
	private function displayRecord() {
		echo '<table class="fullwidth zebra-style">';
		echo '<thead><tr><th colspan="11" class="l">'.$rekord['name'].'</th></tr></thead>';
		echo '<tbody>';

		$Factory = new Factory(SessionAccountHandler::getId());
		$Sport = $Factory->sport($this->sportid);

		foreach ($this->Configuration()->value('pb_distances'.$this->sportid) as $distance) {
        		$Request = DB::getInstance()->prepare('
        			 SELECT `id`, `time`, `s`, `distance`, `sportid`
        			 FROM `'.PREFIX.'training`
        			 WHERE `sportid`=:sportid
        			      '.$this->getYearDependenceForQuery().'
        			      AND `distance`>=:distance
         			 ORDER BY (`distance`/`s`) DESC, `s` DESC LIMIT 10'
        	      	);
        		
        		$Request->bindValue('sportid', $this->sportid);
        		$Request->bindValue('distance', $distance);
        		$Request->execute();
        		$data = $Request->fetchAll();
        
        		$output = false;
        		
        		if (!empty($data)) {
        		   $output = true;
        		   echo '<tr class="r">';
        		   echo '<td class="b l">'.$distance.' km</td>';
        		   $j = 0;
        		   foreach ($data as $j => $dat) {
        		   	   $Pace = new Pace($dat['s'], $dat['distance']);
        		   	   $Pace->setUnit($Sport->paceUnit());
        		  	   $code = $Pace->valueWithAppendix();
        			   echo '<td class="small"><span title="'.date("d.m.Y",$dat['time']).'">
        			   	  '.Ajax::trainingLink($dat['id'], $code).'
        				   </span></td>';
        		   }
        		   for (; $j < 9; $j++)
        		       echo HTML::emptyTD();		   
        		   echo '</tr>';
        		}
        	
        
        		if (!$output)
        		  echo '<tr><td class="b l">'.$distance.' km</td><td colspan="10"><em>'.__('No data available').'</em></td></tr>';
		}

		echo '</tbody>';
		echo '</table>';
	}

}