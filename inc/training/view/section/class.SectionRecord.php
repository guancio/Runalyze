<?php
/**
 * This file contains class::SectionRecord
 * @package Runalyze\DataObjects\Training\View\Section
 */

/**
 * Section: Records
 * 
 * @author Roberto Guanciale
 * @package Runalyze\DataObjects\Training\View\Section
 */
class SectionRecord extends TrainingViewSectionTabbed {
	/**
	 * Set header and rows
	 */
	protected function setHeaderAndRows() {
		$this->Header = __('Achievements');

		$this->appendRowTabbed( new SectionRecordRow($this->Context, false, 0), __('All years') );
		$this->appendRowTabbed( new SectionRecordRow($this->Context, true, 0), __('Up to date') );
		$this->appendRowTabbed( new SectionRecordRow($this->Context, true, 1), date("Y",
					    				     $this->Context->activity()->timestamp()));
                $this->appendRowTabbed( new SectionRecordRow($this->Context, false, 2), __('This year'));
		$this->appendRowTabbed( new SectionRecordRow($this->Context, false, 3), __('Last 12 months'));
		$this->appendRowTabbed( new SectionRecordRow($this->Context, false, 4), __('Last 6 months'));
		$this->appendRowTabbed( new SectionRecordRow($this->Context, false, 5), __('Last 30 days'));
		// $this->appendRow( new SectionRecordRow($this->Context) );
	}

	/**
	 * Has the training all required data?
	 * @return bool
	 */
	protected function hasRequiredData() {
		return true;
	}

	/**
	 * CSS-ID
	 * @return string
	 */
	protected function cssId() {
		  '';
	}
}
