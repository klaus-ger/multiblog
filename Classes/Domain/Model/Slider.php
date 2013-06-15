<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Klaus Heuer <klaus.heuer@t3-developer.com>
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
 * ************************************************************* */

/**
 *
 *
 * @package t3dev_slider
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_ResponsiveTemplate_Domain_Model_Slider extends Tx_Extbase_DomainObject_AbstractEntity {

    /**
     * The Headline for the Slider
     *
     * @var string
     */
    protected $sliderHeadline;

    /**
     * The Slider width
     *
     * @var integer
     */
    protected $sliderImgwidth;

    /**
     * The Slider height
     *
     * @var integer
     */
    protected $sliderImgheight;

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
     * Returns the sliderImgwidth
     *
     * @return integer $sliderImgwidth
     */
    public function getSliderImgwidth() {
        return $this->sliderImgwidth;
    }

    /**
     * Sets the sliderImgwidth
     *
     * @param integer $sliderImgwidth
     * @return void
     */
    public function setSliderImgwidth($sliderImgwidth) {
        $this->sliderImgwidth = $sliderImgwidth;
    }

    /**
     * Returns the sliderImgheight
     *
     * @return integer $sliderImgheight
     */
    public function getSliderImgheight() {
        return $this->sliderImgheight;
    }

    /**
     * Sets the sliderImgheight
     *
     * @param integer $sliderImgheight
     * @return void
     */
    public function setSliderImgheight($sliderImgheight) {
        $this->sliderImgheight = $sliderImgheight;
    }

}

?>