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
class Tx_ResponsiveTemplate_Utility_BESliderPreview extends Tx_Extbase_MVC_Controller_ActionController {

    /**
     * @var Tx_ResponsiveTemplate_Domain_Model_SliderRepository
     */
    protected $sliderRepository;

    /**
     * @var Tx_ResponsiveTemplate_Domain_Model_SliderimagesRepository
     */
    protected $sliderimagesRepository;
    
    /**
     *       
     * @param Tx_ResponsiveTemplate_Domain_Repository_SliderRepository $sliderRepository     
     */
    public function injectSliderRepository(Tx_ResponsiveTemplate_Domain_Repository_SliderRepository $sliderRepository) {
        $this->sliderRepository = $sliderRepository;
    }
    
    /**
     *       
     * @param Tx_ResponsiveTemplate_Domain_Repository_SliderimagesRepository $slideimagesRepository     
     */
    public function injectSliderimagesRepository(Tx_ResponsiveTemplate_Domain_Repository_SliderimagesRepository $sliderimagesRepository) {
        $this->sliderimagesRepository = $sliderimagesRepository;
    }

    
    /**
     * Initializes the current action 
     * @return void 
     */
    public function initializeAction() {
        $this->sliderRepository = & t3lib_div::makeInstance("Tx_ResponsiveTemplate_Domain_Repository_SliderRepository");
        $this->sliderimagesRepository = t3lib_div::makeInstance("Tx_ResponsiveTemplate_Domain_Repository_SliderimagesRepository");

    }
    
    
    
    /**
     * Function called from page view, used to generate preview of this plugin
     *
     * @param  array   $params:  flexform params
     * @param  array   $pObj:    parent object
     * @return string  $result:  the hghlighted text
     */
    public function renderPluginPreview($params, &$pObj) {
         
        if ($params['row']['CType'] === 'list' && $params['row']['list_type'] === 'responsivetemplate_responsiveslider') {
            
            $content = $this->preview($params['row']);
            
            return $content;
        }
    }

    /**
     * Render the preview
     *
     * @param array  $row tt_content row of the plugin
     * @return string rendered preview html
     */
    protected function preview($row) {
        $this->initializeAction();
        //read the slider uid from flexform
        $xml = simplexml_load_string( $row['pi_flexform']);
        $result = $xml->data->sheet->language->field->value->asXML();
        
        $sliderUid =  strip_tags($result);
        
        //load Slider and set outputheader
        $slider = $this->sliderRepository->findByUid($sliderUid);
        $BEoutput = 'Slider Name: <b>' . $slider->getSliderHeadline() . '</b><br /><br />';
        
        //load Slider Images and set output
        $basePath = t3lib_div::getFileAbsFileName('uploads/responsivetemplate/slider/');
        $sliderImages = $this->sliderimagesRepository->findSliderimages($sliderUid);
        if( $sliderImages != NULL) {
            foreach ($sliderImages as $images) {
                $BEoutput .= '<img src=http://localhost:8888/typo62/uploads/responsivetemplate/slider/' .  $images->getSliderImage() . ' width="80px"/>';
                $BEoutput .= '&nbsp;';
                
            }
        }
        
        return $BEoutput;
    }




    /**
     * action show
     *
     * @param Tx_ResponsiveTemplate_Domain_Model_Slider $slider
     * @return void
     */
    public function showAction() {
        
        $slider = $this->sliderRepository->findByUid($this->settings['sliderUid']);
        $sliderimages = $this->sliderimagesRepository->findSliderimages($this->settings['sliderUid']);
	
        
        $this->view->setTemplatePathAndFilename(
			'typo3conf/ext/responsive_template/' .
			'/Resources/Private/Slider/Frontend/Templates/Slider/Show.html'
		);
	
                
        $this->view->assign('slider', $slider);
        $this->view->assign('sliderimages', $sliderimages);
        
    }

}

?>