<?php
namespace Runalyze\CoreBundle\Service;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Translator;

/**
 *  This file contains class::Time
 * Class for standard operations for timestamps
 * @author Hannes Christiansen & Michael Pohl
 * @package Runalyze\Service
 */
class Time {
	/**
	 * Absolute difference in days between two timestamps
	 * @param int $time_1
	 * @param int $time_2 optional
	 * @return int
	 */
	static public function diffInDays($time_1, $time_2 = 0) {
		if ($time_2 == 0)
			$time_2 = time();

		return floor(abs(($time_1 - $time_2)/(3600*24)));
	}

	/**
	 * Calculates the difference in days of two dates (YYYY-mm-dd)
	 * @param string $date1
	 * @param string $date2
	 * @return int
	 */
	static public function diffOfDates($date1, $date2) {
		if (function_exists('date_diff')) // needs PHP >5.3.0
			return (int)date_diff(date_create($date1), date_create($date2))->format('%a');

		// TODO: Problem because of summer/winter-time
		return floor(abs(strtotime($date1) - strtotime($date2)) / (3600 * 24));
	}

	/**
	 * Is given timestamp from today?
	 * @param int $timestamp
	 * @return boolean
	 */
	static public function isToday($timestamp) {
		return date('d.m.Y') == date('d.m.Y', $timestamp);
	}

	/**
	 * Get the timestamp of the start of the week
	 * @param int $time
	 */
	static public function Weekstart($time) {
		$w = date("w", $time);
		if ($w == 0)
			$w = 7;
		$w -= 1;
		return mktime(0, 0, 0, date("m",$time), date("d",$time)-$w, date("Y",$time));
	}

	/**
	 * Get the timestamp of the end of the week
	 * @param int $time
	 */
	static public function Weekend($time) {
		$start = self::Weekstart($time);
		return mktime(23, 59, 50, date("m",$start), date("d",$start)+6, date("Y",$start));
	}

	/**
	 * Get the name of a day
	 * @param string $w     date('w');
	 * @param bool $short   short version, default: false
	 * @codeCoverageIgnore
	 */
	static public function Weekday($w, $short = false) {
            $translator = new Translator('en');
		switch ($w%7) {
			case 0: return $short ? $translator->trans('Sun') : $translator->trans('Sunday');
			case 1: return $short ? $translator->trans('Mon') : $translator->trans('Monday');
			case 2: return $short ? $translator->trans('Tue') : $translator->trans('Tuesday');
			case 3: return $short ? $translator->trans('Wed') : $translator->trans('Wednesday');
                        case 4: return $short ? $translator->trans('Thu') : $translator->trans('Thursday');
			case 5: return $short ? $translator->trans('Fri') : $translator->trans('Friday');
			case 6:
			default: return $short ? $translator->trans('Sat') : $translator->trans('Saturday');
		}
	}

	/**
	 * Get the name of the month
	 * @param string $m     date('m');
	 * @param bool $short   short version, default: false
	 * @codeCoverageIgnore
	 */
	static public function Month($m, $short = false) {
            $translator = new Translator('en');
                    
		switch ($m % 12) {
			case 1: return $short ? $translator->trans('Jan') : $translator->trans('January');
			case 2: return $short ? $translator->trans('Feb') : $translator->trans('February');
			case 3: return $short ? $translator->trans('Mar') : $translator->trans('March');
			case 4: return $short ? $translator->trans('Apr') : $translator->trans('April');
			case 5: return $short ? $translator->trans('May') : $translator->trans('May');
			case 6: return $short ? $translator->trans('Jun') : $translator->trans('June');
			case 7: return $short ? $translator->trans('Jul') : $translator->trans('July');
			case 8: return $short ? $translator->trans('Aug') : $translator->trans('August');
			case 9: return $short ? $translator->trans('Sep') : $translator->trans('September');
			case 10: return $short ? $translator->trans('Oct') : $translator->trans('October');
			case 11: return $short ? $translator->trans('Nov') : $translator->trans('November');
			case 0:
			default: return $short ? $translator->trans('Dec') : $translator->trans('December');
		}
	}
}