<?php

$TCA['tx_multiblog_domain_model_blog'] = array(
    'ctrl' => $TCA['tx_multiblog_domain_model_blog']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'blogtitel,blogwriter,blogwritermail,blogdescription,sticky_post,blogcss,blogbild,lastentry'
    ),
    'types' => array(
        '1' => array('showitem' => 'blogtitel,blogwriter,blogwritermail,blogdescription,sticky_post,blogcss,blogbild,lastentry')
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
                    array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
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
                'foreign_table' => 'tx_multiblog_domain_model_blog',
                'foreign_table_where' => 'AND tx_multiblog_domain_model_blog.uid=###REC_FIELD_l18n_parent### AND tx_multiblog_domain_model_blog.sys_language_uid IN (-1,0)',
            )
        ),
        'l18n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough')
        ),
        't3ver_label' => array(
            'displayCond' => 'FIELD:t3ver_label:REQ:true',
            'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
            'config' => array(
                'type' => 'none',
                'cols' => 27
            )
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config' => array(
                'type' => 'check'
            )
        ),
        'blogtitel' => array(
            'exclude' => 0,
            'label' => 'Blog Titel',
            'config' => array(
                'type' => 'input',
                'size' => 50,
                'eval' => 'trim,required'
            )
        ),
        'blogwritermail' => array(
            'exclude' => 0,
            'label' => 'e-mail',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'maxitems' => 1,
            )
        ),
        'blogwriter' => array(
            'exclude' => 0,
            'label' => 'Bloginhaber',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'fe_users',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
            )
        ),
        'blogdescription' => array(
            'exclude' => 0,
            'label' => 'Blog Beschreibung',
            'config' => array(
                'type' => 'text',
                'cols' => '30',
                'rows' => '5',
            )
        ),
        'blogcss' => array(
            'exclude' => 0,
            'label' => 'Blogstyle:',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            )
        ),
        'blogbild' => array(
            'exclude' => 0,
            'label' => 'Blogbild:',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'file',
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
                'max_size' => '10000',
                'uploadfolder' => 'uploads/multiblog/blogbilder',
                'show_thumbs' => '1',
                'size' => 3,
                'autoSizeMax' => 15,
                'maxitems' => '1',
                'minitems' => '0'
            )
        ),
        'lastentry' => array(
            'exclude' => 1,
            'label' => 'letzter Beitrag:',
            'config' => array(
                'type' => 'input',
                'size' => 12,
                'checkbox' => 1,
                'eval' => 'datetime, required',
                'default' => time()
            )
        ),
        'sticky_post' => array(
            'exclude' => 0,
            'label' => 'Stickypost',
            'config' => array(
                'type' => 'select',
                'items' => Array(
                    Array("", 0),
                ),
                'foreign_table' => 'tx_multiblog_domain_model_entry',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            )
        ),
        'widget_about_blog' => array(
            'exclude' => 0,
            'label' => 'Blogstyle:',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            )
        ),
        'widget_recent_post' => array(
            'exclude' => 0,
            'label' => 'Blogstyle:',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            )
        ),
        'widget_category' => array(
            'exclude' => 0,
            'label' => 'Blogstyle:',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            )
        ),
        'widget_comments' => array(
            'exclude' => 0,
            'label' => 'Blogstyle:',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            )
        ),
        'widget_all_posts' => array(
            'exclude' => 0,
            'label' => 'Blogstyle:',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            )
        ),
        'blogstyle' => array(
            'exclude' => 0,
            'label' => 'Blogstyle:',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            )
        ),
        
        'blogstyle_teaserimages' => array(
            'exclude' => 0,
            'label' => 'Blogstyle:',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            )
        ),
    ),
);
?>