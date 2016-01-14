<?php
/**
 * This file contains class::SectionRecord
 * @package Runalyze\DataObjects\Training\View\Section
 */

use Runalyze\View\Activity\Linker;
use Runalyze\View\Activity;
use Runalyze\Model\Trackdata;
use Runalyze\View\Activity\Box;
use Runalyze\Activity\Temperature;
use Runalyze\Model\Factory;
use Runalyze\Activity\Distance;
use Runalyze\Activity\Duration;
use Runalyze\Activity\Pace;

/**
 * Section: Laps
 * 
 * @author Roberto Guanciale
 * @package Runalyze\DataObjects\Training\View\Section
 */
class SectionRecord extends TrainingViewSectionRowTabbedPlot {
	/**
	 * Set header and rows
	 */
	protected function setHeaderAndRows() {
		$this->Header = __('Your records');
	}


	/**
	 * Set content
	 */
	protected function setContent() {
		$this->Header = __('Achievements');
		$this->withShadow = true;
		$this->addInfoLink();
		// $this->addTable();
	}

	/**
	 * Add: table
	 */
	protected function addTable() {
		$Table = new TableLapsComputed($this->Context);
		$this->Code = $Table->getCode();
	}

	/**
	 * Add info link
	 */
	protected function addInfoLink() {
	}

