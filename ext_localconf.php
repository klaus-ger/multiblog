<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
if (TYPO3_MODE === 'FE' && !isset($_REQUEST['eID'])) {
	       \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\SignalSlot\\Dispatcher')->connect(
	'TYPO3\\CMS\\Core\\Resource\\Index\\MetaDataRepository',
	'recordPostRetrieval',
	'TYPO3\\CMS\\Frontend\\Aspect\\FileMetadataOverlayAspect',
	  'languageAndWorkspaceOverlay'
	 );
	 }


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'T3developer.' . $_EXTKEY,
	'singleblog',
	array(
		'Blog' => ' index
                          , blogview
                          , singleView
                          , ajaxNewComment',
		
	),
	// non-cacheable actions
	array(
		'Blog' => ' index
                          , singleView
                          , ajaxNewComment',
		
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'T3developer.' . $_EXTKEY,
	'blogedit',
	array(
		'Blogedit' => ' login
                              , index
                              , postNew
                              , postEdit
                              , postCreate
                              , postUpdate
                              , kategoryShow
                              , kategoryAdd
                              , widgetsShow
                              , widgetsUpdate
                              , blogstyleShow
                              , blogstyleUpdate
                              , usersettingsShow
                              , usersettingsUpdate',
		
	),
	// non-cacheable actions
	array(
		'Blogedit' => ' login
                              , index
                              , postNew
                              , postEdit
                              , postCreate
                              , postUpdate
                              , kategoryShow
                              , kategoryAdd
                              , widgetsShow
                              , widgetsUpdate
                              , blogstyleShow
                              , blogstyleUpdate
                              , usersettingsShow
                              , usersettingsUpdate',
		
		
	)
);
$TYPO3_CONF_VARS['FE']['eID_include']['ajaxDispatcher'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('multiblog').'Classes/EIDispatcher.php';


?>