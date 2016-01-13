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
		$NotesContent = '<div class="panel-content">';

		$NotesContent .= '<table class="fullwidth zebra-style">';
		$NotesContent .= '<thead><tr><th colspan="3" class="l">'.$this->Context->sport()->icon()->code().' '.$this->Context->sport()->name().' records</th></tr></thead>';
		$Factory = new Factory(SessionAccountHandler::getId());

        	$Request = DB::getInstance()->prepare('
        		 SELECT `id`, `time`, `s`, `distance`
        		 FROM `'.PREFIX.'training`
        		 WHERE `sportid`=:sportid
			       AND `distance` > 0
         		 ORDER BY
			      (`distance`/`s`) DESC, `s` DESC'
        	);

        	$Request->bindValue('sportid', $this->Context->sport()->id());
        	$Request->execute();
        	$data = $Request->fetchAll();
		$position = -1;
		
		foreach ($data as $j => $dat) {
			if ((int)$dat['id'] == $this->Context->activity()->id())
			   $position = $j;
		}
		if ($position < 0)
		   $position = 10;

		for ($j = 0; $j < (($position < 8)?10:4); $j++) {
		    	$dat = $data[$j];
			$Pace = new Pace($dat['s'], $dat['distance']);
   		   	$Pace->setUnit($this->Context->sport()->paceUnit());
			$code = $Pace->valueWithAppendix();
			$NotesContent .= '<tr>
				            <td class="small">'.($j+1).'
					    '.(($j == $position)?'*':'').'
					    </td>
				            <td class="small">'.$dat['id'].'</td>
				            <td class="small">'.$code.'</td>
				            <td class="small">'.date("d.m.Y",$dat['time']).'</td>
        				  </tr>';
		}
		if ($position >= 8) {
			$NotesContent .= '<tr><td class="small" colspan="4">...</td></tr>';
			
			for ($j = $position - 2; $j < $position + 3; $j++) {
		    	    $dat = $data[$j];
			    $Pace = new Pace($dat['s'], $dat['distance']);
   		   	    $Pace->setUnit($this->Context->sport()->paceUnit());
			    $code = $Pace->valueWithAppendix();
			    $NotesContent .= '<tr>
				            <td class="small">'.($j+1).'
					    '.(($j == $position)?'*':'').'
					    </td>
				            <td class="small">'.$dat['id'].'</td>
				            <td class="small">'.$code.'</td>
				            <td class="small">'.date("d.m.Y",$dat['time']).'</td>
        				  </tr>';
			}
		}

                $NotesContent .= '</table>';

		$NotesContent .= '</div>';
		$this->addRightContent('notes', __('Additional notes'), $NotesContent);
	}
}