	/**
	 * Set content right
	 */
	protected function setRightContent() {
                $Factory = new PluginFactory();
                $PluginRecord = $Factory->newInstance('RunalyzePluginStat_Record');

		if (!$PluginRecord) {
                        return;
                }

		$NotesContent = '';


		$NotesContent .= '<div class="panel-content">';

		$LinkList = '<li class="with-submenu"><span class="link">selected</span><ul class="submenu">';
		$LinkList .= '<li class="active">v1</li>';
		$LinkList .= '<li>v2</li>';
		$LinkList .= '</ul></li>';

		$NotesContent .= '<div class="panel-heading">';
		$NotesContent .= '<div class="panel-menu">';
		$NotesContent .= '<ul>'.$LinkList.'</ul>';
		$NotesContent .= '</div>';
		$NotesContent .= '</div>';

		$NotesContent .= '<table><tr>';
				 
		$distances = $PluginRecord->Configuration()->value('pb_distances'.$this->Context->sport()->id());

		foreach ($distances as $distance) {
			if ($distance > $this->Context->activity()->distance())
			   continue;
                	$Request = DB::getInstance()->prepare('
            		      SELECT count(*) as `position`
            		      FROM `'.PREFIX.'training`
            		      WHERE `sportid`=:sportid
     			       	    AND `distance` > 0
    			       	    AND `distance`>=:distance
    			       	    AND (    (`distance`/`s`) > :pace
				          OR  (`distance`/`s`) = :pace
				          AND `s` < :s)
  		        ');
         
                	$Request->bindValue('sportid', $this->Context->sport()->id());
                	$Request->bindValue('s', $this->Context->activity()->duration());
                	$Request->bindValue('pace', $this->Context->activity()->distance()/$this->Context->activity()->duration());
			$Request->bindValue('distance', $distance);
                	$Request->execute();
                	$data = $Request->fetchAll();
			
			$position = $data[0]['position'];

			$limit1 = (($position < 8)?10:4);
			
	 		$NotesContent .= '<td>';
         		$NotesContent .= '<table class="fullwidth zebra-style">';
         		$NotesContent .= '<thead><tr><th colspan="3" class="l">
				      	 '.$this->Context->sport()->icon()->code().'
					 '.$this->Context->sport()->name().'
					 '.$distance.' km</th></tr></thead>';

			$Request = DB::getInstance()->prepare('
                		 SELECT `id`, `time`, `s`, `distance`
                		 FROM `'.PREFIX.'training`
                		 WHERE `sportid`=:sportid
         			       AND `distance` > 0
        			       AND `distance`>=:distance
                 		 ORDER BY
         			      (`distance`/`s`) DESC, `s` DESC
				 LIMIT '.$limit1.'
		        ');
         
                	$Request->bindValue('sportid', $this->Context->sport()->id());
			$Request->bindValue('distance', $distance);
                	$Request->execute();
                	$data = $Request->fetchAll();

        		foreach ($data as $j => $dat) {
        			$Pace = new Pace($dat['s'], $dat['distance']);
          		   	$Pace->setUnit($this->Context->sport()->paceUnit());
        			$code = $Pace->valueWithAppendix();
        			$NotesContent .= '<tr>
        				            <td class="small">'.($j+1).'
        					    '.(($j == $position)?'*':'').'
        					    </td>
        				            <td class="small">'.$code.'</td>
        				            <td class="small">'.date("d.m.Y",$dat['time']).'</td>
               				  </tr>';
        		}
        			

			if ($position >= 8) {
			        $NotesContent .= '<tr><td class="small" colspan="4">...</td></tr>';
				
				$Request = DB::getInstance()->prepare('
				 	 SELECT `id`, `time`, `s`, `distance`
				 	 FROM `'.PREFIX.'training`
				 	 WHERE `sportid`=:sportid
				 	       AND `distance` > 0
				 	       AND `distance`>=:distance
				 	       AND (`distance`/`s` - :pace) > 0
				 	 ORDER BY
				 	      (`distance`/`s` - :pace), `s` DESC
				 	 LIMIT 2
				');
				 
				$Request->bindValue('sportid', $this->Context->sport()->id());
				$Request->bindValue('distance', $distance);
				$Request->bindValue('pace', $this->Context->activity()->distance()/$this->Context->activity()->duration());
				$Request->execute();
				$data = $Request->fetchAll();
				 
                		for ($j=0; $j<count($data); $j++) {
				    	$dat = $data[count($data)-$j-1];
                			$Pace = new Pace($dat['s'], $dat['distance']);
                  		   	$Pace->setUnit($this->Context->sport()->paceUnit());
                			$code = $Pace->valueWithAppendix();
                			$NotesContent .= '<tr>
                				            <td class="small">'.($position+$j-count($data)).'
                					    </td>
                				            <td class="small">'.$code.'</td>
                				            <td class="small">'.date("d.m.Y",$dat['time']).'</td>
                       				  </tr>';
                		}
				 
               			$Pace = new Pace($this->Context->activity()->duration(), $this->Context->activity()->distance());
               		   	$Pace->setUnit($this->Context->sport()->paceUnit());
               			$code = $Pace->valueWithAppendix();
               			$NotesContent .= '<tr>
               				            <td class="small">'.($position+1).'
               					    *
               					    </td>
               				            <td class="small">'.$code.'</td>
               				            <td class="small">'.date("d.m.Y",$this->Context->activity()->timestamp()).'</td>
                      				  </tr>';

				$Request = DB::getInstance()->prepare('
				 	 SELECT `id`, `time`, `s`, `distance`
				 	 FROM `'.PREFIX.'training`
				 	 WHERE `sportid`=:sportid
				 	       AND `distance` > 0
				 	       AND `distance`>=:distance
				 	       AND (:pace - `distance`/`s`) > 0
				 	 ORDER BY
				 	      (`distance`/`s` - :pace), `s` DESC
				 	 LIMIT 2
				');
				 
				$Request->bindValue('sportid', $this->Context->sport()->id());
				$Request->bindValue('distance', $distance);
				$Request->bindValue('pace', $this->Context->activity()->distance()/$this->Context->activity()->duration());
				$Request->execute();
				$data = $Request->fetchAll();
				 
                		for ($j=0; $j<count($data); $j++) {
				    	$dat = $data[$j];
                			$Pace = new Pace($dat['s'], $dat['distance']);
                  		   	$Pace->setUnit($this->Context->sport()->paceUnit());
                			$code = $Pace->valueWithAppendix();
                			$NotesContent .= '<tr>
                				            <td class="small">'.($position+$j+1).'
                					    </td>
                				            <td class="small">'.$code.'</td>
                				            <td class="small">'.date("d.m.Y",$dat['time']).'</td>
                       				  </tr>';
                		}

		        }
			$NotesContent .= '</table>';
			$NotesContent .= '</td>';
		}

		$NotesContent .= '</tr></table>';
		$NotesContent .= '</div>';

		$this->addRightContent('notes', __('Additional notes'), $NotesContent);
	}

	
}
