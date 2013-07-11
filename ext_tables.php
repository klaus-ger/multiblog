<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'blogindex',
	'multiblog: Multiple Blogs overview'
);

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'blogsingle',
	'multiblog: Singleblog'
);



Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'blogedit',
	'multiblog: Blogedit'
);


t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'setup');



$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_blog';  
 
 


//***************************************************************************************************************************************************************//
// Blogs | Haupttabelle für die einzelnen Blog Definitionen                                    
//***************************************************************************************************************************************************************//

t3lib_extMgm::addLLrefForTCAdescr       ( 'tx_multiblog_domain_model_blog',
                                          'Blogs' );
t3lib_extMgm::allowTableOnStandardPages ( 'tx_multiblog_domain_model_blog');

$TCA['tx_multiblog_domain_model_blog'] = array (
	'ctrl' => array (
		'title'                    => 'Blog',
		'label'                    => 'blogtitel',
		'tstamp'                   => 'tstamp',
		'crdate'                   => 'crdate',
	//	'versioningWS'             => 2,
	//	'versioning_followPages'   => TRUE,
	//	'origUid'                  => 't3_origuid',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'delete'                   => 'deleted',
		'enablecolumns'            => array ( 'disabled' => 'hidden' ),
		'dynamicConfigFile'        => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Blog.php',
		'iconfile'                 => t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
	)
);

//***************************************************************************************************************************************************************//
// Blogeinträge ENTRYS       //                                  
//***************************************************************************************************************************************************************//

t3lib_extMgm::addLLrefForTCAdescr       ( 'tx_multiblog_domain_model_entry',
                                          'EXT:multiblog/Resources/Private/Language/locallang_csh_tx_multiblog_domain_model_entry.xml' );
t3lib_extMgm::allowTableOnStandardPages ( 'tx_multiblog_domain_model_entry');

$TCA['tx_multiblog_domain_model_entry'] = array (
	'ctrl' => array (
		'title'                    => 'Blogeintrag',
		'label'                    => 'entrytitel',
		'tstamp'                   => 'tstamp',
		'crdate'                   => 'crdate',
	//	'versioningWS'             => 2,
	//	'versioning_followPages'   => TRUE,
	//	'origUid'                  => 't3_origuid',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'delete'                   => 'deleted',
		'enablecolumns'            => array ( 'disabled' => 'hidden' ),
		'dynamicConfigFile'        => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Entry.php',
// Nachfolgender Link muß noch angepasst werden
		'iconfile'                 => t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
	)
);
//***************************************************************************************************************************************************************//
// Kommentare                                 
//***************************************************************************************************************************************************************//

t3lib_extMgm::addLLrefForTCAdescr       ( 'tx_multiblog_domain_model_comment',
                                          'EXT:community/Resources/Private/Language/locallang_csh_tx_community_domain_model_profil.xml' );
t3lib_extMgm::allowTableOnStandardPages ( 'tx_multiblog_domain_model_comment');

$TCA['tx_multiblog_domain_model_comment'] = array (
	'ctrl' => array (
		'title'                    => 'Kommentar',
		'label'                    => 'commenttitel',
		'tstamp'                   => 'tstamp',
		'crdate'                   => 'crdate',
	//	'versioningWS'             => 2,
	//	'versioning_followPages'   => TRUE,
	//	'origUid'                  => 't3_origuid',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'delete'                   => 'deleted',
		'enablecolumns'            => array ( 'disabled' => 'hidden' ),
		'dynamicConfigFile'        => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Comment.php',
// Nachfolgender Link muß noch angepasst werden
		'iconfile'                 => t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
	)
);

//***************************************************************************************************************************************************************//
// Hilfstabelle Kategorien                               
//***************************************************************************************************************************************************************//

t3lib_extMgm::addLLrefForTCAdescr       ( 'tx_multiblog_domain_model_kategorie',
                                          'EXT:community/Resources/Private/Language/locallang_csh_tx_community_domain_model_profil.xml' );
t3lib_extMgm::allowTableOnStandardPages ( 'tx_multiblog_domain_model_kategorie');

$TCA['tx_multiblog_domain_model_kategorie'] = array (
	'ctrl' => array (
		'title'                    => 'Kategorie',
		'label'                    => 'kategorie',
		'tstamp'                   => 'tstamp',
		'crdate'                   => 'crdate',
	//	'versioningWS'             => 2,
	//	'versioning_followPages'   => TRUE,
	//	'origUid'                  => 't3_origuid',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'delete'                   => 'deleted',
		'enablecolumns'            => array ( 'disabled' => 'hidden' ),
		'dynamicConfigFile'        => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Kategorie.php',
// Nachfolgender Link muß noch angepasst werden
		'iconfile'                 => t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
	)
);


?>