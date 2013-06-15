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
class Tx_ResponsiveTemplate_Controller_SliderBEController extends Tx_Extbase_MVC_Controller_ActionController {

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
     * @param Tx_ResponsiveTemplate_Domain_Repository_SliderimagesRepository $sliderimagesRepository     
     */
    public function injectSliderimagesRepository(Tx_ResponsiveTemplate_Domain_Repository_SliderimagesRepository $sliderimagesRepository) {
        $this->sliderimagesRepository = $sliderimagesRepository;
    }

    /**
     * index action
     *
     * @param Tx_ResponsiveTemplate_Domain_Model_Slider $slider
     * @return void
     */
    public function indexAction() {
        $slider = $this->sliderRepository->findAll();

        $this->view->assign('menu', 'slider');
        $this->view->assign('slider', $slider);
    }

    /**
     * Edit Slider Action
     *
     * @param Tx_ResponsiveTemplate_Domain_Model_Slider $slider
     * @return void
     */
    public function sliderEditAction($slider) {
        
        $this->view->assign('menu', 'slider');
        $this->view->assign('slider', $slider);
    }
    
    /**
     * Edit Slider Action
     *
     * @param Tx_ResponsiveTemplate_Domain_Model_Slider $slider
     * @return void
     */
    public function sliderUpdateAction($slider) {
        $this->sliderRepository->update($slider);
        
        $this->redirect('index');
    }
    
    /**
     * New Slider Action
     *
     * @param Tx_ResponsiveTemplate_Domain_Model_Slider $slider
     * @return void
     */
    public function sliderNewAction() {
        $slider = new Tx_ResponsiveTemplate_Domain_Model_Slider;
        
        $this->view->assign('menu', 'slider');
        $this->view->assign('slider', $slider);
    }
    
    /**
     * Create Slider Action
     *
     * @param Tx_ResponsiveTemplate_Domain_Model_Slider $slider
     * @return void
     */
    public function sliderCreateAction($slider) {
        $this->sliderRepository->add($slider);
        
        $this->redirect('index');
    }
    
    /**
     * Delete Slider Action
     *
     * @param Tx_ResponsiveTemplate_Domain_Model_Slider $slider
     * @return void
     */
    public function sliderDeleteAction($slider) {
        $this->sliderRepository->remove($slider);
        
        $this->redirect('index');
    }
    
    /**
     * Index Slider Images Action
     *
     * @param Tx_ResponsiveTemplate_Domain_Model_Slider $slider
     * @return void
     */
    public function indexImagesAction() {
        $images = $this->sliderimagesRepository->findAll();
        
        $this->view->assign('menu', 'image');
        $this->view->assign('images', $images);
    }
    
    /**
     * New Image Action
     *
     * 
     * @return void
     */
    public function imageNewAction() {
        $image = new Tx_ResponsiveTemplate_Domain_Model_Sliderimages;
        $slider = $this->sliderRepository->findAll();
        
        $this->view->assign('menu', 'image');
        $this->view->assign('image', $image);
        $this->view->assign('slider', $slider);
    }
    
    /**
     * Image Create Action
     *
     * @param Tx_ResponsiveTemplate_Domain_Model_Sliderimages $image 
     * @return void
     */
    public function imageCreateAction($image) {

        //Tx_Extbase_Utility_Debugger::var_dump($_FILES['tx_responsivetemplate_web_responsivetemplateresponsiveslider']);
        // Bilddateihandling

        if ($_FILES['tx_responsivetemplate_web_responsivetemplateresponsiveslider']['name']['image']['sliderImage']) {
            $basicFileFunctions = t3lib_div::makeInstance('t3lib_basicFileFunctions');

            $fileName = $basicFileFunctions->getUniqueName(
                    $_FILES['tx_responsivetemplate_web_responsivetemplateresponsiveslider']['name']['image']['sliderImage'], t3lib_div::getFileAbsFileName('uploads/responsivetemplate/slider/'));

            t3lib_div::upload_copy_move(
                    $_FILES['tx_responsivetemplate_web_responsivetemplateresponsiveslider']['tmp_name']['image']['sliderImage'], $fileName);

            $image->setSliderImage(basename($fileName));
        }
       
        $this->sliderimagesRepository->add($image);
        
        $this->redirect('indexImages');
    }
    
    /**
     * Delete Image Action
     *
     * @param Tx_ResponsiveTemplate_Domain_Model_Sliderimages $image
     * @return void
     */
    public function imageDeleteAction($image) {
        //Tx_Extbase_Utility_Debugger::var_dump($image);
        $this->sliderimagesRepository->remove($image);
        
        
        $this->redirect('indexImages');
    }
}

?>