<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package t3dev_slider
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_ResponsiveTemplate_Domain_Model_Sliderimages extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * The Slider ID
	 *
	 * @var Tx_ResponsiveTemplate_Domain_Model_Slider
	 */
	protected $sliderId;

	/**
	 * The Headline for the Slider
	 *
	 * @var string
	 */
	protected $sliderHeadline;

	/**
	 * The Text for the Sliderimage
	 *
	 * @var string
	 */
	protected $sliderText;

	/**
	 * The prev Image
	 *
	 * @var string
	 */
	protected $sliderPrevImage;

	/**
	 * The SliderImage
	 *
	 * @var string
	 */
	protected $sliderImage;

	/**
	 * Returns the sliderId
	 *
	 * @return integer $sliderId
	 */
	public function getSliderId() {
		return $this->sliderId;
	}

	/**
	 * Sets the sliderId
	 *
	 * @param integer $sliderId
	 * @return void
	 */
	public function setSliderId($sliderId) {
		$this->sliderId = $sliderId;
	}

	/**
	 * Returns the sliderHeadline
	 *
	 * @return string $sliderHeadline
	 */
	public function getSliderHeadline() {
		return $this->sliderHeadline;
	}

	/**
	 * Sets the sliderHeadline
	 *
	 * @param string $sliderHeadline
	 * @return void
	 */
	public function setSliderHeadline($sliderHeadline) {
		$this->sliderHeadline = $sliderHeadline;
	}

	/**
	 * Returns the sliderText
	 *
	 * @return string $sliderText
	 */
	public function getSliderText() {
		return $this->sliderText;
	}

	/**
	 * Sets the sliderText
	 *
	 * @param string $sliderText
	 * @return void
	 */
	public function setSliderText($sliderText) {
		$this->sliderText = $sliderText;
	}

	/**
	 * Returns the sliderPrevImage
	 *
	 * @return string $sliderPrevImage
	 */
	public function getSliderPrevImage() {
		return $this->sliderPrevImage;
	}

	/**
	 * Sets the sliderPrevImage
	 *
	 * @param string $sliderPrevImage
	 * @return void
	 */
	public function setSliderPrevImage($sliderPrevImage) {
		$this->sliderPrevImage = $sliderPrevImage;
	}

	/**
	 * Returns the sliderImage
	 *
	 * @return string $sliderImage
	 */
	public function getSliderImage() {
		return $this->sliderImage;
	}

	/**
	 * Sets the sliderImage
	 *
	 * @param string $sliderImage
	 * @return void
	 */
	public function setSliderImage($sliderImage) {
		$this->sliderImage = $sliderImage;
	}

}
?>