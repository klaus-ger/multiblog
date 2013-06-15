<?php

if (!defined('TYPO3_MODE'))
    die('Access denied.');

//Tx_Extbase_Utility_Extension::registerPlugin(
//        $_EXTKEY, 
//        'responsivetemplate', 
//        'responsive Template'
//);

Tx_Extbase_Utility_Extension::registerPlugin(
        $_EXTKEY, 
        'responsiveslider', 
        'Responsive Slider'
);

if (TYPO3_MODE === 'BE') {

    /**
     * Registers the Slider Backend Module
     */
    Tx_Extbase_Utility_Extension::registerModule(
        $_EXTKEY, 
        'web',              // Make module a submodule of 'web'
        'responsiveslider', // Submodule key
        '',                 // Position
            
        array(
            'SliderBE' => 'index, 
                           sliderEdit, sliderUpdate, sliderNew, sliderCreate, sliderDelete,
                           indexImages,
                           imageNew, imageCreate, imageDelete',
            
        ), 
        array(
            'access' => 'user,group',
            'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_t3devslider.xlf',
        )
    );
 
//Flexform für SliderPlugin einbinden    
$pluginSignature = str_replace('_','',$_EXTKEY) . '_responsiveslider';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/responsiveslider.xml');
    
}

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Responsive Template');

// Start of the Slider Tables Definitions:
t3lib_extMgm::addLLrefForTCAdescr('tx_responsiveslider_domain_model_slider', 'EXT:responsivetemplate/Resources/Private/Language/locallang_csh_tx_t3devslider_domain_model_slider.xlf');
t3lib_extMgm::allowTableOnStandardPages('tx_responsivetemplate_domain_model_slider');
$TCA['tx_responsivetemplate_domain_model_slider'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:responsive_template/Resources/Private/Language/locallang_db.xlf:responsiveslider',
		'label' => 'slider_headline',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'slider_id,slider_headline',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Slider.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_responsiveslider_domain_model_sliderimages', 'EXT:responsivetemplate/Resources/Private/Language/locallang_csh_tx_t3devslider_domain_model_slider.xlf');
t3lib_extMgm::allowTableOnStandardPages('tx_responsivetemplate_domain_model_sliderimages');
$TCA['tx_responsivetemplate_domain_model_sliderimages'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:responsive_template/Resources/Private/Language/locallang_db.xlf:responsivesliderimages',
		'label' => 'id',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'slider_id,slider_headline',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Sliderimages.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
	),
);


?>