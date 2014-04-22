<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_multiblog_domain_model_post'] = array(
    'ctrl' => $TCA['tx_multiblog_domain_model_post']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'posttitel, poststicky,category',
    ),
    'types' => array(
        '1' => array('showitem' => '--div--;Post;;;1-1-1, 
                                    blogid,
                                    posttitel,
                                    
                                    postdate,
                                    --palette--;Settings;post,
                                    
                                    --div--;Teaser;;;1-1-1,
                                    postintro,
                                    image,
                                    
                                    
                                    --div--;Content;;;1-1-1, 
                                    postshowteaser,
                                    postcontent,
                                    
                                    --div--;Post Meta;;;1-1-1,
                                    category,
                                    
                                    --div--;SEO Options;;;1-1-1,
                                    postlink,
                                    postseodescription'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
        'post' => array('showitem' => 'poststatus, postcommentoption, poststicky,', 'canNotCollapse' => 1),
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
                'foreign_table' => 'tx_multiblog_domain_model_post',
                'foreign_table_where' => 'AND tx_multiblog_domain_model_post.pid=###CURRENT_PID### AND tx_multiblog_domain_model_post.sys_language_uid IN (-1,0)',
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
        'posttitel' => array(
            'exclude' => 0,
            'label' => 'Titel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'blogid' => array(
            'exclude' => 0,
            'label' => 'Blog',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_multiblog_domain_model_blog',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
            )
        ),
//                'category' => array(
//    'exclude' => 1,
//    'label' => 'category',
//    'config' => array(
//        // edited
//        'type' => 'inline',
//
//        'internal_type' => 'db',
//        'allowed' => 'tx_multiblog_domain_model_category',
//        'foreign_table' => 'tx_multiblog_domain_model_category',
//        'MM' => 'tx_multiblog_post_category_mm',
//        'MM_opposite_field' => 'parent_cluster',
//        'size' => 6,
//        'autoSizeMax' => 30,
//        'maxitems' => 9999,
//        'multiple' => 0,
//        'selectedListStyle' => 'width:250px;',
//        'wizards' => array(
//            '_PADDING' => 5,
//            '_VERTICAL' => 1,
//            'suggest' => array(
//                'type' => 'suggest',
//            ),
//        ),
//    ),
//),
        'postintro' => array(
            'exclude' => 0,
            'label' => 'Intro',
            'config' => array(
                'type' => 'text',
                'cols' => 48,
                'rows' => 6,
            ),
            'defaultExtras' => 'richtext[]:rte_transform[mode=ts_css]',
        ),
        'postpicture' => array(
            'exclude' => 0,
            'label' => 'postpicture',
            'config' => array(
                'type' => 'input',
                'size' => 30
            ),
        ),
        'postcontent' => Array(
            'exclude' => 0,
            'label' => 'Content',
            'config' => Array(
                'type' => 'inline',
                'foreign_table' => 'tx_multiblog_domain_model_content',
                'foreign_field' => 'postid',
                'maxitems' => 99,
            ),
        ),
        'postdate' => array(
            'exclude' => 0,
            'label' => 'postdate',
            'config' => array(
                'type' => 'input',
                'size' => '12',
                'max' => '20',
                'eval' => 'datetime',
                'checkbox' => '0',
                'default' => time(),
            ),
        ),
        'poststatus' => array(
            'exclude' => 0,
            'label' => 'Status',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('DRAFT', '0'),
                    array('Online', '1'),
                ),
                'size' => 1,
                'maxitems' => 1,
            ),
        ),
        'poststicky' => array(
            'exclude' => 0,
            'label' => 'Sticky',
            'config' => array(
                'type' => 'check',
                'default' => '0',
                'items' => array(
                    '1' => array(
                        '0' => 'Hold post in front'
                    )
                )
            ),
        ),
        'postcommentoption' => array(
            'exclude' => 0,
            'label' => 'Comments',
            'config' => array(
                'type' => 'check',
                'default' => '1',
                'items' => array(
                    '1' => array(
                        '0' => 'Allowed'
                    )
                )
            ),
        ),
        'postshowteaser' => array(
            'exclude' => 0,
            'label' => 'Show teaser on single Post view',
            'config' => array(
                'type' => 'check',
                'default' => '1',
                'items' => array(
                    '1' => array(
                        '0' => 'show'
                    )
                )
            ),
        ),
        'files' => array(
            'exclude' => 1,
            'label' => 'Files',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('files', array(
                'appearance' => array(
                    'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
                ),
                 'minitems' => 0,
                'maxitems' => 1,
                    ), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
        ),
        
        
        'image' => array(
            'exclude' => 1,
            'label' => 'Image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('files', array(
                'appearance' => array(
                    'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
                ),
                'minitems' => 0,
                'maxitems' => 1,
                    ), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
        ),
        'category' => array(
            'exclude' => 0,
            'label' => 'Category',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_multiblog_domain_model_category',
                'MM' => 'tx_multiblog_post_category_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'wizards' => array(
                    '_PADDING' => 1,
                    '_VERTICAL' => 1,
                    'edit' => array(
                        'type' => 'popup',
                        'title' => 'Edit',
                        'script' => 'wizard_edit.php',
                        'icon' => 'edit2.gif',
                        'popup_onlyOpenIfSelected' => 1,
                        'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
                    ),
                    'add' => Array(
                        'type' => 'script',
                        'title' => 'Create new',
                        'icon' => 'add.gif',
                        'params' => array(
                            'table' => 'tx_multiblog_domain_model_category',
                            'pid' => '###CURRENT_PID###',
                            'setValue' => 'prepend'
                        ),
                        'script' => 'wizard_add.php',
                    ),
                ),
            ),
        ),
        'postseodescription' => array(
            'exclude' => 0,
            'label' => 'Description for Meta Field',
            'config' => array(
                'type' => 'text',
                'cols' => 48,
                'rows' => 6,
            ),
        ),
        'postlink' => array(
            'exclude' => 0,
            'label' => 'Url link',
            'config' => array(
                'type' => 'input',
                'size' => 30
            ),
        ),
    ),
);
?>