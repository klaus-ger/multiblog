<?php

$TYPO3_CONF_VARS['EXTCONF']['realurl']['_DEFAULT'] = array(
   
  'init' => array(
		  'enableCHashCache' => true
		, 'appendMissingSlash' => 'ifNotFile'
		, 'adminJumpToBackend' => true
		, 'enableUrlDecodeCache' => true
		, 'enableUrlEncodeCache' => true
		, 'emptyUrlReturnValue' => '/'
		, 'postVarSet_failureMode' => 'redirect_goodUpperDir'
		, 'reapplyAbsRefPrefix' => true
	)

    , 'redirects'		=> array()

    , 'pagePath' => array(
		'type'			=> 'user'
		, 'userFunc' => 'EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main'
		, 'spaceCharacter'	=> '-'
		, 'languageGetVar'	=> 'L'
		, 'rootpage_id'		=> 1
		, 'segTitleFieldList'	=> 'tx_realurl_pathsegment,alias,title'
		, 'expireDays'		=> 1095
               // , 'excludePageIds'      => '657' //Testsystem, LIVE:  '52,657'
	)


   ,'fixedPostVars' => array(
			'extDetailConfiguration' => array(
				array(
					'GETvar' => 'tx_multiblog_singleblog[postId]',
					'lookUpTable' => array(
						'table' => 'tx_multiblog_domain_model_post',
						'id_field' => 'uid',
						'alias_field' => 'posttitel',
						'addWhereClause' => ' AND NOT deleted',
						'useUniqueCache' => 1,
						'useUniqueCache_conf' => array(
							'strtolower' => 1,
							'spaceCharacter' => '-',
						),
					),
				)
			),
			'1' => 'extDetailConfiguration'
		),

                


); 



?>