<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
    $_EXTKEY,
    'responsivetemplate',
    array ( ''
	    ),

    array ( ''
            )
);

Tx_Extbase_Utility_Extension::configurePlugin(
    $_EXTKEY,
    'responsiveslider',
	array(
		'Slider' => 'show',
		
	),
	// non-cacheable actions
	array(
		'Slider' => '',
		
	)
);
if (TYPO3_MODE == 'BE') {
   // Hook for the page module
//$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['responsivetemplate_responsiveslider'][] = 'EXT:responsive_template/Classes/Utility/BESliderPreview.php:Tx_ResponsiveTemplate_Utility_BESliderPreview->getPreview';
}
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['responsivetemplate_responsiveslider'][] = 'EXT:responsive_template/Classes/Utility/BESliderPreview.php:Tx_ResponsiveTemplate_Utility_BESliderPreview->renderPluginPreview';



 t3lib_extMgm::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:responsive_template/Configuration/TypoScript/pageTsConfig.ts">'); 

?>