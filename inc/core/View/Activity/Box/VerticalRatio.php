<?php
/**
 * This file contains class::VerticalRatio
 * @package Runalyze\View\Activity\Box
 */

namespace Runalyze\View\Activity\Box;

/**
 * Boxed value for vertical ratio
 * 
 * @author Hannes Christiansen
 * @package Runalyze\View\Activity\Box
 */
class VerticalRatio extends AbstractBox
{
	/**
	 * Constructor
	 * @param \Runalyze\View\Activity\Context $Context
	 */
	public function __construct(\Runalyze\View\Activity\Context $Context)
	{
		parent::__construct(
			\Helper::Unknown(\Runalyze\Activity\VerticalRatio::format($Context->activity()->verticalRatio(), false), '-'),
			'%',
			__('Vertical Ratio')
		);
	}
}