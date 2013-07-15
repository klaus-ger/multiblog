<?php

$TCA['tx_multiblog_domain_model_entry'] = array(
    'ctrl' => $TCA['tx_multiblog_domain_model_entry']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'pid,entrytitel,blogid,entryanleser;;;richtext:rte_transform[flag=rte_enabled|mode=ts_css],entrypicture,entrypictureposition,entrytext;;;richtext:rte_transform[flag=rte_enabled|mode=ts_css], entrydate,entrykategorie1,entrykategorie2,entrykategorie3,entrykategorie4,entrystatus'
    ),
    'types' => array(
        '1' => array('showitem' => 'pid,entrytitel,blogid,entryanleser;;;richtext:rte_transform[flag=rte_enabled|mode=ts_css],entrypicture,entrypictureposition,entrytext;;;richtext:rte_transform[flag=rte_enabled|mode=ts_css],entrydate,entrykategorie1,entrykategorie2,entrykategorie3,entrykategorie4, entrystatus')
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
                'foreign_table' => 'tx_multiblog_domain_model_entry',
                'foreign_table_where' => 'AND tx_multiblog_domain_model_entry.uid=###REC_FIELD_l18n_parent### AND tx_multiblog_domain_model_entry.sys_language_uid IN (-1,0)',
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
        'pid' => array(
            'exclude' => 0,
            'label' => 'pid',
            'config' => array(
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim,required'
            )
        ),
        'blogid' => array(
            'exclude' => 0,
            'label' => 'Blog:',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_multiblog_domain_model_blog',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
            )
        ),
        'entrytitel' => array(
            'exclude' => 0,
            'label' => 'Überschrift',
            'config' => array(
                'type' => 'input',
                'size' => 100,
                'eval' => 'trim,required'
            )
        ),
        'entryanleser' => array(
            'exclude' => 0,
            'label' => 'Anleser:',
            'config' => array(
                'type' => 'text',
                'cols' => '30',
                'rows' => '5',
            )
        ),
        'entrypicture' => array(
            'exclude' => 0,
            'label' => 'Bild:',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            )
        ),
        'entrypictureposition' => array(
            'exclude' => 0,
            'label' => 'Bildposition:',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            )
        ),
        'entrytext' => array(
            'exclude' => 0,
            'label' => 'Text:',
            'config' => array(
                'type' => 'text',
                'cols' => '30',
                'rows' => '5',
                'eval' => 'trim',
            )
        ),
        'entrydate' => array(
            'exclude' => 1,
            'label' => 'Datum',
            'config' => array(
                'type' => 'input',
                'size' => 12,
                'checkbox' => 1,
                'eval' => 'datetime, required',
                'default' => time()
            )
        ),
        'entrykategorie1' => array(
            'exclude' => 0,
            'label' => 'Kategorien:',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_multiblog_domain_model_kategorie',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            )
        ),
        'entrykategorie2' => array(
            'exclude' => 0,
            'label' => 'Kategorien:',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_multiblog_domain_model_kategorie',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            )
        ),
        'entrykategorie3' => array(
            'exclude' => 0,
            'label' => 'Kategorien:',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_multiblog_domain_model_kategorie',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            )
        ),
        'entrykategorie4' => array(
            'exclude' => 0,
            'label' => 'Kategorien:',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_multiblog_domain_model_kategorie',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            )
        ),
        'entrystatus' => array(
            'exclude' => 0,
            'label' => 'Sichtbar',
            'config' => array(
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim,required'
            )
        ),
        'entrysticky' => array(
            'exclude' => 0,
            'label' => 'Sichtbar',
            'config' => array(
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim,required'
            )
        ),
        'entrycommentoption' => array(
            'exclude' => 0,
            'label' => 'Kommentarfunktion aktivieren',
            'config' => array(
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim,required'
            )
        ),
    ),
);
?>