<?php
$tempPagesColumns = [

    'tx_rkwauthors_authorship' => [
        'exclude' => 0,
        'displayCond' => 'FIELD:tx_rkwpdf2content_is_import_sub:=:0',
        'label' => 'LLL:EXT:rkw_authors/Resources/Private/Language/locallang_db.xlf:tx_rkwauthors_domain_model_pages.tx_rkwauthors_authorship',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'foreign_table' => 'tx_rkwauthors_domain_model_authors',
            'foreign_table_where' => 'AND ((\'###PAGE_TSCONFIG_IDLIST###\' <> \'0\' AND FIND_IN_SET(tx_rkwauthors_domain_model_authors.pid,\'###PAGE_TSCONFIG_IDLIST###\')) OR (\'###PAGE_TSCONFIG_IDLIST###\' = \'0\')) AND tx_rkwauthors_domain_model_authors.sys_language_uid = ###REC_FIELD_sys_language_uid### ORDER BY tx_rkwauthors_domain_model_authors.last_name ASC',
            'MM' => 'tx_rkwauthors_pages_authors_mm',
            'size' => 10,
            'autoSizeMax' => 30,
            'maxitems' => 9999,
            'minitems' => 0,
            'multiple' => 0,
        ],
    ],
];

// Add TCA
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $tempPagesColumns);

// Remove fields from palette
// --> author;LLL:EXT:cms/locallang_tca.xlf:pages.author_formlabel, author_email;LLL:EXT:cms/locallang_tca.xlf:pages.author_email_formlabel, lastUpdated;LLL:EXT:cms/locallang_tca.xlf:pages.lastUpdated_formlabel
// $GLOBALS['TCA']['pages']['palettes']['editorial']['showitem'] = 'lastUpdated;LLL:EXT:cms/locallang_tca.xlf:pages.lastUpdated_formlabel';
$GLOBALS['TCA']['pages']['palettes']['editorial']['showitem'] = preg_replace('/author.+author_email_formlabel[ ]?,/', '', $GLOBALS['TCA']['pages']['palettes']['editorial']['showitem']);

// Add field to the existing palette
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('pages', 'editorial','--linebreak--,tx_rkwauthors_authorship','after:lastUpdated');

