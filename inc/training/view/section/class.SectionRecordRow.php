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
 * Row: Record
 * 
 * @author Roberto Guanciale
 * @package Runalyze\DataObjects\Training\View\Section
 */
class SectionRecordRow extends TrainingViewSectionRowFullwidth {
      protected $records = array();

      /**
       * Record clusters
       * @var float[]
       */
      protected $distances = array();
      protected $useActDate = false;
      protected $rangeCode = 0;

        /**
         * Constructor
         */
        public function __construct(Activity\Context &$Context = null, $useActDate = false, $rangeCode = 0) {
                $this->useActDate = $useActDate;
                $this->rangeCode = $rangeCode;

                parent::__construct($Context);
        }

/**
	 * Set content
	 */
	protected function setContent() {
		$this->id = 'records';

		$this->initData();
		$this->getRecord();
	}


	protected function getTimeCondition() {
		  if (!$this->useActDate && $this->rangeCode == 0)
		     return '';

		  if ($this->useActDate && $this->rangeCode == 0) {
		     return ' AND `time` <="' . $this->Context->activity()->timestamp() .'" ';
		  }

		  return '';
	}

	protected function initData() {
                $Factory = new PluginFactory();
                $PluginRecord = $Factory->newInstance('RunalyzePluginStat_Record');

		if (!$PluginRecord) {
                        return;
                }

		$this->distances = $PluginRecord->Configuration()->value('pb_distances'.$this->Context->sport()->id());
		$this->records = array();
		
		foreach ($this->distances as $distance) {
			if ($distance > $this->Context->activity()->distance())
			   continue;

			$rResult = array();
			
                	$Request = DB::getInstance()->prepare('
            		      SELECT count(*) as `position`
            		      FROM `'.PREFIX.'training`
            		      WHERE `sportid`=:sportid
     			       	    AND `distance` > 0
    			       	    AND `distance`>=:distance
    			       	    AND (    (`distance`/`s`) > :pace
				          OR  (`distance`/`s`) = :pace
				          AND `s` < :s)
				    AND `id` <> :id
				   '.$this->getTimeCondition().'
  		        ');
         
                	$Request->bindValue('sportid', $this->Context->sport()->id());
                	$Request->bindValue('id', $this->Context->activity()->id());
                	$Request->bindValue('s', $this->Context->activity()->duration());
                	$Request->bindValue('pace', $this->Context->activity()->distance()/$this->Context->activity()->duration());
			$Request->bindValue('distance', $distance);
                	$Request->execute();
                	$data = $Request->fetchAll();
			
			$position = $data[0]['position'];

			$limit1 = (($position < 8)?10:4);
			
			$Request = DB::getInstance()->prepare('
                		 SELECT `id`, `time`, `s`, `distance`
                		 FROM `'.PREFIX.'training`
                		 WHERE `sportid`=:sportid
         			       AND `distance` > 0
        			       AND `distance`>=:distance
                                      '.$this->getTimeCondition().'
                 		 ORDER BY
         			      (`distance`/`s`) DESC, `s` DESC
				 LIMIT '.$limit1.'
		        ');
         
                	$Request->bindValue('sportid', $this->Context->sport()->id());
			$Request->bindValue('distance', $distance);
                	$Request->execute();
                	$data = $Request->fetchAll();

			foreach ($data as $j => $dat) {
				$rResult[] = array( 'pos' => $j+1,
					    	   's' => $dat['s'],
						   'distance' => $dat['distance'],
						   'time' => $dat['time']);
        		}
        			
			if ($position >= 8) {
				$Request = DB::getInstance()->prepare('
				 	 SELECT `id`, `time`, `s`, `distance`
				 	 FROM `'.PREFIX.'training`
				 	 WHERE `sportid`=:sportid
				 	       AND `distance` > 0
				 	       AND `distance`>=:distance
				 	       AND (`distance`/`s` - :pace) > 0
                                              '.$this->getTimeCondition().'
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
					$rResult[] = array('pos' => ($position+$j-count($data)) + 1,
						     	   's' => $dat['s'],
						   	   'distance' => $dat['distance'],
						   	   'time' => $dat['time']);
                		}
				
				$rResult[] = array('pos' => $position+1,
					     	   's' => $this->Context->activity()->duration(),
					   	   'distance' => $this->Context->activity()->distance(),
					   	   'time' => $this->Context->activity()->timestamp());

				$Request = DB::getInstance()->prepare('
				 	 SELECT `id`, `time`, `s`, `distance`
				 	 FROM `'.PREFIX.'training`
				 	 WHERE `sportid`=:sportid
				 	       AND `distance` > 0
				 	       AND `distance`>=:distance
				 	       AND (:pace - `distance`/`s`) > 0
                                              '.$this->getTimeCondition().'
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
					$rResult[] = array('pos' => ($position+$j+2),
						     	   's' => $dat['s'],
						   	   'distance' => $dat['distance'],
						   	   'time' => $dat['time']);
                		}

		        }
			$this->records[$distance] = array('position' => $position,
						    	  'rResult' => $rResult);
		}
	}

	/**
	 * Set content right
	 */
	protected function getRecord() {
		$NotesContent = '';
		// $NotesContent .= '<div class="panel-content">';

		// $LinkList = '<li class="with-submenu"><span class="link">selected</span><ul class="submenu">';
		// $LinkList .= '<li class="active">v1</li>';
		// $LinkList .= '<li>v2</li>';
		// $LinkList .= '</ul></li>';

		// $NotesContent .= '<div class="panel-heading">';
		// $NotesContent .= '<div class="panel-menu">';
		// $NotesContent .= '<ul>'.$LinkList.'</ul>';
		// $NotesContent .= '</div>';
		// $NotesContent .= '</div>';

		$NotesContent .= '<table><tr>';
				 
		foreach ($this->distances as $distance) {
			if ($distance > $this->Context->activity()->distance())
			   continue;

			$disRecord = $this->records[$distance];
			if (!$disRecord)
			   continue;
			
         
	 		$NotesContent .= '<td>';
         		$NotesContent .= '<table class="fullwidth zebra-style">';
         		$NotesContent .= '<thead><tr><th colspan="3" class="l">
				      	 '.$this->Context->sport()->icon()->code().'
					 '.$this->Context->sport()->name().'
					 '.$distance.' km</th></tr></thead>';

			$position = $disRecord['position'];
			$rResult = $disRecord['rResult'];
			$limit1 = (($position < 8)?10:4);
			
			foreach ($rResult as $j => $dat) {
				if ($j == 4 && $position >= 8)
				   $NotesContent .= '<tr><td colspan="3" class="small">...</td></tr>';
        			$Pace = new Pace($dat['s'], $dat['distance']);
          		   	$Pace->setUnit($this->Context->sport()->paceUnit());
        			$code = $Pace->valueWithAppendix();
        			$NotesContent .= '<tr>
        				            <td class="small">'.$dat['pos'].'
        					    '.(($dat['pos'] == $position+1)?'*':'').'
        					    </td>
        				            <td class="small">'.$code.'</td>
        				            <td class="small">'.date("d.m.Y",$dat['time']).'</td>
               				  </tr>';
        		}
        			
			$NotesContent .= '</table>';
			$NotesContent .= '</td>';
		}

		$NotesContent .= '</tr></table>';
		// $NotesContent .= '</div>';

		$this->Content = $NotesContent;
	}

	
}
