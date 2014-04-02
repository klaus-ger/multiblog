<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_multiblog_domain_model_blog'] = array(
    'ctrl' => $TCA['tx_multiblog_domain_model_blog']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, blogtitel, blogowner',
    ),
    'types' => array(
        '1' => array('showitem' => '  --div--;General Settings;;;1-1-1 
                                    , blogtitel
                                    , blogowner
                                    , blogwritermail
                                    
                                    
                                    , --div--;Widgets;;;1-1-1
                                    , --palette--;Widgets;widgets
                                    , blogdescription; About Blog text
                                    
                                    '),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
        'widgets' => array('showitem' => 'widget_about_blog, widget_recent_post;;1, widget_category, widget_comments ', 'canNotCollapse' => 1)
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
                'foreign_table' => 'tx_multiblog_domain_model_blog',
                'foreign_table_where' => 'AND tx_multiblog_domain_model_blog.pid=###CURRENT_PID### AND tx_multiblog_domain_model_blog.sys_language_uid IN (-1,0)',
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
        'blogtitel' => array(
            'exclude' => 0,
            'label' => 'Blogtitel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'blogowner' => array(
            'exclude' => 0,
            'label' => 'Blogowner',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'fe_users',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
            )
        ),
        'blogwritermail' => array(
            'exclude' => 0,
            'label' => 'Blog Owner mail',
            'config' => array(
                'type' => 'input',
                'size' => 30
            ),
        ),
        'blogdescription' => array(
            'exclude' => 0,
            'label' => 'Blogdescription',
            'config' => array(
                'type' => 'text',
                
            ),
        ),
        'blogcss' => array(
            'exclude' => 0,
            'label' => 'Blog CSS',
            'config' => array(
                'type' => 'input',
                'size' => 30
            ),
        ),
        'blogpicture' => array(
            'exclude' => 0,
            'label' => 'Blogpicture',
            'config' => array(
                'type' => 'input',
                'size' => 30
            ),
        ),
        'lastentry' => array(
            'exclude' => 0,
            'label' => 'Last Entry',
            'config' => array(
                'type' => 'input',
                'size' => '12',
                'max' => '20',
                'eval' => 'datetime',
                'checkbox' => '0',
            ),
        ),
        'sticky_post' => array(
            'exclude' => 0,
            'label' => 'sticky Post',
            'config' => array(
                'type' => 'check',
                'items' => array(
                    '1' => array(
                        '0' => 'Enabled'
                    )
                )
            ),
        ),
        'widget_about_blog' => array(
            'exclude' => 0,
            'label' => 'About Blog',
            'config' => array(
                'type' => 'check',
                'items' => array(
                    '1' => array(
                        '0' => 'Enabled'
                    )
                )
            ),
        ),
        'widget_recent_post' => array(
            'exclude' => 0,
            'label' => 'Recent Posts',
            'config' => array(
                'type' => 'check',
                'items' => array(
                    '1' => array(
                        '0' => 'Enabled'
                    )
                )
            ),
        ),
        'widget_category' => array(
            'exclude' => 0,
            'label' => 'Categories',
            'config' => array(
                'type' => 'check',
                'items' => array(
                    '1' => array(
                        '0' => 'Enabled'
                    )
                )
            ),
        ),
        'widget_comments' => array(
            'exclude' => 0,
            'label' => 'Last Comments',
            'config' => array(
                'type' => 'check',
                'items' => array(
                    '1' => array(
                        '0' => 'Enabled'
                    )
                )
            ),
        ),
        'widget_all_posts' => array(
            'exclude' => 0,
            'label' => 'All Posts',
            'config' => array(
                'type' => 'check',
                'items' => array(
                    '1' => array(
                        '0' => 'Enabled'
                    )
                )
            ),
        ),
         'widget_meta' => array(
            'exclude' => 0,
            'label' => 'Meta',
            'config' => array(
                'type' => 'check',
                'items' => array(
                    '1' => array(
                        '0' => 'Enabled'
                    )
                )
            ),
        ),
        
        'blogstyle' => array(
            'exclude' => 0,
            'label' => 'Blogstyle',
            'config' => array(
                'type' => 'input',
                'size' => 30
            ),
        ),
        'blogstyle_teaserimages' => array(
            'exclude' => 0,
            'label' => 'Teaserimages',
            'config' => array(
                'type' => 'input',
                'size' => 30
            ),
        ),
        'blogseotitle' => array(
            'exclude' => 0,
            'label' => 'Seo Title',
            'config' => array(
                'type' => 'input',
                'size' => 100
            ),
        ),
        'blogseodescription' => array(
            'exclude' => 0,
            'label' => 'Seo Title',
            'config' => array(
                'type' => 'input',
                'size' => 100
            ),
        ),
    ),
);
?>