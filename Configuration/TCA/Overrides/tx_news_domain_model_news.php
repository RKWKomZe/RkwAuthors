<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(

    function($extKey) {

        $tableName = 'tx_news_domain_model_news';

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns($tableName,
            [
                'tx_rkwauthors_authorship' => [
                    'exclude' => 0,
                    'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_pages.tx_rkwauthors_authorship',
                    'config' => [
                        'type' => 'select',
                        'renderType' => 'selectMultipleSideBySide',
                        'foreign_table' => 'tx_rkwauthors_domain_model_authors',
                        'foreign_table_where' => 'AND ((\'###PAGE_TSCONFIG_IDLIST###\' <> \'0\' AND FIND_IN_SET(tx_rkwauthors_domain_model_authors.pid,\'###PAGE_TSCONFIG_IDLIST###\')) OR (\'###PAGE_TSCONFIG_IDLIST###\' = \'0\')) AND tx_rkwauthors_domain_model_authors.sys_language_uid = ###REC_FIELD_sys_language_uid### ORDER BY tx_rkwauthors_domain_model_authors.last_name ASC',
                        'MM' => 'tx_rkwauthors_news_authors_mm',
                        'size' => 10,
                        'autoSizeMax' => 30,
                        'maxitems' => 9999,
                        'minitems' => 0,
                        'multiple' => 0,
                    ],
                ],

            ]
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
            $tableName,
            'paletteAuthor',
            '--linebreak--,tx_rkwauthors_authorship'
        );


    },
    'rkw_authors'
);
