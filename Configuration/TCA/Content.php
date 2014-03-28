<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_multiblog_domain_model_content'] = array(
    'ctrl' => $TCA['tx_multiblog_domain_model_content']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, postid, postcontent, postpicture',
    ),
    'types' => array(
        '1' => array('showitem' => ' hidden, postid, postcontent, imageposition, postpicture'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_multiblog_domain_model_content',
                'foreign_table_where' => 'AND tx_multiblog_domain_model_content.pid=###CURRENT_PID### AND tx_multiblog_domain_model_content.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            )
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),

        'postid' => array(
            'exclude' => 0,
            'label' => 'category',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        
        'postcontent' => array(
            'exclude' => 0,
            'label' => 'Content',
            'config' => array(
                'type' => 'text',
                'cols' => 48,
                'rows' => 10,
            ),
            'defaultExtras' => 'richtext[]:rte_transform[mode=ts_css]',
        ),

          'postpicture' => array(
                'exclude' => 1,
                'label' => 'Image',
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image', array(
                        'appearance' => array(
                                'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
                        ),
                        'minitems' => 0,
                        'maxitems' => 1,
                ), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
        ),
         'imageposition' => array(
            'exclude' => 0,
            'label' => 'Imageposition',
            'config' => array(
                'type' => 'radio',
                'items' => array(
                    array('top', 0),
                    array('bottom', 1),
                    array('right', 2),
                    array('left', 3),
                    
                    )
                
            ),
        ),
        
    ),
);
?>