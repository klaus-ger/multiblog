<?php
$TCA['tx_multiblog_domain_model_comment'] = array(
	'ctrl' => $TCA['tx_multiblog_domain_model_comment']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'blogid,entryid,commentdate,commentname,commentmail,commenttitel,commenttext,commentproved,commentreply'
	),
	'types' => array(
		'1' => array('showitem' => 'blogid,entryid,commentdate,commentname,commentmail,commenttitel,commenttext,commentproved,commentreply')
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
				'foreign_table' => 'tx_multiblog_domain_model_comment',
				'foreign_table_where' => 'AND tx_multiblog_domain_model_comment.uid=###REC_FIELD_l18n_parent### AND tx_multiblog_domain_model_comment.sys_language_uid IN (-1,0)',
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
		'entryid' => array(
			'exclude' => 0,
			'label'   => 'Kommentar zum Eintrag:',
			'config'  => array(
			'type' => 'select',
			'foreign_table' => 'tx_multiblog_domain_model_entry',
			'size' => 1,
			'minitems' => 1,
			'maxitems' => 1,
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

	'commentdate' => array(
			'exclude' => 1,
			'label'   => 'Datum',
			'config'  => array(
				'type'    => 'input',
				'size' => 12,
				'checkbox' => 1,
				'eval' => 'datetime, required',
				'default' => time()
			)
		),


	'commentname' => array(
		'exclude' => 0,
		'label'   => 'Name:',
		'config' => array(
          'type' => 'input',
          'size' => 30,
          'eval' => 'trim',
			)
		),
	
	
	'commentmail' => array(
		'exclude' => 0,
		'label'   => 'Mailadresse:',
		'config' => array(
          'type' => 'input',
          'size' => 30,
          'eval' => 'trim',
			)
		),

	'commenttitel' => array(
		'exclude' => 0,
		'label'   => 'Kommentartitel:',
		'config' => array(
          'type' => 'input',
          'size' => 50,
          'eval' => 'trim',
			)
		),
		
	'commenttext' => array(
		'exclude' => 0,
		'label'   => 'Kommentar:',
		'config' => array(
  		'type' => 'text', 
        'cols' => '30', 
        'rows' => '5',     
			)
		),

	'commentproved' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
			'type' => 'check'
			)
		),

	'commentreply' => array(
		'exclude' => 0,
		'label'   => 'Kommentarantwort:',
		'config' => array(
  		'type' => 'text', 
        'cols' => '30', 
        'rows' => '5',     
			)
		),
	'captcha' => array(
		'exclude' => 0,
		'label'   => 'Captcha:',
		'config' => array(
          'type' => 'input',
          'size' => 30,
          'eval' => 'trim',
			)
		),

	
	),
);
?>