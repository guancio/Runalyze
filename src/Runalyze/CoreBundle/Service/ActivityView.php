<?php

/**
 * This file contains class::ActivityView
 */
namespace Runalyze\CoreBundle\Service;

use Runalyze\Activity\Duration;

class ActivityView {
    
        protected $Dataset;
    
	/**
	 * Activity
	 */
	protected $Activity;
    
        public function set($Activity) {
            $this->Activity = $Activity;
        }
        
	/**
	 * Date and daytime
	 * @return string
	 */
	public function dateAndDaytime() {
		return $this->date().' '.$this->daytime();
	}
        
	/**
	 * Weekday
	 * @return string
	 */
	public function weekday() {
		return Time::Weekday( date('w', $this->Activity->getTimestamp()) );
	}
        
        public function pace() {
            return $this->Activity->getTime();
        }
        
	/**
	 * Duration
	 * @return \Runalyze\Activity\Duration
	 */
	public function duration() {
		return $this->object($this->Duration, function($Activity){
			return new Duration($Activity->getDuration());
		});
	}
        /**
	 * Get ground contact
	 * @return string ground contact time with unit
	 */
	public function groundcontact() {
		if ($this->Activity->getGroundcontact() > 0)
			return round($this->Activity->getGroundcontact()).'&nbsp;ms';

		return '';
	}
        
	/**
	 * Get elapsed time
	 * @return string
	 */
	public function elapsedTime() {
		if ($this->Activity->getElapsedTime() < $this->Activity->getDuration())
			return '-:--:--';

		return Duration::format($this->Activity->getElapsedTime());
	}
	/**
	 * Get power
	 * @return string power with unit
	 */
	public function power() {
		if ($this->Activity->getPower() > 0) 
			return $this->Activity->power().'&nbsp;W';

		return '';
	}
        
	/**
	 * Get vertical oscillation
	 * @return string vertical oscillation with unit
	 */
	public function verticalOscillation() {
		if ($this->Activity->getVerticalOscillation() > 0)
			return number_format($this->Activity->getVerticalOscillation()/10, 1).'&nbsp;cm';

		return '';
	}
 	/**
	 * Get string for displaying JD points
	 * @return string
	 */
	public function jdIntensity() {
		return $this->Activity->getJdIntensity();
	}

}