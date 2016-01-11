<?php
/**
 * This file contains the class of the RunalyzePluginStat "Record".
 * @package Runalyze\Plugins\Stats
 */

use Runalyze\Configuration;
use Runalyze\Activity\Distance;
use Runalyze\Activity\Duration;
use Runalyze\Activity\Pace;
use Runalyze\Activity\HeartRate;
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
	private $types = array();

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
		$this->initData();

		$this->setAnalysisNavigation();
		$this->setSportsNavigation(true, true);
		$this->setYearsNavigation(true, true, true);

		$this->setHeaderWithSportAndYear();
	}

	private function initData() {
 		$this->types = [
			'p' => __('by pace'),
			'bpm' => __('by heart rate'),
			'vdot' => __('by vdot')
			];
	}

	private function setAnalysisNavigation() {
		if ($this->dat == '') $this->dat = 'p';
		$LinkList = '<li class="with-submenu"><span class="link">' . $this->types[$this->dat]. '</span><ul class="submenu">';
		foreach ($this->types as $code => $name) {
		  $LinkList .= '<li' . ($code == $this->dat ? ' class="active"' : '') . '>' . $this->getInnerLink($name, $this->sportid, $this->year, $code) . '</li>';
		}
		$LinkList .= '</ul></li>';

		$this->setToolbarNavigationLinks(array($LinkList));
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
		    if ($sport['id'] == Configuration::General()->runningSport())
		       $stdValues = array(1, 3, 5, 10, 21.1, 42.2);
		    else if ($sport['name'] == 'Swimming')
		       $stdValues = array(0.1, 0.5, 0.8, 1, 2, 5);
		    else
		       $stdValues = array(1, 3, 5, 10, 20, 30, 40, 50);
		    $Configuration->addValue( new PluginConfigurationValueArray('pb_distances'.$sport['id'], __('Distances for yearly comparison for '.$sport['name']), '', $stdValues) );
		}
		
		$this->setConfiguration($Configuration);
	}

	/**
	 * Display the table with general records
	 */
	private function displayRecord() {
	    if ($this->sportid > 0) {
	       $sportData = SportFactory::DataFor($this->sportid);
	       $Sports = array($sportData);
	    }
	    else {
	       $Sports = SportFactory::AllSports();
	    }
            foreach ($Sports as $sportData) {
		$Sport = new Sport\Entity($sportData);

		echo '<table class="fullwidth zebra-style">';
		echo '<thead><tr><th colspan="11" class="l">'.$Sport->icon()->code().' '.$Sport->name().'</th></tr></thead>';
		echo '<tbody>';

		$Factory = new Factory(SessionAccountHandler::getId());

		foreach ($this->Configuration()->value('pb_distances'.$sportData['id']) as $distance) {
        		$Request = DB::getInstance()->prepare('
        			 SELECT `id`, `time`, `s`, `distance`, `sportid`, `pulse_avg`, `vdot`
        			 FROM `'.PREFIX.'training`
        			 WHERE `sportid`=:sportid
        			      '.$this->getYearDependenceForQuery().'
				      '.(('p' == $this->dat)?' AND `distance` > 0':'').'
				      '.(('bpm' == $this->dat)?' AND `pulse_avg` > 0':'').'
				      '.(('vdot' == $this->dat)?' AND `vdot` > 0':'').'
        			      AND `distance`>=:distance
         			 ORDER BY
				       '.(('p' == $this->dat)?'(`distance`/`s`) DESC, `s` DESC':'').'
				       '.(('bpm' == $this->dat)?'`pulse_avg`, `s` DESC':'').'
				       '.(('vdot' == $this->dat)?'`vdot` DESC, `s` DESC':'').'
				 LIMIT 10'
        	      	);
        		
        		$Request->bindValue('sportid', $sportData['id']);
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
			   	   if ('p' == $this->dat) {
         		   	      	$Pace = new Pace($dat['s'], $dat['distance']);
        		   	      	$Pace->setUnit($Sport->paceUnit());
					$code = $Pace->valueWithAppendix();
				   }
				   else if ('bpm' == $this->dat) {
				   	$HeartRate = new HeartRate($dat['pulse_avg']);
				   	$code = $HeartRate->string();
				   }
				   else if ('vdot' == $this->dat) {
				   	$code = $dat['vdot'];
				   }
        			   echo '<td class="small"><span title="'.date("d.m.Y",$dat['time']).'">
        			   	  '.Ajax::trainingLink($dat['id'], $code).'
        				   </span></td>';
        		   }
        		   for (; $j < 9; $j++)
        		       echo HTML::emptyTD();		   
        		   echo '</tr>';
        		}
        	
        
        		// if (!$output)
        		//   echo '<tr><td class="b l">'.$distance.' km</td><td colspan="10"><em>'.__('No data available').'</em></td></tr>';
		}


        	$Request = DB::getInstance()->prepare('
        		SELECT `id`, `time`, `s`, `distance`, `sportid`
        		FROM `'.PREFIX.'training`
        		WHERE `sportid`=:sportid
        		    '.$this->getYearDependenceForQuery().'
			AND `distance` > 0
         		ORDER BY `distance` DESC, `s` DESC
                        LIMIT 10'
        	);
        		
        	$Request->bindValue('sportid', $sportData['id']);
		$Request->execute();
        	$data = $Request->fetchAll();
        
        	echo '<tr class="r">';
        	echo '<td class="b l">'.__('Longest activities').'</td>';

		if (!empty($data)) {
		   $j = 0;
        	   foreach ($data as $j => $dat) {
		       $code = ($dat['distance'] != 0 ? Distance::format($dat['distance']) : Duration::format($dat['s']));
		       echo '<td class="small"><span title="'.date("d.m.Y",$dat['time']).'">
        	       	    '.Ajax::trainingLink($dat['id'], $code).'
        		    </span></td>';
                   }
        	   for (; $j < 9; $j++)
        	       echo HTML::emptyTD();
		}
		else 
        	   echo '<td colspan="10"><em>'.__('No data available').'</em></td>';
		echo '</tr>';
		echo '</tbody>';
		echo '</table>';
	   }
	}

}