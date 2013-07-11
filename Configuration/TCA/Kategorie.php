<?php
$TCA['tx_multiblog_domain_model_kategorie'] = array(
	'ctrl' => $TCA['tx_multiblog_domain_model_kategorie']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'blogid,kategorie,topkategorie'
	),
	'types' => array(
		'1' => array('showitem' => 'blogid,kategorie,topkategorie')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
				)
			)
		),
		'l18n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_multiblog_domain_model_kategorie',
				'foreign_table_where' => 'AND tx_multiblog_domain_model_kategorie.uid=###REC_FIELD_l18n_parent### AND tx_multiblog_domain_model_kategorie.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array(
			'config'=>array(
				'type'=>'passthrough')
		),
		't3ver_label' => array(
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config' => array(
				'type'=>'none',
				'cols' => 27
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
			'type' => 'check'
			)
		),
		'blogid' => array(
			'exclude' => 0,
			'label'   => 'Blog:',
			'config'  => array(
			'type' => 'select',
			'foreign_table' => 'tx_multiblog_domain_model_blog',
			'size' => 1,
			'minitems' => 1,
			'maxitems' => 1,
			)
		),
		
	'kategorie' => array(
			'exclude' => 0,
			'label'   => 'Kategorie',
			'config'  => array(
				'type' => 'input',
				'size' => 100,
				'eval' => 'trim,required'
			)
		),


	'subkategorie' => array(
		'exclude' => 0,
		'label'   => 'Name:',
		'config' => array(
          'type' => 'input',
          'size' => 30,
          'eval' => 'trim',
			)
		),
	
		'topkategorie' => array(
		'exclude' => 0,
		'label'   => 'Hauptkategorie:',
		'config' => array(
			'type' => 'select',
			'foreign_table' => 'tx_multiblog_domain_model_kategorie',
			'size' => 4,
			'minitems' => 0,
			'maxitems' => 4,
			)
		),

	
	),
);
?>