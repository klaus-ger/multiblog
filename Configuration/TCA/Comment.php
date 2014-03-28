<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_multiblog_domain_model_comment'] = array(
    'ctrl' => $TCA['tx_multiblog_domain_model_comment']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'postid, commenttext, commentname, commentmail, commentdate, commentapprove',
    ),
    'types' => array(
        '1' => array('showitem' => 'postid, commenttext, commentname, commentmail, commentdate, commentapprove'),
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
                'foreign_table' => 'tx_multiblog_domain_model_comment',
                'foreign_table_where' => 'AND tx_multiblog_domain_model_comment.pid=###CURRENT_PID### AND tx_multiblog_domain_model_comment.sys_language_uid IN (-1,0)',
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
        'blogid' => array(
            'exclude' => 0,
            'label' => 'postid',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_multiblog_domain_model_blog',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
            ),
        ),
        'postid' => array(
            'exclude' => 0,
            'label' => 'postid',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_multiblog_domain_model_post',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
            ),
        ),
        'commenttext' => array(
            'exclude' => 0,
            'label' => 'Text',
            'config' => array(
                'type' => 'text',
                'cols' => 48,
                'rows' => 6,
            ),
        ),
        'commentname' => array(
            'exclude' => 0,
            'label' => 'Name',
            'config' => array(
                'type' => 'input',
                'size' => 30
            ),
        ),
        'commentmail' => array(
            'exclude' => 0,
            'label' => 'Mail',
            'config' => array(
                'type' => 'input',
                'size' => 30
            ),
        ),
        'commentdate' => array(
            'exclude' => 0,
            'label' => 'Date',
            'config' => array(
                'type' => 'input',
                'size' => '12',
                'max' => '20',
                'eval' => 'datetime',
                'checkbox' => '0',
            ),
        ),
        'commentapprove' => array(
            'exclude' => 0,
            'label' => 'Approve',
            'config' => array(
                'type' => 'check',
            ),
        ),
    ),
);
?>